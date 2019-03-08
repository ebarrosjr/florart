<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Produtos<?=$this->Html->link('<i class="fe fe-plus"></i> Novo', ['action'=>'add'],['class'=>'btn btn-pill btn-success btn-sm float-right','escape'=>false])?></h3>
        </div>
        <div class="card-body">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('grupo_produto_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('valor_varejo') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('valor_atacado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('estoque_minimo') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= $this->Number->format($produto->id) ?></td>
                        <td><?= $produto->has('grupo_produto') ? $this->Html->link($produto->grupo_produto->id, ['controller' => 'GrupoProdutos', 'action' => 'view', $produto->grupo_produto->id]) : '' ?></td>
                        <td><?= h($produto->nome) ?></td>
                        <td><?= $this->Number->format($produto->valor_varejo) ?></td>
                        <td><?= $this->Number->format($produto->valor_atacado) ?></td>
                        <td><?= $this->Number->format($produto->estoque_minimo) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edit', $produto->id],['escape'=>false]) ?>
                            <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['action' => 'delete', $produto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $produto->id),'escape'=>false]) ?>
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
