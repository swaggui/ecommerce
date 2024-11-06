<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?> | Sarah
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css') ?>
    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body style="background-color: rgb(47, 80, 61); color: white;">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(198, 159, 104);">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= $this->Url->build('/') ?>" style="color: white;">
            <?= $this->Html->image('logo.jpg', ['alt' => 'Sarah Logo', 'style' => 'width: 40px; height: auto;']) ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build('/') ?>" style="color: white;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build('/produtos/loja') ?>" style="color: white;">Loja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white;">Contato</a>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('Usuários', ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link', 'style' => 'color: white;']) ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <?= $this->fetch('content') ?>
</div>
</body>
</html>
