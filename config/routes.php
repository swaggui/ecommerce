<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
 * This file is loaded in the context of the `Application` class.
  * So you can use  `$this` to reference the application class instance
  * if required.
 */
return function (RouteBuilder $routes): void {
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        // Rota padrão
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

        // Rota para login
        $builder->connect('/login', ['controller' => 'Users', 'action' => 'login']);

        // Rota para logout
        $builder->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);

        // Rota para a loja de produtos
        $builder->connect('/loja', ['controller' => 'Produtos', 'action' => 'loja']);

        // Rota para a página de exibição
        $builder->connect('/pages/*', 'Pages::display');

        // Fallbacks para outras rotas
        $builder->fallbacks();

        $builder->connect('/checkout', ['controller' => 'Orders', 'action' => 'checkout']);
    });
};
