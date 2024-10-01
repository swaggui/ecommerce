<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Produto $produto
 */
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header" style="background-color: rgb(198, 159, 104); color: white;">
                    <h3 class="text-center"><?= $this->request->getParam('action') === 'add' ? __('Add Produto') : __('Edit Produto') ?></h3>
                </div>
                <div class="card-body" style="background-color: rgb(47, 80, 61); color: white;">
                    <?= $this->Form->create($produto, ['type' => 'file']) ?>
                    <fieldset>
                        <legend style="color: white;"><?= $this->request->getParam('action') === 'add' ? __('Add Produto') : __('Edit Produto') ?></legend>
                        <?php
                        echo $this->Form->control('nome', ['class' => 'form-control mb-3']);
                        echo $this->Form->control('descricao', ['class' => 'form-control mb-3']);
                        echo $this->Form->control('preco', ['class' => 'form-control mb-3']);
                        echo $this->Form->control('estoque', ['class' => 'form-control mb-3']);
                        echo $this->Form->control('imagem', ['type' => 'file', 'class' => 'form-control mb-3']);
                        echo $this->Form->control('tamanho', ['class' => 'form-control mb-3']);
                        echo $this->Form->control('cor', ['class' => 'form-control mb-3']);
                        echo $this->Form->control('categoria', ['class' => 'form-control mb-3']);
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
