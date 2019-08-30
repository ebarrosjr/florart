<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * Prejuizos Controller
 *
 * @property \App\Model\Table\PrejuizosTable $Prejuizos
 *
 * @method \App\Model\Entity\Prejuizo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PrejuizosController extends AppController
{

    //ok
    public function index()
    {
        $this->paginate = [
            'contain' => ['Primasestoques'=>['Primas'], 'Lotes', 'Remessas']
        ];
        $prejuizos = $this->paginate($this->Prejuizos);

        $this->set(compact('prejuizos'));
    }

    //ok
    public function view($id = null)
    {
        $prejuizo = $this->Prejuizos->get($id, [
            'contain' => ['Primasestoques'=>['Primas'], 'Lotes'=>['Produtogrupos'], 'Remessas']
        ]);

        $this->set('prejuizo', $prejuizo);
    }
    

    
    
    //ok
    public function expurgoprima($id=null)
    {
        if($id==null){
            $this->Flash->error('Indique o almoxarifado');

            return $this->redirect(['Controller'=>'Primasestoques','action' => 'index']);
        }else{
            $almoxarifado = TableRegistry::get('Primasestoques')->get($id); // carrego na variavel edital o conteúdo do parametro $e

            //tem estoque?
            if($almoxarifado->estoque > 0){
                $prejuizo = $this->Prejuizos->newEntity();
                if ($this->request->is('post')) {
                    $prejuizo = $this->Prejuizos->patchEntity($prejuizo, $this->request->getData());


                    $prejuizo->primasestoque_id=$id; // gravo o almoxarifado por refencia
                    $prejuizo->valor_prejuizo=($prejuizo->qtd)*($almoxarifado->custounit);//faço a conta do prejuizo

                    
                    //---------------------bloco de atualização de Primas estoques--------------------
                    
                        // Instancia a tabela 
                        $this->Primasestoques = TableRegistry::get('Primasestoques');
                        // gravo os dados necessarios no objeto novo
                        $almoxarifado->estoque=($almoxarifado->estoque)-($prejuizo->qtd); 
                 
                    
                    //---------------------fim do bloco de atualização de Primas estoques--------------------


                    // --------------- bloco que atualiza a materia prima ---------------
                            // Instancia a tabela 
                            $this->Primas = TableRegistry::get('Primas');
                            // Busca o projeto informado 
                            $prima = $this->Primas->get($almoxarifado->prima_id);
                            $prima->estoque=($prima->estoque)-($prejuizo->qtd);
                            
                    // --------------- fim bloco que atualiza a materia prima ---------------


                    if (($this->Prejuizos->save($prejuizo)) && ($this->Primasestoques->save($almoxarifado)) && ($this->Primas->save($prima))) {
                        $this->Flash->success('expurgo de almoxarifado salvo');

                        return $this->redirect(['action' => 'view', $prejuizo->id]);
                    }
                    $this->Flash->error('O expurgo não pode ser salvo. Tente novamente');
                }
                
                $this->set(compact('prejuizo', 'almoxarifado'));
            }else{
                $this->Flash->error('Não há estoque disponivel para este almoxarifado. Escolha outro');

                return $this->redirect(['Controller'=>'Primasestoques','action' => 'index']);
            }
            
        }
    }


    //ok
    public function expurgolote($id=null)
    {
        if($id==null){
            $this->Flash->error('Indique o lote');

            return $this->redirect(['Controller'=>'Lotes','action' => 'index']);
        }else{
            $lote = TableRegistry::get('Lotes')->get($id); // carrego na variavel edital o conteúdo do parametro $e

            //esta finalizado?
            if($lote->finalizado==1){
                //tem estoque?
                if($lote->estoque > 0){
                    $prejuizo = $this->Prejuizos->newEntity();
                    if ($this->request->is('post')) {
                        $prejuizo = $this->Prejuizos->patchEntity($prejuizo, $this->request->getData());


                        $prejuizo->lote_id=$id; // gravo o almoxarifado por refencia
                        $prejuizo->valor_prejuizo=($prejuizo->qtd)*($lote->custounit);//faço a conta do prejuizo

                        
                        //---------------------bloco de atualização de Lotes estoques--------------------
                        
                            // Instancia a tabela 
                            $this->Lotes = TableRegistry::get('Lotes');
                            // gravo os dados necessarios no objeto novo
                            $lote->estoque=($lote->estoque)-($prejuizo->qtd); 
                    
                        
                        //---------------------fim do bloco de atualização de Lotes estoques--------------------




                        if (($this->Prejuizos->save($prejuizo)) && ($this->Lotes->save($lote)) ) {
                            $this->Flash->success('expurgo de Lote salvo');

                            return $this->redirect(['action' => 'view', $prejuizo->id]);
                        }
                        $this->Flash->error('O expurgo não pode ser salvo. Tente novamente');
                    }
                    
                    $this->set(compact('prejuizo', 'lote'));
                }else{
                    $this->Flash->error('Não há estoque disponivel para este lote. Escolha outro');

                    return $this->redirect(['Controller'=>'Lotes','action' => 'index']);
                }
            }else{
                $this->Flash->error('Lote não finalizado');

                return $this->redirect(['Controller'=>'Lotes','action' => 'index']);
            }
            
        }
    }


    //ok
    public function expurgoremessa($id=null)
    {
        if($id==null){
            $this->Flash->error('Indique a remessa');

            return $this->redirect(['Controller'=>'Remessas','action' => 'index']);
        }else{
            $remessa = TableRegistry::get('Remessas')->get($id); // carrego na variavel edital o conteúdo do parametro $e

            //esta finalizado?
            if($remessa->finalizado==1){
                //tem estoque?
                if($remessa->estoque > 0){
                    $prejuizo = $this->Prejuizos->newEntity();
                    if ($this->request->is('post')) {
                        $prejuizo = $this->Prejuizos->patchEntity($prejuizo, $this->request->getData());


                        $prejuizo->remessa_id=$id; // gravo o almoxarifado por refencia
                        $prejuizo->valor_prejuizo=($prejuizo->qtd)*($remessa->custounit);//faço a conta do prejuizo

                        
                        //---------------------bloco de atualização de Remessas estoques--------------------
                        
                            // Instancia a tabela 
                            $this->Remessas = TableRegistry::get('Remessas');
                            // gravo os dados necessarios no objeto novo
                            $remessa->estoque=($remessa->estoque)-($prejuizo->qtd); 
                    
                        
                        //---------------------fim do bloco de atualização de Remessas estoques--------------------




                        if (($this->Prejuizos->save($prejuizo)) && ($this->Remessas->save($remessa)) ) {
                            $this->Flash->success('expurgo de Lote salvo');

                            return $this->redirect(['action' => 'view', $prejuizo->id]);
                        }
                        $this->Flash->error('O expurgo não pode ser salvo. Tente novamente');
                    }
                    
                    $this->set(compact('prejuizo', 'remessa'));
                }else{
                    $this->Flash->error('Não há estoque disponivel para este lote. Escolha outro');

                    return $this->redirect(['Controller'=>'Primasestoques','action' => 'index']);
                }
            }else{
                $this->Flash->error('Remessa não finalizado');

                return $this->redirect(['Controller'=>'Remessas','action' => 'index']);
            }
            
        }
    }
    

    /*

    public function add()
    {
        $prejuizo = $this->Prejuizos->newEntity();
        if ($this->request->is('post')) {
            $prejuizo = $this->Prejuizos->patchEntity($prejuizo, $this->request->getData());
            if ($this->Prejuizos->save($prejuizo)) {
                $this->Flash->success(__('The prejuizo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The prejuizo could not be saved. Please, try again.'));
        }

            
        $primasestoques = $this->Prejuizos->Primasestoques->find('list', ['limit' => 200]);
        $lotes = $this->Prejuizos->Lotes->find('list', ['limit' => 200]);
        $remessas = $this->Prejuizos->Remessas->find('list', ['limit' => 200]);
        $this->set(compact('prejuizo', 'primasestoques', 'lotes', 'remessas'));
    }


    */



    /*
    public function edit($id = null)
    {
        $prejuizo = $this->Prejuizos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $prejuizo = $this->Prejuizos->patchEntity($prejuizo, $this->request->getData());
            if ($this->Prejuizos->save($prejuizo)) {
                $this->Flash->success(__('The prejuizo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The prejuizo could not be saved. Please, try again.'));
        }
        $primasestoques = $this->Prejuizos->Primasestoques->find('list', ['limit' => 200]);
        $lotes = $this->Prejuizos->Lotes->find('list', ['limit' => 200]);
        $remessas = $this->Prejuizos->Remessas->find('list', ['limit' => 200]);
        $this->set(compact('prejuizo', 'primasestoques', 'lotes', 'remessas'));
    }

    */

    /*
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $prejuizo = $this->Prejuizos->get($id);
        if ($this->Prejuizos->delete($prejuizo)) {
            $this->Flash->success(__('The prejuizo has been deleted.'));
        } else {
            $this->Flash->error(__('The prejuizo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    */
}
