<?php
/**
 * @var \App\View\AppView $this
 */

echo $this->Html->script('verSenha.js');
?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2 class="text-center"><?= __('Login') ?></h2>
                </div>
                <div class="card-body">
                    <?= $this->Form->create() ?>
                    <fieldset>
                        <div class="form-group">
                            <?= $this->Form->control('login', ['label' => 'Login', 'class' => 'form-control']) ?>
                        </div>
                        <div class="form-group mt-3 position-relative">
                            <?= $this->Form->control('password', ['label' => 'Senha', 'id' => 'senha', 'class' => 'form-control', 'type' => 'password']); ?>
                            <span id="senhaIcone" style="position: absolute; right: 10px; top: 30px; cursor: pointer;">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </fieldset>
                    <div class="d-flex justify-content-end mt-3">
                        <?= $this->Form->submit(__('Login'), ['class' => 'btn btn-primary']); ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
