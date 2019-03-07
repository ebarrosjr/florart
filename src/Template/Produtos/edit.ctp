<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Produto $produto
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $produto->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $produto->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Produtos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Grupo Produtos'), ['controller' => 'GrupoProdutos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grupo Produto'), ['controller' => 'GrupoProdutos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="produtos form large-9 medium-8 columns content">
    <?= $this->Form->create($produto) ?>
    <fieldset>
        <legend><?= __('Edit Produto') ?></legend>
        <?php
            echo $this->Form->control('grupo_produto_id', ['options' => $grupoProdutos, 'empty' => true]);
            echo $this->Form->control('nome');
            echo $this->Form->control('valor_varejo');
            echo $this->Form->control('valor_atacado');
            echo $this->Form->control('estoque_minimo');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
