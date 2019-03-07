<div class="col-12">
    <div class="card">
        <?= $this->Form->create($cliente) ?>
        <div class="card-header">
            <h3 class="card-title">Novo cliente / fornecedor</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <?=$this->Form->control('nome',['class'=>'form-control', 'required']);?>
                </div>
                <div class="col-md-4">
                    <?=$this->Form->control('cpfcnpj',['label'=>'CPF/CNPJ','class'=>'form-control']);?>
                </div>
                <div class="col-md-10">
                    <?=$this->Form->control('razao_social',['label'=>'Razão Social','class'=>'form-control']);?>
                </div>
                <div class="col-md-2">
                    <?=$this->Form->control('tipo',['label'=>'Tipo','options'=>['C'=>'Cliente','F'=>'Fornecedor','A'=>'Ambos'],'class'=>'form-control']);?>
                </div>
                <div class="col-md-4">
                    <?=$this->Form->control('endereco',['label'=>'Razão Social','class'=>'form-control']);?>
                </div>
                <div class="col-md-4">
                    <?=$this->Form->control('telefone',['label'=>'Razão Social','class'=>'form-control']);?>
                </div>
                <div class="col-md-4">
                    <?=$this->Form->control('email',['label'=>'Razão Social','class'=>'form-control']);?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <?=$this->Form->button(' Gravar ', ['class'=>'btn btn-success']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
