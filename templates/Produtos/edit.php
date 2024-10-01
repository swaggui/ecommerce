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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $produto->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $produto->id), 'class' => 'side-nav-item', 'style' => 'color: rgb(198, 159, 104);']
            ) ?>
            <?= $this->Html->link(__('List Produtos'), ['action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color: rgb(198, 159, 104);']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="produtos form content">
            <?= $this->Form->create($produto) ?>
            <fieldset>
                <legend><?= __('Edit Produto') ?></legend>
                <?php
                echo $this->Form->control('nome', ['style' => 'background-color: white; color: black;']);
                echo $this->Form->control('descricao', ['style' => 'background-color: white; color: black;']);
                echo $this->Form->control('preco', ['style' => 'background-color: white; color: black;']);
                echo $this->Form->control('estoque', ['style' => 'background-color: white; color: black;']);
                echo $this->Form->control('imagem', ['type' => 'file', 'style' => 'background-color: white; color: black;']);
                echo $this->Form->control('tamanho', ['style' => 'background-color: white; color: black;']);
                echo $this->Form->control('cor', ['style' => 'background-color: white; color: black;']);
                echo $this->Form->control('categoria', ['style' => 'background-color: white; color: black;']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['style' => 'background-color: rgb(198, 159, 104); color: white;']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
