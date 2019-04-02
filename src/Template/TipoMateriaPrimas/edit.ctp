<div class="card">
    <div class="card-header">
        <h4 class="card-title">Editar</h4>
    </div>
    <div class="card-body">
        <?= $this->Form->create($grtp) ?>
        <fieldset>
            <?php
                echo $this->Form->control('nome',['class'=>'form-control']);
            ?>
            <?php
            if($this->request->getParam('action')=='edtTipo'){
                echo $this->Form->control('codigo_ncn',['class'=>'form-control']);
            }
            ?>
        </fieldset>
        <?= $this->Form->button(' Gravar ', ['class'=>'btn btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
