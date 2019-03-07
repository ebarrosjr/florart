<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tipos de Matéria-primas<?=$this->Html->link('<i class="fe fe-plus"></i> Novo', ['action'=>'add'],['class'=>'btn btn-pill btn-success btn-sm float-right','escape'=>false])?></h3>
        </div>
        <div class="card-body">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tipoMateriaPrimas as $tipoMateriaPrima): ?>
                    <tr>
                        <td><?= $this->Number->format($tipoMateriaPrima->id) ?></td>
                        <td><?= h($tipoMateriaPrima->nome) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fe fe-eye"></i>', ['action' => 'view', $tipoMateriaPrima->id],['escape'=>false]) ?>
                            <?= $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edit', $tipoMateriaPrima->id],['escape'=>false]) ?>
                            <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['action' => 'delete', $tipoMateriaPrima->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tipoMateriaPrima->id),'escape'=>false]) ?>                        
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
