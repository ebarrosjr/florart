<div class="col-12">
    <div class="card">
        <?= $this->Form->create($produto) ?>
        <div class="card-header">
            <h3 class="card-title">Novo produto</h3>
        </div>
        <div class="card-body">
            <div class="row">
            <div class="col-md-3">
                <?php
                echo $this->Form->control('grupo_produto_id', ['options' => $grupoProdutos, 'empty' => true,'class'=>'form-control']);
                ?>
                </div>
                <div class="col-md-9">
                <?php
                echo $this->Form->control('nome',['class'=>'form-control']);
                ?>
                </div>
                <div class="col-md-4">
                <?php
                echo $this->Form->control('valor_varejo',['class'=>'form-control']);
                ?>
                </div>
                <div class="col-md-4">
                <?php
                echo $this->Form->control('valor_atacado',['class'=>'form-control']);
                ?>
                </div>
                <div class="col-md-4">
                <?php
                echo $this->Form->control('estoque_minimo',['class'=>'form-control']);
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
