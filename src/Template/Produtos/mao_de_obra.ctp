<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Produtos<?=$this->Html->link('<i class="fe fe-plus"></i> Novo', ['action'=>'addmao'],['class'=>'btn btn-pill btn-success btn-sm float-right _colorbox','escape'=>false])?></h3>
        </div>
        <div class="card-body">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Por unidade</th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($manufaturas as $m): ?>
                    <tr>
                        <td><?= h($m->nome) ?></td>
                        <td>R$ <?= number_format($m->valor_base,2,',','.') ?></td>
                        <td><?= $m->unidade?'Sim':'Não' ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edtmao', $m->id],['escape'=>false,'class'=>'_colorbox']) ?>
                            <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['action' => 'delmao', $m->id], ['confirm' => __('Are you sure you want to delete # {0}?', $m->id),'escape'=>false]) ?>
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
