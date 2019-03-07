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
}
