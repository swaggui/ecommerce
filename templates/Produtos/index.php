<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Produto> $produtos
 */
?>
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: rgb(198, 159, 104); color: white;">
            <h3><?= __('Produtos') ?></h3>
            <?= $this->Html->link(__('Adicionar'), ['action' => 'add'], ['class' => 'btn btn-light']) ?>
        </div>
        <div class="card-body" style="background-color: rgb(47, 80, 61); color: white;">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead style="background-color: rgb(198, 159, 104); color: white;">
                    <tr>
                        <th><?= __('ID') ?></th>
                        <th><?= __('Imagem') ?></th>
                        <th><?= __('Nome') ?></th>
                        <th><?= __('Preço') ?></th>
                        <th><?= __('Estoque') ?></th>
                        <th><?= __('Criado') ?></th>
                        <th><?= __('Modificado') ?></th>
                        <th><?= __('Ações') ?></th>
                    </tr>
                    </thead>
                    <tbody style="color: white;">
                    <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td><?= $this->Number->format($produto->id) ?></td>
                            <td><?= $this->Html->image('produtos/' . h($produto->imagem), ['alt' => $produto->nome, 'class' => 'img-thumbnail', 'style' => 'max-width: 100px;']) ?></td>
                            <td><?= h($produto->nome) ?></td>
                            <td><?= $this->Number->format($produto->preco) ?></td>
                            <td><?= $this->Number->format($produto->estoque) ?></td>
                            <td><?= h($produto->created) ?></td>
                            <td><?= h($produto->modified) ?></td>
                            <td>
                                <?= $this->Html->link(__('View'), ['action' => 'view', $produto->id], ['class' => 'btn btn-light btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $produto->id], ['class' => 'btn btn-light btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $produto->id], ['confirm' => __('Are you sure?'), 'class' => 'btn btn-danger btn-sm']) ?>
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
