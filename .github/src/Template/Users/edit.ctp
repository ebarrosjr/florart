<div class="col-12">
    <div class="card">
        <?= $this->Form->create($user) ?>
        <div class="card-header">
            <h3 class="card-title">Editar usuário</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <?=$this->Form->control('nome',['class'=>'form-control', 'required']);?>
                </div>
                <div class="col-md-4">
                    <?=$this->Form->control('role',['label'=>'tipo','options'=>['A'=>'Administrador','C'=>'Cliente','F'=>'Fornecedor'],'class'=>'form-control']);?>
                </div>
                <div class="col-md-6">
                    <?=$this->Form->control('email',['class'=>'form-control'])?>
                </div>
                <div class="col-md-6">
                    <?=$this->Form->control('password',['class'=>'form-control'])?>
                </div>                
            </div>
        </div>
        <div class="card-footer">
            <?=$this->Form->button(' Gravar ', ['class'=>'btn btn-success']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
