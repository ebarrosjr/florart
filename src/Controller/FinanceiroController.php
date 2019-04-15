<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class FinanceiroController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Compras = TableRegistry::get('Compras');
        $this->Pedidos = TableRegistry::get('Pedidos');
        $this->PedidoProdutos = TableRegistry::get('PedidoProdutos');
        //$this->Vendas = TableRegistry::get('Vendas');
    }

    public function index()
    {
    }

    public function compras()
    {
        $this->paginate = [
            'contain' => ['ItensNotas'=>'MateriaPrimas','Clientes']
        ];
        $compras = $this->paginate($this->Compras);
        $this->set(compact('compras'));
    }

    public function novaCompra()
    {
        $compra = $this->Compras->newEntity();
        if($this->request->is('post'))
        {
            $compra = $this->Compras->patchEntity($compra, $this->request->getData());
            $compra->data .= $this->request->getData('data').' 00:00:00';
            $compra = $this->Compras->save($compra);
            if($compra)
            {
                $itens = $this->request->getData('item');
                $qtd = $this->request->getData('qtd');
                $vlr = $this->request->getData('vlr');
                $total = 0;
                foreach($itens as $k => $v)
                {
                    $this->ItensNota = TableRegistry::get('ItensNotas');
                    $newItemNota = $this->ItensNota->newEntity();
                    $newItemNota->nota_id = $compra->id;
                    $newItemNota->tipo_nota = 'C';
                    $newItemNota->item = $v;
                    $newItemNota->quantidade = $qtd[$k];
                    $newItemNota->valor_unitario = $vlr[$k];
                    $total = $total + $newItemNota->valor_unitario;
                    $this->ItensNota->save($newItemNota);
                }
                $compra->valor_total = $total;  
                $this->Compras->save($compra);
                return $this->redirect(['action'=>'compras']);
            }else{
                die(var_dump($compra));
            }
        }
        $fornecedores = $this->Compras->Clientes->find('list')->where(['tipo IN '=>['A','C']])->order(['nome']);
        $forma_pagamentos = $this->Compras->FormaPagamentos->find('list');
        $tipos = TableRegistry::get('TipoMateriaPrimas')->find('all',['fields'=>['id','nome']]);
        $this->set(compact('compra','fornecedores','forma_pagamentos','tipos'));
    }

    public function pedidos()
    {
        $this->paginate = [
            'contain' => ['Clientes','PedidoProdutos'=>['Produtos','UnidadeMedidas']]
        ];
        $pedidos = $this->paginate($this->Pedidos);
        $this->set(compact('pedidos'));
    }

    public function novoPedido()
    {
        $pedido = $this->Pedidos->newEntity();
        if($this->request->is('post'))
        {
            $dados = $this->request->getData();
            $pedido = $this->Pedidos->newEntity();
            $pedido->cliente_id = $dados['cliente_id'];
            $pedido->data_pedido = parent::acertaData($dados['data_pedido']);
            $pedido->previsao_entrega = parent::acertaData($dados['previsao_entrega']);
            $pedido->situacao = 0;
            $pedido->pago = 0;
            $pedido = $this->Pedidos->save($pedido);
            if($pedido)
            {
                foreach($dados['item'] as $k => $v)
                {
                    $item_pedido = $this->PedidoProdutos->newEntity();
                    $item_pedido->pedido_id = $pedido->id;
                    $item_pedido->produto_id = $v;
                    $item_pedido->quantidade = $dados['qtd'][$v];
                    $item_pedido->unidade_medida_id = $dados['und'][$v];
                    $item_pedido->valor_combinado = $dados['vlr'][$v];
                    if($item_pedido->valor_combinado==0)
                    {
                        $_unidade = TableRegistry::get('UnidadeMedidas',['contains'=>'ParentUnidadeMedidas'])->get($item_pedido->unidade_medida_id);
                        $_valor = TableRegistry::get('Produtos')->get($item_pedido->produto_id);
                        if($_unidade->parent_id!=null){
                            $_mult = $_unidade->fator_multiplicativo;
                        }else{
                            $_mult = 1;
                        }
                        if($_valor->atacado_minimo<=($item_pedido->quantidade/$_mult))
                        {
                            $valor = $_valor->valor_atacado;
                        }else{
                            $valor = $_valor->valor_varejo;
                        }
                        $item_pedido->valor_combinado = $valor;
                    }
                    $item_pedido->entregue = 0;
                    $this->PedidoProdutos->save($item_pedido);
                }
                $this->Flash->success('Pedido salvo com sucesso!');
                return $this->redirect(['action'=>'pedidos']);
            }
        }
        $clientes = $this->Pedidos->clientes->find('list')->where(['tipo IN'=>['C','A']])->order(['nome'=>'desc']);
        $produtos = $this->Pedidos->PedidoProdutos->Produtos->find('list')->order(['nome'=>'desc']);
        $unidades = TableRegistry::get('UnidadeMedidas')->find('list')->order(['nome'=>'desc']);
        $this->set(compact('pedido','clientes','produtos','unidades'));
    }
}
