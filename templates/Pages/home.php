<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        $connection = ConnectionManager::get($name);
        $connected = $connection->connect();
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
        if ($name === 'debug_kit') {
            $error = 'Try adding your current <b>top level domain</b> to the
                <a href="https://book.cakephp.org/debugkit/4/en/index.html#configuration" target="_blank">DebugKit.safeTld</a>
            config and reload.';
            if (!in_array('sqlite', \PDO::getAvailableDrivers())) {
                $error .= '<br />You need to install the PHP extension <code>pdo_sqlite</code> so DebugKit can work properly.';
            }
        }
    }

    return compact('connected', 'error');
};

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Sarah - E-commerce
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css') ?>
    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js') ?>
</head>
<body style="background-color: rgb(47, 80, 61); color: white;">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(198, 159, 104);">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="color: white;">Sarah</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white;">Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white;">Contato</a>
                </li>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('Usuários', ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link', 'style' => 'color: white;']) ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="jumbotron text-center" style="color: rgb(198, 159, 104);">
        <h1 class="display-4">Bem-vindo à Sarah</h1>
        <p class="lead">Os melhores produtos com estilo e elegância.</p>
        <hr class="my-4" style="border-color: rgb(198, 159, 104);">
        <p>Explore nossa coleção agora!</p>
        <a class="btn btn-light btn-lg" href="#" role="button">Ver Produtos</a>
    </div>
</div>
</body>
</html>
