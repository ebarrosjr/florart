<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class ProdutosController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'contain' => ['GrupoProdutos']
        ];
        $produtos = $this->paginate($this->Produtos);
        $this->set(compact('produtos'));
    }

    public function fabrica()
    {
        $this->Fabricacao = TableRegistry::get('Fabricacao');
        $lotes = $this->paginate($this->Fabricacao->find('all')->contain(['Lotes','Produtos']));
        $this->set(compact('lotes'));
    }

    public function fabricar()
    {
        $this->Fabricacao = TableRegistry::get('Fabricacao');
        $fabricacao = $this->Fabricacao->newEntity();
        if($this->request->is('post'))
        {
            $us = $this->request->getData('user_id');
            $pf = $this->request->getData('prefabricacao_id');
            $mo = $this->request->getData('manufatura_id');
            $mp = $this->request->getData('materia_prima_id');
            $qt = $this->request->getData('qtd_usado');
            $vc = $this->request->getData('valor_combinado');
            $un = $this->request->getData('unitario');
            $di = $this->request->getData('data_inicio');
            $dados['produto_id'] = $this->request->getData('produto_id');
            $dados['quantidade'] = $this->request->getData('quantidade');
            $dados['unidade_medida_id'] = $this->request->getData('unidade_medida_id');
            $dados['data_fabricacao'] = $this->request->getData('data_fabricacao')!=""?parent::acertaData($this->request->getData('data_fabricacao'))." 00:00":null;
            $dados['data_validade'] = $this->request->getData('data_validade')!=""?parent::acertaData($this->request->getData('data_validade'))." 00:00":null;
            $fabricacao = $this->Fabricacao->patchEntity($fabricacao, $dados);
            $fabricacao = $this->Fabricacao->save($fabricacao);
            if($fabricacao){
                $this->IFz = TableRegistry::get('ItensFinalizacao');
                foreach($qt as $k=>$v)
                {
                    $item_producao = $this->IFz->newEntity();
                    $ifz['fabricacao_id'] = $fabricacao->id;       
                    $ifz['prefabricacao_id'] = $pf[$k];       
                    $ifz['manufatura_id']    = $mo[$k];       
                    $ifz['materia_prima_id'] = $mp[$k]; 
                    $ifz['user_id']          = $us[$k];
                    $ifz['quantidade']       = $v; 
                    $ifz['valor_combinado']  = $vc[$k];
                    $ifz['unitario']         = $un[$k];
                    $ifz['data_inicio']      = $di[$k]!=""?parent::acertaData($di[$k]):null;
                    $item_producao = $this->IFz->patchEntity($item_producao,$ifz);
                    $item_producao = $this->IFz->save($item_producao);
                }
                $this->Flash->success('Processo de fabricação gravado com sucesso!');
                return $this->redirect(['action'=>'Fabrica']);
            }
        }
        $medidas = TableRegistry::get('UnidadeMedidas')->find('list');
        $grupo_produtos = TableRegistry::get('GrupoProdutos')->find('list');
        $tipo_produtos = TableRegistry::get('TipoProdutos')->find('list');
        $produtos = TableRegistry::get('Produtos')->find('list');
        $usuarios = TableRegistry::get('Users')->find('list')->where(['active'=>1]);
        $manufaturas = TableRegistry::get('Manufaturas')->find('list');
        $mp = TableRegistry::get('MateriaprimaDisponiveis')->find('list');
        $pf = TableRegistry::get('Pflivres')->find('list');
        $this->set(compact('fabricacao','usuarios','manufaturas','pf','mp','grupo_produtos','tipo_produtos','produtos','medidas'));        
    }

    public function finalizar($id)
    {
        $_F = TableRegistry::get('Fabricacao');
        $_L = TableRegistry::get('Lotes');
        $produto = $_F->get($id,['contain'=>'Produtos']);
        if($produto->finalizado!=1){
            $lote = ($produto->grupo_produto_id!=null?'G'.str_pad($produto->grupo_produto_id,3,STR_PAD_LEFT).'P'.str_pad($produto->id,3,'0',STR_PAD_LEFT):'P'.str_pad($produto->id,6,'0',STR_PAD_LEFT)).date('Ymd');
            $produto->finalizado = 1;
            $_F->save($produto);
            $_lote = $_L->newEntity();
            $_lote->fabricacao_id = $produto->id;
            $_lote->validade = $produto->data_validade!=''?$produto->data_validade:date('Y-m-d', strtotime($produto->data_fabricacao.' + 6 months'));
            $_lote->quantidade = $produto->quantidade;
            $_lote->unidade_medida_id = $produto->unidade_medida_id;
            $nl = $_L->save($_lote);
            $_lote->numero = $lote.'-'.$nl->id;
            $nl = $_L->save($_lote);
            $this->Flash->success('O processo de fabricação foi finalizado e o lote '.$nl->numero.' foi criado!');
        }else{
            $this->Flash->error('O processo de fabricação que deseja finalizar já foi finalizado!');
        }
        return $this->redirect(['action'=>'fabrica']);
    }

    public function preFabrica()
    {
        $this->PreFabricacao = TableRegistry::get('Prefabricacao');
        $pf = $this->PreFabricacao->find('all');
        $this->paginate = [
            'contain' => ['Produtos','TipoProdutos','GrupoProdutos','UnidadeMedidas']
        ];
        $produtos = $this->paginate($pf);
        $this->set(compact('pf'));
    }

    public function preFabricar()
    {
        $this->PreFabricacao = TableRegistry::get('Prefabricacao');
        $preFabricacao = $this->PreFabricacao->newEntity();
        if($this->request->is('post'))
        {
            if($this->request->getData('grupo_produto_id')==""
               && $this->request->getData('tipo_produto_id')==""
               && $this->request->getData('produto_id')=="")
            {
                $this->Flash->error('Você precisa dizer o que está fazendo: Grupo, Tipo ou Produto!');
            }else{
                $us = $this->request->getData('user_id');
                $mo = $this->request->getData('manufatura_id');
                $mp = $this->request->getData('materia_prima_id');
                $qt = $this->request->getData('qtd_usado');
                $vc = $this->request->getData('valor_combinado');
                $un = $this->request->getData('unitario');
                $di = $this->request->getData('data_inicio');
                $dados['produto_id'] = $this->request->getData('produto_id');
                $dados['grupo_produto_id'] = $this->request->getData('grupo_produto_id');
                $dados['tipo_produto_id'] = $this->request->getData('tipo_produto_id');
                $dados['nome'] = $this->request->getData('nome');
                $dados['quantidade'] = $this->request->getData('quantidade');
                $dados['unidade_medida_id'] = $this->request->getData('unidade_medida_id');
                $dados['data_fabricacao'] = $this->request->getData('data_fabricacao')!=""?parent::acertaData($this->request->getData('data_fabricacao'))." 00:00":null;
                $dados['data_validade'] = $this->request->getData('data_validade')!=""?parent::acertaData($this->request->getData('data_validade'))." 00:00":null;
                $preFabricacao = $this->PreFabricacao->patchEntity($preFabricacao, $dados);
                $preFabricacao = $this->PreFabricacao->save($preFabricacao);
                if($preFabricacao){
                    $this->IPr = TableRegistry::get('ItensProducao');
                    foreach($qt as $k=>$v)
                    {
                        $item_producao = $this->IPr->newEntity();
                        $item_producao->prefabricacao_id = $preFabricacao->id;       
                        $item_producao->manufatura_id    = $mo[$k];       
                        $item_producao->materia_prima_id = $mp[$k]; 
                        $item_producao->user_id          = $us[$k];
                        $item_producao->quantidade       = $v; 
                        $item_producao->valor_combinado  = $vc[$k];
                        $item_producao->unitario         = $un[$k];
                        $item_producao->data_inicio      = $di[$k]!=""?parent::acertaData($di[$k]):null;
                        $this->IPr->save($item_producao);
                    }
                    $this->Flash->success('Processo de pré-fabricação gravado com sucesso!');
                    return $this->redirect(['action'=>'preFabrica']);
                }
            }
        }
        $medidas = TableRegistry::get('UnidadeMedidas')->find('list');
        $grupo_produtos = TableRegistry::get('GrupoProdutos')->find('list');
        $tipo_produtos = TableRegistry::get('TipoProdutos')->find('list');
        $produtos = TableRegistry::get('Produtos')->find('list');
        $usuarios = TableRegistry::get('Users')->find('list')->where(['active'=>1]);
        $manufaturas = TableRegistry::get('Manufaturas')->find('list');
        $mp = TableRegistry::get('MateriaprimaDisponiveis')->find('list');
        $this->set(compact('preFabricacao','usuarios','manufaturas','mp','grupo_produtos','tipo_produtos','produtos','medidas'));
    }

    public function maoDeObra()
    {
        $this->Manufaturas = TableRegistry::get('Manufaturas');
        $manufaturas = $this->paginate($this->Manufaturas);
        $this->set(compact('manufaturas'));
    }

    public function addmao()
    {
        $this->Manufaturas = TableRegistry::get('Manufaturas');
        $mao_de_obra = $this->Manufaturas->newEntity();
        if ($this->request->is('post')) {
            $mao_de_obra = $this->Manufaturas->patchEntity($mao_de_obra, $this->request->getData());
            if ($this->Manufaturas->save($mao_de_obra)) {
                $this->Flash->success(__('The produto has been saved.'));

                return $this->redirect(['action' => 'mao-de-obra']);
            }
            $this->Flash->error(__('The produto could not be saved. Please, try again.'));
        }
        $this->set(compact('mao_de_obra'));
    }

    public function edtmao($id=null)
    {
        $this->Manufaturas = TableRegistry::get('Manufaturas');
        $mao_de_obra = $this->Manufaturas->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mao_de_obra = $this->Manufaturas->patchEntity($mao_de_obra, $this->request->getData());
            if ($this->Manufaturas->save($mao_de_obra)) {
                $this->Flash->success(__('The produto has been saved.'));

                return $this->redirect(['action' => 'mao-de-obra']);
            }
            $this->Flash->error(__('The produto could not be saved. Please, try again.'));
        }
        $this->set(compact('mao_de_obra'));
    }

    public function delmao($id = null)
    {
        $this->Manufaturas = TableRegistry::get('Manufaturas');
        $this->request->allowMethod(['post', 'delete']);
        $mao_de_obra = $this->Manufaturas->get($id);
        if ($this->Manufaturas->delete($mao_de_obra)) {
            $this->Flash->success(__('The produto has been deleted.'));
        } else {
            $this->Flash->error(__('The produto could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'maoDeObra']);
    }

    public function add()
    {
        $produto = $this->Produtos->newEntity();
        if ($this->request->is('post')) {
            $produto = $this->Produtos->patchEntity($produto, $this->request->getData());
            if ($this->Produtos->save($produto)) {
                $this->Flash->success(__('The produto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The produto could not be saved. Please, try again.'));
        }
        $grupoProdutos = $this->Produtos->GrupoProdutos->find('list', ['limit' => 200]);
        $this->set(compact('produto', 'grupoProdutos'));
    }

    public function edit($id = null)
    {
        $produto = $this->Produtos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $produto = $this->Produtos->patchEntity($produto, $this->request->getData());
            if ($this->Produtos->save($produto)) {
                $this->Flash->success(__('The produto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The produto could not be saved. Please, try again.'));
        }
        $grupoProdutos = $this->Produtos->GrupoProdutos->find('list', ['limit' => 200]);
        $this->set(compact('produto', 'grupoProdutos'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $produto = $this->Produtos->get($id);
        if ($this->Produtos->delete($produto)) {
            $this->Flash->success(__('The produto has been deleted.'));
        } else {
            $this->Flash->error(__('The produto could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
