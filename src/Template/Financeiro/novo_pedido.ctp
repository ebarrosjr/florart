<div class="col-12">
    <div class="card">
        <?= $this->Form->create($pedido) ?>
        <div class="card-header">
            <h3 class="card-title">Novo pedido</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?=$this->Form->control('cliente_id',['label'=>'Cliente','empty'=>' - Selecione o cliente - ','class'=>'form-control', 'options'=>$clientes, 'required']);?>
                </div>
                <div class="col-md-3">
                    <?=$this->Form->control('data_pedido',['label'=>'Data do pedido','class'=>'form-control','type'=>'text']);?>
                </div>
                <div class="col-md-3">
                    <?=$this->Form->control('previsao_entrega',['label'=>'Previsão de entrega','class'=>'form-control','type'=>'text']);?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3 p-2" style="background-color:#eeeeee">
                        <div class="row">
                            <div class="col-md-5">
                                <?=$this->Form->control('produto_id',['label'=>'Produto','class'=>'form-control']);?>
                            </div>
                            <div class="col-md-2">
                                <label for="quantidade">Quantidade</label>
                                <input type="text" name="quantidade" id="quantidade" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <?=$this->Form->control('unidade', ['label'=>'Unidade', 'options'=>$unidades, 'empty'=>' - selecione - ','class'=>'form-control']);?>
                            </div>
                            <div class="col-md-2">
                                <label for="valor">Valor <b>unitário</b> combinado</label>
                                <input type="text" name="valor" id="valor" class="form-control">
                            </div>
                            <div class="col-md-1 mt-6">
                                <button class="btn btn-outline btn-sm" type="button" id="addmp" nome="addmp"><i class="fe fe-plus"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table card-table table-vcenter" id="itens-nota">
                                    <thead>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Unidade</th>
                                        <th>Valor</th>
                                        <th class="actions"></th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <?=$this->Form->button(' Gravar ', ['class'=>'btn btn-success']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
<script>
    $(document).on('change','#tipo',function(){
        obj = $(this);
        $.ajax({
            type: "POST",
            url: "<?=$this->Url->build(['controller'=>'MateriaPrimas', 'action'=>'busca'])?>",
            async: true,
            data: {tipo_id: obj.val()},
            dataType: "json",
            beforeSend: function(xhr){
                xhr.setRequestHeader('X-CSRF-Token', <?=json_encode($this->request->getParam('_csrfToken'));?>);
            },
            success: function(json){
                var html = "<option value=''> - Selecione uma matéria-prima - </option>";
                $.each(json.retorno, function(i,item){
                    html += "<option value='"+item.id+"'>"+item.nome+"</option>";
                });
                $('#materia').html(html);
            }
        });         
    });

    $(document).on('click', '#addmp', function(){
        if(($('#materia').val()=='')||($('#quantidade').val()=='')||($('#valor').val()=='')){
            alert('Prencha todos os campos antes!');
        }else{
            var _linha = '<tr><td>'+$('#produto-id option:selected').text()+'<input type="hidden" name="item[]" value="'+$('#produto-id option:selected').val()+'"><input type="hidden" name="qtd['+$('#produto-id option:selected').val()+']" value="'+$('#quantidade').val()+'"><input type="hidden" name="und['+$('#produto-id option:selected').val()+']" value="'+$('#unidade option:selected').val()+'"><input type="hidden" name="vlr['+$('#produto-id option:selected').val()+']" value="'+$('#valor').val()+'"></td><td>'+$('#quantidade').val()+'</td><td>'+$('#unidade option:selected').text()+'</td><td>R$ '+$('#valor').val()+'</td><td class="actions"><i class="fe fe-trash" style="color:red" id="n"></i></td></tr>';
            $('#itens-nota').append(_linha);
            $('#produto-id').val(null);
            $('#unidade').val(null);
            $('#quantidade').val('');
            $('#valor').val('');
        }
    });
</script>