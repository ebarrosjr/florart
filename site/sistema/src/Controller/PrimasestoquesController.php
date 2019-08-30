<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * Primasestoques Controller
 *
 * @property \App\Model\Table\PrimasestoquesTable $Primasestoques
 *
 * @method \App\Model\Entity\Primasestoque[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PrimasestoquesController extends AppController
{

    //ok
    public function index()
    {
        $this->paginate = [
            'contain' => ['Primas', 'Unidademedidas', 'Compras']
        ];
        $p = $this->Primasestoques->find('all')->contain('Primas')->order([ 'Primasestoques.estoque'=>'desc','Primasestoques.compra_id'=>'desc', 'Primasestoques.prima_id'=>'desc']);

        $primasestoques = $this->paginate($p);

        $this->set(compact('primasestoques'));
    }
    

    //ok
    public function view($id = null)
    {
        $primasestoque = $this->Primasestoques->get($id, [
            'contain' => ['Primas', 'Unidademedidas', 'Compras']
        ]);

        $this->Itenslotes = TableRegistry::get('Itenslotes');
        $itenslote = $this->Itenslotes->find('all')->contain(['Lotes'])->where(['Itenslotes.primasestoque_id ='=>$id]);

        $this->Itensremessas = TableRegistry::get('Itensremessas');
        $itensremessa = $this->Itensremessas->find('all')->contain(['Remessas'])->where(['Itensremessas.primasestoque_id ='=>$id]);

        $this->set(compact('primasestoque', $primasestoque, 'itenslote', 'itensremessa'));
    }

    /*
    public function add($id=null)
    {
        if($id==null){
            $this->Flash->error('Escolha a matréria Prima');

            return $this->redirect(['controller'=>'Primas','action' => 'index']);
        }else{

            $mp = TableRegistry::get('Primas')->get($id);
            $primasestoque = $this->Primasestoques->newEntity();
            if ($this->request->is('post')) {
                $this->request->data['data'] = parent::acertaData($this->request->getData('data'));
                $primasestoque = $this->Primasestoques->patchEntity($primasestoque, $this->request->getData());
                $primasestoque->prima_id=$mp->id;
                $primasestoque->custounit=($primasestoque->valor)/($primasestoque->quantidade);
                
                if($primasestoque->operacao==1){
                    $primasestoque->quantidade=($primasestoque->quantidade)*(-1);

                }

                $primasestoque->estoque=$primasestoque->quantidade;

                if ($this->Primasestoques->save($primasestoque)) {

                    // Instancia a tabela Projetos
                    $this->Primas = TableRegistry::get('Primas');
                    // Busca o projeto informado pelo Formulário
                    $ativo = $this->Primas->get($primasestoque->prima_id);
                    $antigo=$ativo->estoque;
                    // Altera o status do projeto devolvido
                    $ativo->estoque = $antigo + $primasestoque->quantidade ;
                    // Grava a alteração
                    
                    $this->Primas->save($ativo);

                    if($this->request->getData('preserva')){

                        

                        $this->Flash->success('Movimentação anterior gravada com sucesso.');

                        return $this->redirect(['action' => 'add', $mp->id]);
                        
                    }else{

                        

                        $this->Flash->success('Movimentação salva com sucesso');

                        return $this->redirect(['controller'=>'Primas','action' => 'index']);
                    }
                }
                $this->Flash->error(__('The primasestoque could not be saved. Please, try again.'));
            }

            $this->Unidademedidas = TableRegistry::get('Unidademedidas');
            $unidademedidas = $this->Unidademedidas->find('list');
            
            $this->Lojas = TableRegistry::get('Lojas');
            $lojas = $this->Lojas->find('list')->where(['Lojas.fornecedor ='=>1]);

            
            
            $this->set(compact('primasestoque', 'unidademedidas', 'lojas', 'mp'));
        }
        
    }*/


    //ok
    //nao sei o que e kkkkk
    /*
    public function compra($id=null)
    {
        if($id==null){
            $this->Flash->error('Escolha a matréria Prima');

            return $this->redirect(['controller'=>'Primas','action' => 'index']);
        }else{

            $mp = TableRegistry::get('Primas')->get($id);
            $primasestoque = $this->Primasestoques->newEntity();
            if ($this->request->is('post')) {
                $this->request->data['data'] = parent::acertaData($this->request->getData('data'));
                $primasestoque = $this->Primasestoques->patchEntity($primasestoque, $this->request->getData());
                
                $primasestoque->prima_id=$mp->id; //gravo a materia prima por referencia
                $primasestoque->custounit=($primasestoque->valor)/($primasestoque->quantidade); // calculo o custo unitarios
                $primasestoque->operacao=0; // gravo a operação por referencia
                $primasestoque->estoque=$primasestoque->quantidade; //atualizo o estoque


                //--------------------- bloco para atualização da materia prima -----------
                    // Instancia a tabela Projetos
                    $this->Primas = TableRegistry::get('Primas');
                    // Busca o objeto informado pelo Formulário
                    $ativo = $this->Primas->get($primasestoque->prima_id);
                    $antigo=$ativo->estoque;
                    // Altera o estoque da materia prima
                    $ativo->estoque = $antigo + $primasestoque->quantidade ;
                //--------------------- fim do bloco para atualização da materia prima -----------


                if ($this->Primasestoques->save($primasestoque) && $this->Primas->save($ativo)) {

                    $this->Flash->success('Movimentação salva com sucesso');

                    return $this->redirect(['controller'=>'Primas','action' => 'index']);
                
                }
                $this->Flash->error(__('The primasestoque could not be saved. Please, try again.'));
            }

            $this->Unidademedidas = TableRegistry::get('Unidademedidas');
            $unidademedidas = $this->Unidademedidas->find('list');
            
            $this->Lojas = TableRegistry::get('Lojas');
            $lojas = $this->Lojas->find('list')->where(['Lojas.fornecedor = '=>1]);

            
            
            $this->set(compact('primasestoque', 'unidademedidas', 'lojas', 'mp'));
        }
        
    }
    */


    //ok
    //nao sei o que e kkkkk
    /*
    public function comprageral()
    {
    

        $primasestoque = $this->Primasestoques->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['data'] = parent::acertaData($this->request->getData('data'));
            $primasestoque = $this->Primasestoques->patchEntity($primasestoque, $this->request->getData());
            
            $primasestoque->custounit=($primasestoque->valor)/($primasestoque->quantidade); // calculo o custo unitarios
            $primasestoque->operacao=0; // gravo a operação por referencia
            $primasestoque->estoque=$primasestoque->quantidade; //atualizo o estoque


            //--------------------- bloco para atualização da materia prima -----------
                // Instancia a tabela Projetos
                $this->Primas = TableRegistry::get('Primas');
                // Busca o objeto informado pelo Formulário
                $ativo = $this->Primas->get($primasestoque->prima_id);
                $antigo=$ativo->estoque;
                // Altera o estoque da materia prima
                $ativo->estoque = $antigo + $primasestoque->quantidade ;
            //--------------------- fim do bloco para atualização da materia prima -----------

            
            

            if ($this->Primasestoques->save($primasestoque) && $this->Primas->save($ativo)) {

                if($this->request->getData('preserva')){


                    $this->Flash->success('Movimentação anterior gravada com sucesso.');
    
                    return $this->redirect(['action' => 'itens', $primasestoque->id]);
                    
                }else{
    
                    
    
                    $this->Flash->success('Movimentação salva com sucesso');
    
                    return $this->redirect(['controller'=>'Primas','action' => 'index']);
                }
            
            }
            $this->Flash->error(__('The primasestoque could not be saved. Please, try again.'));
        }

        $this->Unidademedidas = TableRegistry::get('Unidademedidas');
        $unidademedidas = $this->Unidademedidas->find('list');

        $this->Primas = TableRegistry::get('Primas');
        $primas = $this->Primas->find('list');
        
        $this->Lojas = TableRegistry::get('Lojas');
        $lojas = $this->Lojas->find('list')->where(['Lojas.fornecedor = '=>1]);

        
        
        $this->set(compact('primasestoque', 'unidademedidas', 'lojas', 'mp', 'primas'));
        
        
    }
    */

    //ok
    //nao sei o que e kkkkk
    /*
    public function itens($id=null)
    {
        if($id==null){
            $this->Flash->error('Escolha a compra');

            return $this->redirect(['controller'=>'Primasestoques','action' => 'index']);
        }else{

            $origem = TableRegistry::get('Primasestoques')->get($id);

            $primasestoque = $this->Primasestoques->newEntity();
            if ($this->request->is('post')) {
                $primasestoque = $this->Primasestoques->patchEntity($primasestoque, $this->request->getData());
                
                $primasestoque->custounit=($primasestoque->valor)/($primasestoque->quantidade); // calculo o custo unitarios
                $primasestoque->operacao=0; // gravo a operação por referencia
                $primasestoque->estoque=$primasestoque->quantidade; //atualizo o estoque
                $primasestoque->loja_id=$origem->loja_id;
                $primasestoque->operacao=$origem->operacao;
                $primasestoque->data=$origem->data;


                //--------------------- bloco para atualização da materia prima -----------
                    // Instancia a tabela Projetos
                    $this->Primas = TableRegistry::get('Primas');
                    // Busca o objeto informado pelo Formulário
                    $ativo = $this->Primas->get($primasestoque->prima_id);
                    $antigo=$ativo->estoque;
                    // Altera o estoque da materia prima
                    $ativo->estoque = $antigo + $primasestoque->quantidade ;
                //--------------------- fim do bloco para atualização da materia prima -----------

                
                

                if ($this->Primasestoques->save($primasestoque) && $this->Primas->save($ativo)) {

                    if($this->request->getData('preserva')){


                        $this->Flash->success('Movimentação anterior gravada com sucesso.');
        
                        return $this->redirect(['action' => 'itens', $primasestoque->id]);
                        
                    }else{
        
                        
        
                        $this->Flash->success('Movimentação salva com sucesso');
        
                        return $this->redirect(['controller'=>'Primas','action' => 'index']);
                    }
                
                }
                $this->Flash->error(__('The primasestoque could not be saved. Please, try again.'));
            }

            $this->Unidademedidas = TableRegistry::get('Unidademedidas');
            $unidademedidas = $this->Unidademedidas->find('list');
            
            $this->Primas = TableRegistry::get('Primas');
            $primas = $this->Primas->find('list');

            
            
            $this->set(compact('primasestoque', 'unidademedidas', 'primas', 'mp'));
        }
        
    }
    */

    public function add($id=null)
    {
        if($id==null){
            $this->Flash->error('Escolha a compra');

            return $this->redirect(['controller'=>'Compras','action' => 'index']);
        }else{

            // carrego o objeto protocolo                
            $compra = TableRegistry::get('Compras')->get($id); // carrego na variavel edital o conteúdo do parametro $e

            if($compra->itens_completos==0){
                $primasestoque = $this->Primasestoques->newEntity();
                if ($this->request->is('post')) {
                    $primasestoque = $this->Primasestoques->patchEntity($primasestoque, $this->request->getData());
                    
                    $primasestoque->compra_id=$id;
                    $primasestoque->operacao=0; // gravo a operação por referencia==compra

                    $primasestoque->custounit=($primasestoque->valor)/($primasestoque->quantidade); // calculo o custo unitarios
                    $primasestoque->estoque=$primasestoque->quantidade; //atualizo o estoque
                    

                    //--------------------- bloco para atualização da materia prima -----------
                        // Instancia a tabela Projetos
                        $this->Primas = TableRegistry::get('Primas');
                        // Busca o objeto informado pelo Formulário
                        $ativo = $this->Primas->get($primasestoque->prima_id);
                        $antigo=$ativo->estoque;
                        // Altera o estoque da materia prima
                        $ativo->estoque = $antigo + $primasestoque->quantidade ;
                    //--------------------- fim do bloco para atualização da materia prima -----------

                    
                    

                    if ($this->Primasestoques->save($primasestoque) && $this->Primas->save($ativo)) {

                        if($this->request->getData('preserva')){


                            $this->Flash->success('Movimentação anterior gravada com sucesso.');
            
                            return $this->redirect(['action' => 'add', $primasestoque->compra_id]);
                            
                        }else{
            
                            
            
                            $this->Flash->success('Movimentação salva com sucesso');
            
                            return $this->redirect(['controller'=>'Compras','action' => 'view',$primasestoque->compra_id ]);
                        }
                    
                    }
                    $this->Flash->error(__('The primasestoque could not be saved. Please, try again.'));
                }

                $this->Unidademedidas = TableRegistry::get('Unidademedidas');
                $unidademedidas = $this->Unidademedidas->find('list');
                
                $this->Primas = TableRegistry::get('Primas');
                $primas = $this->Primas->find('list')->order(['Primas.nome'=>'asc']);

                
                
                $this->set(compact('primasestoque', 'unidademedidas', 'primas', 'mp'));
            }else{
                $this->Flash->error('Compra bloqueada para cadastro de novos itens');
            
                return $this->redirect(['controller'=>'Compras','action' => 'view',$compra->id ]);
            }
        }
        
    }


    


    //ok
    public function troca($id=null)
    {
        if($id==null){
            $this->Flash->error('Escolha o lote da matréria Prima');

            return $this->redirect(['controller'=>'Primasestoques','action' => 'index']);
        }else{

            $mae = $this->Primasestoques->get($id, [
                'contain' => ['Primas']
            ]);      
            
            if($mae->estoque>0){
                $primasestoque = $this->Primasestoques->newEntity();
                if ($this->request->is('post')) {
                    $this->request->data['data'] = parent::acertaData($this->request->getData('data'));
                    $primasestoque = $this->Primasestoques->patchEntity($primasestoque, $this->request->getData());
                    $primasestoque->prima_id=$mae->prima_id;
                    $primasestoque->parent_id=$mae->id;

                    $primasestoque->quantidade=($primasestoque->quantidade)*(-1);

                    $primasestoque->operacao=1;
                    $primasestoque->estoque=($primasestoque->quantidade);
                    $primasestoque->unidademedida_id=$mae->unidademedida_id;
                    $primasestoque->loja_id=$mae->loja_id;

                    if(($mae->estoque + $primasestoque->quantidade)<0){
                        $this->Flash->success('Estoque insuficiente para realizar a operação.');
                        //return $this->redirect(['action' => 'index']);
                    }else{

                        //  -----------------------bloco para atualizar a materia prima e a movimentação -----------
                            //materia prima
                            $this->Primas = TableRegistry::get('Primas');
                            $ativo = $this->Primas->get($primasestoque->prima_id);
                            $antigo=$ativo->estoque;
                            $ativo->estoque = $antigo + $primasestoque->quantidade ;

                            //movimentação
                            $this->Primasestoques = TableRegistry::get('Primasestoques');
                            $mae->estoque=$mae->estoque + $primasestoque->quantidade;
                        //  ----------------------- fim do bloco para atualizar a materia prima e a movimentação -----------
                        

                        

                        if ($this->Primasestoques->save($primasestoque)
                            && $this->Primas->save($ativo)
                            && $this->Primasestoques->save($mae)){

                            $this->Flash->success('Movimentação salva com sucesso');

                            return $this->redirect(['controller'=>'Primas','action' => 'index']);
                        }
                    }
                    $this->Flash->error(__('The primasestoque could not be saved. Please, try again.'));
                }
            }else{
                $this->Flash->success('Não há estoque');
                return $this->redirect(['action' => 'index']);
            }
            
            $this->set(compact('primasestoque', 'unidademedidas', 'lojas', 'mae'));
        }
        
    }

    //ok
    public function edit($id = null)
    {
        $primasestoque = $this->Primasestoques->get($id, [
            'contain' => ['Primas', 'Lojas']
        ]);

        $operinit=$primasestoque->operacao;
        $qtinit=$primasestoque->quantidade;
        $saldo=0;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['data'] = parent::acertaData($this->request->getData('data'));

            $primasestoque = $this->Primasestoques->patchEntity($primasestoque, $this->request->getData());

            if($primasestoque->operacao==1){
                $primasestoque->quantidade=($primasestoque->quantidade)*(-1);

            }

            $primasestoque->estoque=$primasestoque->quantidade;
            
            $inverte=($qtinit)*(-1); //variavel para anular a operação anterior
            $saldo= $inverte + $primasestoque->quantidade; 

            // ----- bloco para atualizar o estoque da materia prima -----
                $this->Primas = TableRegistry::get('Primas');
                $ativo = $this->Primas->get($primasestoque->prima_id);
                $estoque=$ativo->estoque;
                $ativo->estoque =$estoque+ $saldo ;
            // ----- fim dobloco para atualizar o estoque da materia prima -----
            if ($this->Primasestoques->save($primasestoque) && $this->Primas->save($ativo)) {
            
                $this->Flash->success('Alteração gravada com sucesso');

                return $this->redirect(['controller'=>'Primas','action' => 'index']);
            }
            
            $this->Flash->error(__('The primasestoque could not be saved. Please, try again.'));
        }
        $this->Unidademedidas = TableRegistry::get('Unidademedidas');
        $unidademedidas = $this->Unidademedidas->find('list');
        
        $this->Lojas = TableRegistry::get('Lojas');
        $lojas = $this->Lojas->find('list')->where(['Lojas.fornecedor ='=>1]);

        $this->Primas = TableRegistry::get('Primas');
        $primas = $this->Primas->find('list');

        $this->set(compact('primasestoque', 'primas', 'unidademedidas', 'lojas'));
    }

    /*
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $primasestoque = $this->Primasestoques->get($id);
        if ($this->Primasestoques->delete($primasestoque)) {
            $this->Flash->success(__('The primasestoque has been deleted.'));
        } else {
            $this->Flash->error(__('The primasestoque could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }*/

    //ok
    //passei p tebela prejuizos
    /*
    public function expurgo($id=null)
    {
        if($id==null){
            $this->Flash->error('Escolha o lote da matréria Prima');

            return $this->redirect(['controller'=>'Primasestoques','action' => 'index']);
        }else{

            $mae = $this->Primasestoques->get($id, [
                'contain' => ['Primas']
            ]);        
            
            if($mae->estoque>0){
                $primasestoque = $this->Primasestoques->newEntity();
                if ($this->request->is('post')) {
                    $this->request->data['data'] = parent::acertaData($this->request->getData('data'));
                    $primasestoque = $this->Primasestoques->patchEntity($primasestoque, $this->request->getData());
                    $primasestoque->prima_id=$mae->prima_id; // gravo a materia prima por refencia
                    $primasestoque->parent_id=$mae->id;// gravo a movimentação por referencia

                    $primasestoque->quantidade=($primasestoque->quantidade)*(-1); 
                    $primasestoque->prejuizo=($mae->custounit)*($primasestoque->quantidade);

                    $primasestoque->operacao=2;
                    $primasestoque->estoque=($primasestoque->quantidade);
                    $primasestoque->unidademedida_id=$mae->unidademedida_id;
                    $primasestoque->loja_id=$mae->loja_id;

                    if(($mae->estoque + $primasestoque->quantidade)<0){
                        $this->Flash->success('Estoque insuficiente para realizar a operação.');
                        //return $this->redirect(['action' => 'index']);
                    }else{

                        // --------------- bloco que atualiza a materia prima ---------------
                            // Instancia a tabela Projetos
                            $this->Primas = TableRegistry::get('Primas');
                            // Busca o projeto informado pelo Formulário
                            $ativo = $this->Primas->get($primasestoque->prima_id);
                            $antigo=$ativo->estoque;
                            // Altera o status do projeto devolvido
                            $ativo->estoque = $antigo + $primasestoque->quantidade ;
                        // --------------- fim bloco que atualiza a materia prima ---------------

                        // --------------- bloco que atualiza a movimentação ---------------
                            $this->Primasestoques = TableRegistry::get('Primasestoques');
                            $mae->estoque=$mae->estoque + $primasestoque->quantidade;
                        // --------------- bloco que atualiza a movimentação ---------------


                        
                        
                        if ($this->Primasestoques->save($primasestoque) && 
                            $this->Primas->save($ativo) &&
                            $this->Primasestoques->save($mae)) 
                        {
                            $this->Flash->success('Movimentação salva com sucesso');
                            return $this->redirect(['controller'=>'Primas','action' => 'index']);
                        }
                    }

                    $this->Flash->error('Não foi possivel gravar. Tente novamente');
                }
            }else{
                $this->Flash->success('Não há estoque');
                return $this->redirect(['action' => 'index']);
            }

            $this->set(compact('primasestoque', 'unidademedidas', 'lojas', 'mae'));
        }
        
    }
    */
}
