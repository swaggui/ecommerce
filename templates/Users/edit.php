<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <aside class="col-md-3">
            <div class="side-nav card shadow-sm">
                <div class="card-header" style="background-color: rgb(198, 159, 104); color: white;">
                    <h4 class="heading text-center"><?= __('Actions') ?></h4>
                </div>
                <div class="card-body" style="background-color: rgb(47, 80, 61); color: white;">
                    <?= $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $user->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-danger btn-block']
                    ) ?>
                    <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'btn btn-light btn-block']) ?>
                </div>
            </div>
        </aside>
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header" style="background-color: rgb(198, 159, 104); color: white;">
                    <h3 class="text-center"><?= __('Edit User') ?></h3>
                </div>
                <div class="card-body" style="background-color: rgb(47, 80, 61); color: white;">
                    <?= $this->Form->create($user, ['class' => 'form']) ?>
                    <fieldset>
                        <legend style="color: white;"><?= __('Edit User') ?></legend>
                        <?php
                        echo $this->Form->control('login', ['class' => 'form-control mb-3']);
                        echo $this->Form->control('password', ['class' => 'form-control mb-3']);
                        echo $this->Form->control('ativo', ['class' => 'form-check-input']);
                        ?>
                    </fieldset>
                    <div class="d-flex justify-content-end mt-3">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-light']); ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

