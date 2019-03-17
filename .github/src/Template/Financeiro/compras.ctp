<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Compras realizadas<?=$this->Html->link('<i class="fe fe-plus"></i> Nova compra', ['action'=>'novaCompra'],['class'=>'btn btn-pill btn-success btn-sm float-right','escape'=>false])?></h3>
        </div>
        <div class="card-body">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Fornecedor</th>
                        <th scope="col">Data</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($compras as $c)
                    {
                    ?>
                    <tr>
                        <td><i class="detalhar fe fe-arrow-down-circle" data-attr="det_<?=$c->id;?>"></i> <?=$c->id;?></td>
                        <td><?=$c->cliente->nome;?></td>
                        <td><?=$c->data;?></td>
                        <td><?=$c->valor_total;?></td>
                    </tr>
                    <tr id="det_<?=$c->id;?>" style="display:none">
                        <td colspan="4">
                            <div class="jumbotron p-2">
                                <table class="table card-table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th scope="col">#ID</th>
                                            <th scope="col">Item</th>
                                            <th scope="col">Quantidade</th>
                                            <th scope="col">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($c->itens_notas as $i)
                                        {
                                        ?>
                                        <tr>
                                            <td><?=$i->id;?></td>
                                            <td><?=$i->materia_prima->nome;?></td>
                                            <td><?=$i->quantidade;?></td>
                                            <td>R$ <?=number_format($i->valor_unitario,2,',','.')?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex align-items-center mb-4">
        <ul class="pagination">
            <?= $this->Paginator->first('<<') ?>
            <?= $this->Paginator->prev('<') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('>') ?>
            <?= $this->Paginator->last('>>') ?>
        </ul>
        <div class="page-total-text"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></div>
    </div>
</div>
<script>
    $(document).on('click','.detalhar',function(){
        $('#'+$(this).attr('data-attr')).toggle(200);
    });
</script>