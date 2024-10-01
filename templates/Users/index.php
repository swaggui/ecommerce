<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: rgb(198, 159, 104); color: white;">
            <h3><?= __('Users') ?></h3>
            <!-- Botão de Adicionar -->
            <?= $this->Html->link(__('Adicionar'), ['action' => 'add'], ['class' => 'btn btn-light']) ?>
        </div>
        <div class="card-body" style="background-color: rgb(47, 80, 61); color: white;">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead style="background-color: rgb(198, 159, 104); color: white;">
                    <tr>
                        <th><?= __('id') ?></th>
                        <th><?= __('login') ?></th>
                        <th><?= __('ativo') ?></th>
                        <th><?= __('modified') ?></th>
                        <th><?= __('created') ?></th>
                        <th><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody style="color: white;">
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $this->Number->format($user->id) ?></td>
                            <td><?= h($user->login) ?></td>
                            <td><?= h($user->ativo) ?></td>
                            <td><?= h($user->modified) ?></td>
                            <td><?= h($user->created) ?></td>
                            <td>
                                <?= $this->Html->link(__('View'), ['action' => 'view', $user->id], ['class' => 'btn btn-light btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-light btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure?'), 'class' => 'btn btn-danger btn-sm']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                </ul>
                <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
            </div>
        </div>
    </div>
</div>
