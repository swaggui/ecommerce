<?php
declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Datasource\FactoryLocator;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Authentication\Middleware\AuthenticationMiddleware;
use Psr\Http\Message\ServerRequestInterface;
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceProviderInterface;
use Cake\Routing\Router;

class Application extends BaseApplication implements AuthenticationServiceProviderInterface
{
    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void
    {
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        } else {
            FactoryLocator::add(
                'Table',
                (new TableLocator())->allowFallbackClass(false)
            );
        }

        if (Configure::read('debug')) {
            $this->addPlugin('DebugKit');
        }

        // Load more plugins here
        $this->addPlugin('Authentication'); // Certifique-se de que o plugin de autenticação está carregado
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            ->add(new ErrorHandlerMiddleware(Configure::read('Error'), $this))
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))
            ->add(new RoutingMiddleware($this))
            ->add(new BodyParserMiddleware())
            ->add(new CsrfProtectionMiddleware([
                'httponly' => true,
            ]))

            // Adicione o middleware de autenticação
            ->add(new AuthenticationMiddleware($this));

        return $middlewareQueue;
    }

    /**
     * Configuração do serviço de autenticação.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request Request object.
     * @return \Authentication\AuthenticationService
     */
    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationService
    {
        $service = new AuthenticationService();

        // Defina a URL de redirecionamento para login
        $service->setConfig([
            'unauthenticatedRedirect' => Router::url('/users/login'),
            'queryParam' => 'redirect',
        ]);

        // Configuração dos autenticadores
        $service->loadAuthenticator('Authentication.Session');
        $service->loadAuthenticator('Authentication.Form', [
            'fields' => [
                'username' => 'login',
                'password' => 'password',
            ],
            'loginUrl' => Router::url('/users/login'),
        ]);

        // Configuração dos identificadores de autenticação
        $service->loadIdentifier('Authentication.Password', [
            'fields' => [
                'username' => 'login',
                'password' => 'password',
            ]
        ]);

        return $service;
    }

    /**
     * Register application container services.
     *
     * @param \Cake\Core\ContainerInterface $container The Container to update.
     * @return void
     */
    public function services(ContainerInterface $container): void
    {
    }

    /**
     * Bootstrapping for CLI application.
     *
     * That is when running commands.
     *
     * @return void
     */
    protected function bootstrapCli(): void
    {
        $this->addOptionalPlugin('Bake');
        $this->addPlugin('Migrations');
    }
}
