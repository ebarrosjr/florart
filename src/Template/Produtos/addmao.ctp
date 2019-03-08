<div class="col-12">
    <div class="card">
        <?= $this->Form->create($mao_de_obra) ?>
        <div class="card-header">
            <h3 class="card-title">Nova mão-de-obra</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                <?php
                echo $this->Form->control('nome',['class'=>'form-control']);
                ?>
                </div>
                <div class="col-md-2">
                <?php
                echo $this->Form->control('valor_base',['class'=>'form-control']);
                ?>
                </div>
                <div class="col-md-3">
                <?php
                echo $this->Form->control('unidade',['label'=>'Pago por unidade?','options'=>['1'=>'Sim','0'=>'Não'],'class'=>'form-control']);
                ?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <?=$this->Form->button(' Gravar ', ['class'=>'btn btn-success']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
