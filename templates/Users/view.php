<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header" style="background-color: rgb(198, 159, 104); color: white;">
            <h3><?= h($user->login) ?></h3>
        </div>
        <div class="card-body" style="background-color: rgb(47, 80, 61); color: white;">
            <table class="table table-striped table-hover">
                <tr>
                    <th><?= __('Login') ?></th>
                    <td><?= h($user->login) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ativo') ?></th>
                    <td><?= $user->ativo ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
