<div class="col-12">
    <?=$this->Form->create($fabricacao);?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Novo processo de fabricação</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <?=$this->Form->control('produto_id',['options'=>$produtos,'empty'=>' - Selecione - ','required','class'=>'form-control']);?>
                </div>
                <div class="col-md-2">
                    <?=$this->Form->control('data_fabricacao',['label'=>'Data de fabricação','type'=>'text','class'=>'form-control']);?>
                </div>
                <div class="col-md-2">
                    <?=$this->Form->control('data_validade',['label'=>'Validade inicial','type'=>'text','class'=>'form-control']);?>
                </div>
                <div class="col-md-2">
                    <?=$this->Form->control('quantidade',['type'=>'text','class'=>'form-control','required']);?>
                </div>
                <div class="col-md-2">
                    <?=$this->Form->control('unidade_medida_id',['label'=>'Unidade de medida','options'=>$medidas,'empty'=>' - Selecione - ','required','class'=>'form-control']);?>
                </div>
                <div class="col-md-2 text-right">
                    <button type="button" id="add-item" class="mt-6 btn btn-warning btn-mini"> Adicionar item ao processo </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Materias e mão-de-obra utilizados</h5>
            <div class="materiais">
                <table class="table table-condensed" id="itens-usados">
                    <thead>
                        <tr>
                            <th>Pré-Fabricado</th>
                            <th>Materia-prima</th>
                            <th>Mão-de-obra</th>
                            <th>Executor</th>
                            <th>Quantidade</th>
                            <th>Valor combinado</th>
                            <th>Por unidade?</th>
                            <th colspan="2">Data início</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <?=$this->Form->button(' Gravar ', ['class'=>'btn btn-success']);?>
                </div>
            </div>
        </div>
    </div>
    <?=$this->Form->end();?>
</div>
<script>
$(document).on('click', '#add-item', function(){
    var _linha = '<tr><td style="width:200px"><?=$this->Form->control('prefabricacao_id[]',['label'=>false,'class'=>'form-control','options'=>$pf,'empty'=>' - N/A - '])?></td><td style="width:200px"><?=$this->Form->control('materia_prima_id[]',['label'=>false,'class'=>'form-control','options'=>$mp,'empty'=>' - N/A - '])?></td><td><?=$this->Form->control('manufatura_id[]',['label'=>false,'class'=>'form-control','options'=>$manufaturas,'empty'=>' - N/A - '])?></td><td><?=$this->Form->control('user_id[]',['label'=>false,'class'=>'form-control','options'=>$usuarios, 'empty'=>' - N/A - '])?></td><td style="width:60px"><?=$this->Form->control('qtd_usado[]',['label'=>false,'class'=>'form-control'])?></td><td style="width:150px"><?=$this->Form->control('valor_combinado[]',['label'=>false,'class'=>'form-control'])?></td><td><?=$this->Form->control('unitario[]',['label'=>false,'class'=>'form-control','options'=>['1'=>'Sim','0'=>'Não']])?></td><td style="width:150px"><?=$this->Form->control('data_inicio[]',['label'=>false,'class'=>'form-control'])?></td><td style="width:20px;padding-top:20px" class="text-center"><i class="fe fe-trash text-danger" onclick="$(this).parent().parent().remove()"></i></td>';
    $('#itens-usados').append(_linha);
});
</script>