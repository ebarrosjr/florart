<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pré-Fabricação<?=$this->Html->link('<i class="fe fe-plus"></i> Novo', ['action'=>'pre-fabricar'],['class'=>'btn btn-pill btn-success btn-sm float-right','escape'=>false])?></h3>
        </div>
        <div class="card-body">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th scope="col">Grupo, Tipo ou Produto</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Data de fabricação</th>
                        <th scope="col">Validade</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pf as $produto): ?>
                    <tr>
                        <td>
                        <?php
                        if($produto->produto_id!='')
                        {
                            print '[P] '.$produto->produto->nome;
                        }
                        if($produto->tipo_produto_id!='')
                        {
                            print '[TP] '.$produto->tipo_produto->nome;
                        }
                        if($produto->grupo_produto_id!='')
                        {
                            print '[GP] '.$produto->grupo_produto->nome;
                        }
                        ?>
                        </td>
                        <td><?= h($produto->nome) ?></td>
                        <td><?= $produto->data_fabricacao ?></td>
                        <td><?= $produto->data_validade ?></td>
                        <td><?= $produto->quantidade ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $produto->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $produto->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $produto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $produto->id)]) ?>
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
 