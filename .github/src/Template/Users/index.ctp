<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Usuários<?=$this->Html->link('<i class="fe fe-plus"></i> Novo', ['action'=>'add'],['class'=>'btn btn-pill btn-success btn-sm float-right','escape'=>false])?></h3>
        </div>
        <div class="card-body">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Ativo</th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $this->Number->format($user->id) ?></td>
                        <td><?= h($user->nome) ?></td>
                        <td><?= h($user->email) ?></td>
                        <td>
                            <label class="custom-switch">
                                <input type="checkbox" onchange="window.location.href='<?=$this->Url->build(['controller'=>'users', 'action'=>'ativar', $user->id]);?>'" name="custom-switch-checkbox" class="custom-switch-input" <?=($user->active?'checked':'')?> >
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Ativo</span>
                            </label>              
                        </td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fe fe-eye"></i>', ['action' => 'view', $user->id],['escape'=>false]) ?>
                            <?= $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edit', $user->id],['escape'=>false]) ?>
                            <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id),'escape'=>false]) ?>                        
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
