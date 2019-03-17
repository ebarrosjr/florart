<div class="col-12">
    <div class="card">
        <?= $this->Form->create($materiaPrima) ?>
        <div class="card-header">
            <h3 class="card-title">Nova matéria-prima</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?=$this->Form->control('nome',['class'=>'form-control', 'required']);?>
                </div>
                <div class="col-md-4">
                    <?=$this->Form->control('tipo_materia_prima_id',['label'=>'Tipo','options'=>$tipoMateriaPrimas,'class'=>'form-control']);?>
                </div>
                <div class="col-md-2">
                    <?=$this->Form->control('estoque_minimo',['label'=>'Estoque mínimo','class'=>'form-control'])?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <?=$this->Form->button(' Gravar ', ['class'=>'btn btn-success']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>