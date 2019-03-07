<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Matéria-primas<?=$this->Html->link('<i class="fe fe-plus"></i> Novo', ['action'=>'add'],['class'=>'btn btn-pill btn-success btn-sm float-right','escape'=>false])?></h3>
        </div>
        <div class="card-body">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Estoque mínimo</th>
                        <th scope="col" class="actions">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($materiaPrimas as $materiaPrima): ?>
                    <tr>
                        <td><?= $this->Number->format($materiaPrima->id) ?></td>
                        <td><?= $materiaPrima->has('tipo_materia_prima') ? $this->Html->link($materiaPrima->tipo_materia_prima->id, ['controller' => 'TipoMateriaPrimas', 'action' => 'view', $materiaPrima->tipo_materia_prima->id]) : '' ?></td>
                        <td><?= h($materiaPrima->nome) ?></td>
                        <td><?= $this->Number->format($materiaPrima->estoque_minimo) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fe fe-eye"></i>', ['action' => 'view', $materiaPrima->id],['escape'=>false]) ?>
                            <?= $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edit', $materiaPrima->id],['escape'=>false]) ?>
                            <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['action' => 'delete', $materiaPrima->id], ['confirm' => __('Are you sure you want to delete # {0}?', $materiaPrima->id),'escape'=>false]) ?>                        
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex align-items-center mb-4">
        <ul class="pagination">
            <?= $this->Paginator->first('<<') ?>
            <?= $this->Paginator->prev('<') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('>') ?>
            <?= $this->Paginator->last('>>') ?>
        </ul>
        <div class="page-total-text"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></div>
    </div>
</div>
