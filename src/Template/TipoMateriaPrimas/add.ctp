<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TipoMateriaPrima $tipoMateriaPrima
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tipo Materia Primas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Materia Primas'), ['controller' => 'MateriaPrimas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Materia Prima'), ['controller' => 'MateriaPrimas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tipoMateriaPrimas form large-9 medium-8 columns content">
    <?= $this->Form->create($tipoMateriaPrima) ?>
    <fieldset>
        <legend><?= __('Add Tipo Materia Prima') ?></legend>
        <?php
            echo $this->Form->control('nome');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
