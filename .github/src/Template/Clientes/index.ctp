<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?=(isset($titulo)?'Fornecedores':'Clientes').$this->Html->link('<i class="fe fe-plus"></i> Novo', ['action'=>'add'],['class'=>'btn btn-pill btn-success btn-sm float-right','escape'=>false])?></h3>
        </div>
        <div class="card-body">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Ativo</th>
                        <th scope="col" class="actions">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= $this->Number->format($cliente->id) ?></td>
                        <td><?= h($cliente->nome) ?></td>
                        <td><?= h($cliente->telefone) ?></td>
                        <td><?= h($cliente->email) ?></td>
                        <td>
                            <label class="custom-switch">
                                <input type="checkbox" onchange="window.location.href='<?=$this->Url->build(['controller'=>'clientes', 'action'=>'ativar', $cliente->id]);?>'" name="custom-switch-checkbox" class="custom-switch-input" <?=($cliente->active?'checked':'')?> >
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Ativo</span>
                            </label>              
                        </td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fe fe-eye"></i>', ['action' => 'view', $cliente->id],['escape'=>false]) ?>
                            <?= $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edit', $cliente->id],['escape'=>false]) ?>
                            <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['action' => 'delete', $cliente->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cliente->id),'escape'=>false]) ?>
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