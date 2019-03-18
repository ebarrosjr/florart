<div class="col-12">
    <?=$this->Form->create($preFabricacao);?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Novo processo inicial de fabricação</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <?=$this->Form->control('grupo_produto_id',['class'=>'form-control']);?>
                </div>
                <div class="col-md-2">
                    <?=$this->Form->control('tipo_produto_id',['class'=>'form-control']);?>
                </div>
                <div class="col-md-2">
                    <?=$this->Form->control('produto_id',['class'=>'form-control']);?>
                </div>
                <div class="col-md-6">
                    <?=$this->Form->control('nome',['class'=>'form-control']);?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <?=$this->Form->control('data_fabricacao',['label'=>'Data de fabricação','type'=>'text','class'=>'form-control']);?>
                </div>
                <div class="col-md-2">
                    <?=$this->Form->control('data_validade',['label'=>'Validade inicial','type'=>'text','class'=>'form-control']);?>
                </div>
                <div class="col-md-2">
                    <?=$this->Form->control('quantidade',['type'=>'text','class'=>'form-control']);?>
                </div>
                <div class="col-md-2">
                    <?=$this->Form->control('unidade_medida_id',['label'=>'Unidade de medida','class'=>'form-control']);?>
                </div>
                <div class="col-md-4 text-right">
                    <button type="button" id="add-material" class="mt-6 btn btn-warning btn-mini"> Adicionar item ao processo </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Materias e mão-de-obra utilizados</h5>
            <div class="materiais">
                <table class="table table-condensed">
                    <thead>
                        <tr>
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
                        <tr>
                            <?php
                            $mp = [
                                1 => 'Frascos (1.000 unidades) - Casa das Essências [15/03/2019]',
                                2 => 'Essência laranjeira (780 ml) - Casa das Essências [16/03/2019]',
                                3 => 'Essência rosas (10 ml) - Casa das Essências [16/03/2019]',
                                4 => 'Rótulos (1.360 unidades) - Gráfica do Érick [25/02/2019]',
                            ];
                            ?>
                            <td style="width:200px"><?=$this->Form->control('materia_prima_id[]',['label'=>false,'class'=>'form-control','options'=>$mp,'empty'=>' - N/A - '])?></td>
                            <td><?=$this->Form->control('manufatura_id[]',['label'=>false,'class'=>'form-control','options'=>$manufaturas,'empty'=>' - N/A - '])?></td>
                            <td><?=$this->Form->control('user_id[]',['label'=>false,'class'=>'form-control','options'=>$usuarios, 'empty'=>' - N/A - '])?></td>
                            <td style="width:60px"><?=$this->Form->control('quantidade[]',['label'=>false,'class'=>'form-control'])?></td>
                            <td style="width:150px"><?=$this->Form->control('valor_combinado[]',['label'=>false,'class'=>'form-control'])?></td>
                            <td><?=$this->Form->control('unitario[]',['label'=>false,'class'=>'form-control','options'=>['1'=>'Sim','0'=>'Não']])?></td>
                            <td style="width:150px"><?=$this->Form->control('data_inicio[]',['label'=>false,'class'=>'form-control'])?></td>
                            <td style="width:20px;padding-top:20px" class="text-center"><i class="fe fe-trash text-danger"></i></td>
                        </tr>
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