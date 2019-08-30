<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * Protocolos Controller
 *
 * @property \App\Model\Table\ProtocolosTable $Protocolos
 *
 * @method \App\Model\Entity\Protocolo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProtocolosController extends AppController
{

    //ok
    public function index()
    {
        $this->paginate = [
            'contain' => ['Lojas', 'Andamentos']
        ];

        
        $p = $this->Protocolos->find('all')->order([ 'Protocolos.ativo'=>'desc','Protocolos.datapedido'=>'desc', 'Protocolos.entregue'=>'asc', 'Protocolos.loja_id'=>'asc']);

        /*
        // ---- bloco para somar os pagamentos deste protocolo
            // vejo na tabela pagamentos os valores pagos
            $this->Pagamentos = TableRegistry::get('Pagamentos');
            $pagamento = $this->Pagamentos->find('all')->contain(['Protocolos'])->where(['Pagamentos.protocolo_id ='=>$id]);

            $valorespagos=0;

            if(!empty($pagamentos)){
                
                foreach ($pagamento as $p):
                    $valorespagos=$valorespagos+$p->valor;
                endforeach;
            }
        //------ fim do bloco
        */


        $protocolos = $this->paginate($p);


        $this->set(compact('protocolos'));
    }

    //ok
    //tipoindex
    public function naoentregues()
    {
        $this->paginate = [
            'contain' => ['Lojas', 'Andamentos']
        ];

        
        $p = $this->Protocolos->find('all')->where(['Protocolos.entregue'=>0])->order([ 'Protocolos.ativo'=>'desc','Protocolos.datapedido'=>'desc', 'Protocolos.entregue'=>'asc', 'Protocolos.loja_id'=>'asc']);

        


        $protocolos = $this->paginate($p);


        $this->set(compact('protocolos'));
    }


    //ok
    //tipoindex
    public function naopagos()
    {
        $this->paginate = [
            'contain' => ['Lojas', 'Andamentos']
        ];

        
        $p = $this->Protocolos->find('all')->where(['Protocolos.pago'=>0])->order([ 'Protocolos.ativo'=>'desc','Protocolos.datapedido'=>'desc', 'Protocolos.entregue'=>'asc', 'Protocolos.loja_id'=>'asc']);

        $protocolos = $this->paginate($p);


        $this->set(compact('protocolos'));
    }

    //ok
    public function view($id = null)
    {
        $protocolo = $this->Protocolos->get($id, [
            'contain' => ['Lojas', 'Andamentos', 'Pagamentos', 'Pedidos'=>'Produtos']
        ]);

        $this->Entregas = TableRegistry::get('Entregas');
        $entregas = $this->Entregas->find('all')->contain(['Pedidos'=>'Produtos', 'Lotes', 'Remessas'])->where(['Entregas.protocolo_id ='=>$id])->order(['Entregas.dataentrega'=>'asc', 'Entregas.pedido_id'=>'asc']);


        $this->Pedidos = TableRegistry::get('Pedidos');
        $itens = $this->Pedidos->find('all')->contain(['Produtos'])->where(['Pedidos.protocolo_id ='=>$id]);

        
        

        $this->Pagamentos = TableRegistry::get('Pagamentos');
        $pg = $this->Pagamentos->find('all')->where(['Pagamentos.protocolo_id ='=>$id]);

        
        $this->set(compact('protocolo', 'pg','itens', 'entregas'));
    }

    //ok
    //crio o protocolo
    public function add()
    {
        $protocolo = $this->Protocolos->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['datapedido'] = parent::acertaData($this->request->getData('datapedido'));
            $protocolo->andamento_id=1;
            $protocolo->ativo=1;
            $protocolo->pago=0;
            $protocolo->entregue=0;
            $protocolo->cadastrofinalizado=0;



            $protocolo = $this->Protocolos->patchEntity($protocolo, $this->request->getData());
            if ($this->Protocolos->save($protocolo)) {
                $this->Flash->success('Pedido cadastrado. Insira os itens');

                return $this->redirect(['controller'=>'Pedidos','action' => 'add', $protocolo->id]);
            }
            $this->Flash->error('O pedido não pode ser cadastrado. Tente novamente.');
        }

        $this->Lojas = TableRegistry::get('Lojas');
        $lojas = $this->Lojas->find('list')->where(['Lojas.cliente '=>1]);

        
        $this->set(compact('protocolo', 'lojas'));
    }

    //ok
    // lanço o desconto, atualizo a venda final e atualizo a comissão
    public function desconto($id = null)
    {
        $protocolo = $this->Protocolos->get($id, [
            'contain' => []
        ]);
        
        if($protocolo->tipo!="B"){

            if($protocolo->cadastrofinalizado==1){

                if ($this->request->is(['patch', 'post', 'put'])) {
                    $protocolo = $this->Protocolos->patchEntity($protocolo, $this->request->getData());
                    
                    $protocolo->desconto=($protocolo->desconto)*(-1);
                    
                    // venda final e o subtotal de itens - desconto
                    $protocolo->vendafinal=($protocolo->totalitens)+($protocolo->desconto);
    
                    //atualizo comissão
                    $protocolo->comissao=($protocolo->vendafinal)/10;
    
                    /*
                    //atualizo custo
                    $protocolo->totalcusto=($protocolo->comissao) + ($protocolo->transporte) + ($protocolo->maodeobra) + ($protocolo->custoitens);
                    */
    
                    if ($this->Protocolos->save($protocolo)) {
                        $this->Flash->success('Desconto registrado');
    
                        return $this->redirect(['action' => 'view', $protocolo->id]);
                    }
                    $this->Flash->error('Não foi possível cadastrar o desconto');
                }
                $this->set(compact('protocolo'));
            }else{
                $this->Flash->error('O pedido não esta finalizado');
    
                return $this->redirect(['action' => 'view', $protocolo->id]);
            }
        }else{
            $this->Flash->error('Não faz sentido conceder desconto em brinde');
    
                return $this->redirect(['action' => 'view', $protocolo->id]);
        }
        //
    }


    //ok
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $protocolo = $this->Protocolos->get($id);

        $this->Entregas = TableRegistry::get('Entregas');
        $entregas = $this->Entregas->find('all')->where(['Entregas.protocolo_id ='=>$id]);

        if($entregas->isEmpty()){
            $protocolo->ativo=0;
            if ($this->Protocolos->save($protocolo)) {
                $this->Flash->success('Pedido inativado');
            } else {
                $this->Flash->error('Não foi possivel inativar o pedido');
            }

            return $this->redirect(['action' => 'index']);
        }else{
            $this->Flash->error('Não é possivel inativar um pedido que ja teve entregas realizadas');
            return $this->redirect(['action' => 'index']);


        }
        
    }

    
    //ok
    // flag nao permite mais entregar nada neste protocolo
    public function finalizaentrega($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $protocolo = $this->Protocolos->get($id);


        //verifico se existe algum item nao entregue
        $this->Pedidos = TableRegistry::get('Pedidos');
        $itens = $this->Pedidos->find('all')->where(['Pedidos.entregue'=>0])->where(['Pedidos.ativo'=>1])->first();
        
        
        if($itens==null){
            $protocolo->entregue=1;

            if ($this->Protocolos->save($protocolo)) {
                $this->Flash->success(__('The entrega has been deleted.'));
            } else {
                $this->Flash->error(__('The entrega could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'view', $protocolo->id]);
        }else{
            $this->Flash->error('Não é possível finalizar o pedido pois existem itens não entregues');
            return $this->redirect(['action' => 'view', $protocolo->id]);

        }
        
    }


    //ok
    public function pago($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $protocolo = $this->Protocolos->get($id);
        
        //o pedido foi todo entregue?
        if($protocolo->entregue==1){

            //busco os pagamentos deste protocolo
            $this->Pagamentos = TableRegistry::get('Pagamentos');
            $pg = $this->Pagamentos->find('all')->where(['Pagamentos.protocolo_id'=>$id]);
            
            // ---- bloco para somar os pagamentos deste protocolo
                $valorespagos=0;
                foreach ($pg as $p):
                    $valorespagos=$valorespagos+$p->valor;
                endforeach;
            //------ fim do bloco

            if($valorespagos!=$protocolo->vendafinal){
                $this->Flash->error('Não é possivel dar baixa pois os valores não batem');

            }else{
                $protocolo->pago=1;
                if ($this->Protocolos->save($protocolo)) {
                    $this->Flash->success('Protocolo pago!');
                } else {
                    $this->Flash->error(__('The entrega could not be deleted. Please, try again.'));
                }
    
                return $this->redirect(['action' => 'view',$protocolo->id]);
            }

            
        }else{
            $this->Flash->error('O pedido não foi todo entregue');
            return $this->redirect(['action' => 'view',$protocolo->id]);


        }
        
    }

    
    //ok
    //quando eu finalizo o cadastro estou dizendo que nao posso mais inserir itens neste protocolo.
    // ao finalizar o cadastro, eu faço o somatório dos itens com preço cheio, gerando assim um "subtotal" do itens
    // após a finalização, posso aplicar desconto, mao de obra, transporte e etc
    public function finalizacadastro($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $protocolo = $this->Protocolos->get($id);

        

        //procuro na tabela Pedidos (itens do pedido) todos os itens desse protocolo e somo 
        $this->Pedidos = TableRegistry::get('Pedidos');
        $itens = $this->Pedidos->find('all')->where(['Pedidos.protocolo_id '=>$id])->where(['Pedidos.ativo '=>1]);
        
        // testa se a lista de itens do pedido esta vazia
        if($itens->isEmpty()){

            $this->Flash->error('Não existem itens relacionados a este pedido');
            return $this->redirect(['action' => 'view', $protocolo->id]);
            
        }else{
            //crio a variavel soma para acumular os valores de cada item deste protocolo
            $soma=0;
            foreach ($itens as $i):
                $soma=$soma+$i->valortotal;
            endforeach;

            // ----------BLOCO PARA ATUALIZAR O REGISTRO DO PROTOCOLO ---------------------

                $protocolo->totalitens=$soma;
                $protocolo->vendafinal=$protocolo->totalitens+$protocolo->desconto;
                $protocolo->comissao=($protocolo->vendafinal)/10;
                $protocolo->cadastrofinalizado=1;
                

            // ---------- FIM DO BLOCO DE ATUALIZAÇÃO DO PROTOCOLO ------------------------
            
        }
        


        if ($this->Protocolos->save($protocolo)) {
            $this->Flash->success('Cadastro finalizado com sucesso');
        } else {
            $this->Flash->error(__('The entrega could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $protocolo->id]);
        
        
    }


    /*
    //tirei pq mudei p serviços
    public function transporte($id = null)
    {
        $protocolo = $this->Protocolos->get($id, [
            'contain' => []
        ]);
        if($protocolo->cadastrofinalizado==1){
            $inicial=$protocolo->transporte;
            if ($this->request->is(['patch', 'post', 'put'])) {
                $protocolo = $this->Protocolos->patchEntity($protocolo, $this->request->getData());

                $protocolo->totalcusto=($protocolo->totalcusto)-($inicial)+($protocolo->transporte);
                
                if ($this->Protocolos->save($protocolo)) {
                    $this->Flash->success('Valor do transporte adicionado.');

                    return $this->redirect(['action' => 'view', $protocolo->id]);
                }
                $this->Flash->error('Não foi possivel registrar o valor do transporte');
            }
            $this->set(compact('protocolo'));
        }else{
            $this->Flash->error('O pedido não esta finalizado');

            return $this->redirect(['action' => 'view', $protocolo->id]);
        }
    }
    */


    /*
    //retirei porque passe p tabela serviços
    public function mao($id = null)
    {
        $protocolo = $this->Protocolos->get($id, [
            'contain' => []
        ]);
        if($protocolo->cadastrofinalizado==1){
            $inicial=$protocolo->mao;

            if ($this->request->is(['patch', 'post', 'put'])) {
                $protocolo = $this->Protocolos->patchEntity($protocolo, $this->request->getData());

                $protocolo->totalcusto=($protocolo->totalcusto)-($inicial)+($protocolo->maodeobra);

                if ($this->Protocolos->save($protocolo)) {
                    $this->Flash->success('Valor da mao de obra cadastrado');

                    return $this->redirect(['action' => 'view', $protocolo->id]);
                }
                $this->Flash->error('Não foi possivel registrar o valor da mão de obra');
            }
            $this->set(compact('protocolo'));
        }else{
            $this->Flash->error('O pedido não esta finalizado');

            return $this->redirect(['action' => 'view', $protocolo->id]);
        }
    }
    */

    

        /*

    public function edit($id = null)
    {
        $protocolo = $this->Protocolos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $protocolo = $this->Protocolos->patchEntity($protocolo, $this->request->getData());
            if ($this->Protocolos->save($protocolo)) {
                $this->Flash->success(__('The protocolo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The protocolo could not be saved. Please, try again.'));
        }
        $this->Lojas = TableRegistry::get('Lojas');
        $lojas = $this->Lojas->find('list')->where(['Lojas.tipo >'=>0]);
        $this->set(compact('protocolo', 'lojas'));
    }
        */
    
}
