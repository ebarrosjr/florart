<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TipoMateriaPrima $tipoMateriaPrima
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tipo Materia Prima'), ['action' => 'edit', $tipoMateriaPrima->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tipo Materia Prima'), ['action' => 'delete', $tipoMateriaPrima->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tipoMateriaPrima->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tipo Materia Primas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tipo Materia Prima'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Materia Primas'), ['controller' => 'MateriaPrimas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Materia Prima'), ['controller' => 'MateriaPrimas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tipoMateriaPrimas view large-9 medium-8 columns content">
    <h3><?= h($tipoMateriaPrima->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($tipoMateriaPrima->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tipoMateriaPrima->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Materia Primas') ?></h4>
        <?php if (!empty($tipoMateriaPrima->materia_primas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Tipo Materia Prima Id') ?></th>
                <th scope="col"><?= __('Nome') ?></th>
                <th scope="col"><?= __('Estoque Minimo') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tipoMateriaPrima->materia_primas as $materiaPrimas): ?>
            <tr>
                <td><?= h($materiaPrimas->id) ?></td>
                <td><?= h($materiaPrimas->tipo_materia_prima_id) ?></td>
                <td><?= h($materiaPrimas->nome) ?></td>
                <td><?= h($materiaPrimas->estoque_minimo) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MateriaPrimas', 'action' => 'view', $materiaPrimas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MateriaPrimas', 'action' => 'edit', $materiaPrimas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MateriaPrimas', 'action' => 'delete', $materiaPrimas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $materiaPrimas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
