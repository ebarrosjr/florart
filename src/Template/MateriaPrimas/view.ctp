<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MateriaPrima $materiaPrima
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Materia Prima'), ['action' => 'edit', $materiaPrima->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Materia Prima'), ['action' => 'delete', $materiaPrima->id], ['confirm' => __('Are you sure you want to delete # {0}?', $materiaPrima->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Materia Primas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Materia Prima'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tipo Materia Primas'), ['controller' => 'TipoMateriaPrimas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tipo Materia Prima'), ['controller' => 'TipoMateriaPrimas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="materiaPrimas view large-9 medium-8 columns content">
    <h3><?= h($materiaPrima->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tipo Materia Prima') ?></th>
            <td><?= $materiaPrima->has('tipo_materia_prima') ? $this->Html->link($materiaPrima->tipo_materia_prima->id, ['controller' => 'TipoMateriaPrimas', 'action' => 'view', $materiaPrima->tipo_materia_prima->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($materiaPrima->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($materiaPrima->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estoque Minimo') ?></th>
            <td><?= $this->Number->format($materiaPrima->estoque_minimo) ?></td>
        </tr>
    </table>
</div>
