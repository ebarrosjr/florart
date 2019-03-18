<div class="col-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tipos de Matéria-primas<?=$this->Html->link('<i class="fe fe-plus"></i> Novo', ['action'=>'add'],['class'=>'btn btn-pill btn-success btn-sm float-right _colorbox','escape'=>false])?></h3>
        </div>
        <div class="card-body">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th scope="col">Matéria prima</th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tipoMateriaPrimas as $tipoMateriaPrima): ?>
                    <tr>
                        <td><?= $tipoMateriaPrima->nome ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edit', $tipoMateriaPrima->id],['escape'=>false]) ?>
                            <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['action' => 'delete', $tipoMateriaPrima->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tipoMateriaPrima->id),'escape'=>false]) ?>                        
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tipos de produtos<?=$this->Html->link('<i class="fe fe-plus"></i> Novo', ['action'=>'addTipo'],['class'=>'btn btn-pill btn-success btn-sm float-right _colorbox','escape'=>false])?></h3>
        </div>
        <div class="card-body">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th scope="col">Tipo</th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tipoProdutos as $tipo): ?>
                    <tr>
                        <td><?= $tipo->nome ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edit', $tipo->id],['escape'=>false]) ?>
                            <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['action' => 'delete', $tipo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tipo->id),'escape'=>false]) ?>                        
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Grupos de produtos<?=$this->Html->link('<i class="fe fe-plus"></i> Novo', ['action'=>'addGrupo'],['class'=>'btn btn-pill btn-success btn-sm float-right _colorbox','escape'=>false])?></h3>
        </div>
        <div class="card-body">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th scope="col">Grupo</th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($grupoProdutos as $grupo): ?>
                    <tr>
                        <td><?= $grupo->nome ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edit', $grupo->id],['escape'=>false]) ?>
                            <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['action' => 'delete', $grupo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grupo->id),'escape'=>false]) ?>                        
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
