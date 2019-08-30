<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Unidades de medidas<?=$this->Html->link('<i class="fe fe-plus"></i> Novo', ['action'=>'add'],['class'=>'btn btn-pill btn-success btn-sm float-right','escape'=>false])?></h3>
        </div>
        <div class="card-body">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th scope="col">nome</th>
                        <th scope="col">sigla</th>
                        <th scope="col">Unidade base</th>
                        <th scope="col">Multiplicador</th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($unidades as $unidade): ?>
                    <tr>
                        <td><?= $unidade->nome ?></td>
                        <td><?= $unidade->sigla ?></td>
                        <td><?= $unidade->parent_unidade_medida!=null?$unidade->parent_unidade_medida->nome:'' ?></td>
                        <td><?= $unidade->fator_multiplicativo ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $unidade->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $unidade->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $unidade->id], ['confirm' => __('Are you sure you want to delete # {0}?', $unidade->id)]) ?>
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
