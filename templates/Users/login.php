<?php
/**
 * @var \App\View\AppView $this
 */

echo $this->Html->script('verSenha.js');
?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <<div class="card shadow-sm" style="background-color: rgb(198, 159, 104);">
                <div class="card-header">
                    <h2 class="text-center"><?= __('Login') ?></h2>
                </div>
                <div class="card-body">
                    <?= $this->Form->create() ?>
                    <fieldset>
                        <div class="form-group">
                            <?= $this->Form->control('login', ['label' => 'Login', 'class' => 'form-control', 'style' => 'background-color: white; color: black;']) ?>
                        </div>
                        <div class="form-group mt-3 position-relative">
                            <?= $this->Form->control('password', ['label' => 'Senha', 'id' => 'senha', 'class' => 'form-control', 'type' => 'password', 'style' => 'background-color: white; color: black;']); ?>
                            <span id="senhaIcone" style="position: absolute; right: 10px; top: 30px; cursor: pointer;">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </fieldset>
                    <div class="d-flex justify-content-end mt-3">
                        <?= $this->Form->submit(__('Login'), ['class' => 'btn', 'style' => 'background-color: rgb(47, 80, 61); color: white;']); ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
