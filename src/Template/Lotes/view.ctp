<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lote $lote
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Lote'), ['action' => 'edit', $lote->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Lote'), ['action' => 'delete', $lote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lote->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Lotes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lote'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Produtos'), ['controller' => 'Produtos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Produto'), ['controller' => 'Produtos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="lotes view large-9 medium-8 columns content">
    <h3><?= h($lote->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Produto') ?></th>
            <td><?= $lote->has('produto') ? $this->Html->link($lote->produto->id, ['controller' => 'Produtos', 'action' => 'view', $lote->produto->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= h($lote->numero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($lote->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($lote->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Validade') ?></th>
            <td><?= h($lote->validade) ?></td>
        </tr>
    </table>
</div>
