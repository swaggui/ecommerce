<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Produto $produto
 */
?>
<div class="row" style="background-color: rgb(47, 80, 61); padding: 20px; color: white;">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Produto'), ['action' => 'edit', $produto->id], ['class' => 'side-nav-item', 'style' => 'color: rgb(198, 159, 104);']) ?>
            <?= $this->Form->postLink(__('Delete Produto'), ['action' => 'delete', $produto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $produto->id), 'class' => 'side-nav-item', 'style' => 'color: rgb(198, 159, 104);']) ?>
            <?= $this->Html->link(__('List Produtos'), ['action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color: rgb(198, 159, 104);']) ?>
            <?= $this->Html->link(__('New Produto'), ['action' => 'add'], ['class' => 'side-nav-item', 'style' => 'color: rgb(198, 159, 104);']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="produtos view content">
            <h3><?= h($produto->id) ?></h3>
            <table style="color: white;">
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($produto->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Preco') ?></th>
                    <td><?= $this->Number->format($produto->preco) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estoque') ?></th>
                    <td><?= $this->Number->format($produto->estoque) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($produto->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($produto->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Nome') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($produto->nome)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Descricao') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($produto->descricao)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Imagem') ?></strong>
                <blockquote>
                    <?= $this->Html->image($produto->imagem, ['alt' => 'Imagem do Produto', 'style' => 'width: 100px; height: auto;']); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Tamanho') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($produto->tamanho)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Cor') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($produto->cor)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Categoria') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($produto->categoria)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
