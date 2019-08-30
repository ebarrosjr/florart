<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * Servicos Controller
 *
 * @property \App\Model\Table\ServicosTable $Servicos
 *
 * @method \App\Model\Entity\Servico[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ServicosController extends AppController
{

    //ok
    public function index()
    {
        $this->paginate = [
            'contain' => ['Protocolos'=>['Lojas'], 'Lotes', 'Remessas', 'Pessoas', 'Tiposervicos']
        ];
        $servicos = $this->paginate($this->Servicos);

        $this->set(compact('servicos'));
    }


    


    //ok funcionando
    //cadastro mao de obra do protocolo e atualizo os custos
    public function servicoprotocolo($id=null)
    {
        if($id==null){
            $this->Flash->error('Informe o protoclo');
            return $this->redirect(['controller'=>'Protocolos','action' => 'index']);
        }else{
            $protocolo = TableRegistry::get('Protocolos')->get($id); 

            if($protocolo->cadastrofinalizado==1){
                if($protocolo->ok==0){

                    $servico = $this->Servicos->newEntity();
                    if ($this->request->is('post')) {
                        $servico = $this->Servicos->patchEntity($servico, $this->request->getData());
                        
                        // carrego na variavel as informações do tipo de serviço para pegar a taxa
                        $tiposervico = TableRegistry::get('Tiposervicos')->get($servico->tiposervico_id); 

                        //gravo o protocolo por referencia
                        $servico->protocolo_id=$id;
                        $servico->servico=1;


                        //faço a conta do valor a ser pago
                        $servico->valor=($servico->quantidade)*($tiposervico->taxa);



                        // ------------------- bloco de atualização do protocolo na tabela Protocolos -----------------
                            // Instancia a tabela 
                            $this->Protocolos = TableRegistry::get('Protocolos');
                            
                            //atualizo o valor da mao de obra no protocolo
                            $protocolo->maodeobra=($protocolo->maodeobra) + ($servico->valor);
                            $protocolo->totalcusto=($protocolo->custoitens) + ($protocolo->comissao) + ($protocolo->transporte) + ($protocolo->maodeobra);

                            

                        // ------------------- fim do bloco de atualização do protocolo na tabela Protocolos -----------------
                                    

                    
                        if (($this->Servicos->save($servico)) && ($this->Protocolos->save($protocolo))) {
                            $this->Flash->success('Mão de obra do protocolo gravada com sucesso');

                            return $this->redirect(['controller'=>'Protocolos','action' => 'view', $protocolo->id]);
                        }
                        $this->Flash->error(__('The servico could not be saved. Please, try again.'));

                    }

                    $pessoas = $this->Servicos->Pessoas->find('list', ['limit' => 200]);
                    $tiposervicos = $this->Servicos->Tiposervicos->find('list', ['limit' => 200]);
                    $this->set(compact('servico', 'protocolo', 'lotes', 'remessas', 'pessoas', 'tiposervicos'));
                }else{
                    $this->Flash->error('O protocolo esta ok. Não pode ser inserida nenhuma informação');

                    return $this->redirect(['controller'=>'Protocolos','action' => 'view', $protocolo->id]);
                }
            }else{
                $this->Flash->error('Não e possivel cadastrar mao de obra de o protocolo nao for finalizado');

                return $this->redirect(['controller'=>'Protocolos','action' => 'view', $protocolo->id]);
            }
        }
    }

    //ok funcionando
    //cadastro transporte do protocolo e atualizo os custos
    public function servicotransporteprotocolo($id=null)
    {
        if($id==null){
            $this->Flash->error('Informe o protoclo');
            return $this->redirect(['controller'=>'Protocolos','action' => 'index']);
        }else{
            $protocolo = TableRegistry::get('Protocolos')->get($id); 

            if($protocolo->cadastrofinalizado==1){
                $servico = $this->Servicos->newEntity();
                if ($this->request->is('post')) {
                    $servico = $this->Servicos->patchEntity($servico, $this->request->getData());
                    
                    //gravo o protocolo por referencia
                    $servico->protocolo_id=$id;
                    $servico->servico=2;



                    // ------------------- bloco de atualização do protocolo na tabela Protocolos -----------------
                        // Instancia a tabela 
                        $this->Protocolos = TableRegistry::get('Protocolos');
                        
                        //atualizo o valor da mao de obra no protocolo
                        $protocolo->transporte=($protocolo->transporte) + ($servico->valor);
                        $protocolo->totalcusto=($protocolo->custoitens) + ($protocolo->comissao) + ($protocolo->transporte) + ($protocolo->maodeobra);

                        

                    // ------------------- fim do bloco de atualização do protocolo na tabela Protocolos -----------------
                                

                   
                    if (($this->Servicos->save($servico)) && ($this->Protocolos->save($protocolo))) {
                        $this->Flash->success('Transporte gravada no protocolo com sucesso');

                        return $this->redirect(['controller'=>'Protocolos','action' => 'view', $protocolo->id]);
                    }
                    $this->Flash->error(__('The servico could not be saved. Please, try again.'));

                }

                $pessoas = $this->Servicos->Pessoas->find('list', ['limit' => 200]);
                $this->set(compact('servico', 'protocolo',  'pessoas'));
            }else{
                $this->Flash->error('Não e possivel cadastrar mao de obra de o protocolo nao for finalizado');

                return $this->redirect(['controller'=>'Protocolos','action' => 'view', $protocolo->id]);
            }
        }
    }






    //ok funcionando
    //cadastro serviço do lote. O custo do lote serpa atualizado quando FINALIZAT LOTE controller Lotes
    public function servicolote($id=null)
    {
        if($id==null){
            $this->Flash->error('Informe o lote');
            return $this->redirect(['controller'=>'Lotes','action' => 'index']);
        }else{
            $lote = TableRegistry::get('Lotes')->get($id); 

            //depois do lote finalizado nao posso mais acrescentar nada
            if($lote->finalizado==0){
                $servico = $this->Servicos->newEntity();
                if ($this->request->is('post')) {
                    $servico = $this->Servicos->patchEntity($servico, $this->request->getData());
                    
                    // carrego na variavel as informações do tipo de serviço para pegar a taxa
                    $tiposervico = TableRegistry::get('Tiposervicos')->get($servico->tiposervico_id); 

                    //gravo o protocolo por referencia
                    $servico->lote_id=$id;
                    $servico->servico=1;


                    //faço a conta do valor a ser pago
                    $servico->valor=($servico->quantidade)*($tiposervico->taxa);



                    // ------------------- bloco de atualização do protocolo na tabela Protocolos -----------------
                        // Instancia a tabela 
                        $this->Lotes = TableRegistry::get('Lotes');
                        
                        //atualizo o valor da mao de obra no protocolo
                        $lote->maodeobra=($lote->maodeobra) + ($servico->valor);
                        

                    // ------------------- fim do bloco de atualização do protocolo na tabela Protocolos -----------------
                                





                    
                    if (($this->Servicos->save($servico)) && ($this->Lotes->save($lote))) {

                        if($this->request->getData('preserva')){
                        
                            $this->Flash->success('Serviço anterior gravado com sucesso.');
    
                            return $this->redirect(['action' => 'servicolote', $id]);
                            
                        }else{
                        
                            $this->Flash->success('Mão de obra do protocolo gravada com sucesso');

                            return $this->redirect(['controller'=>'Lotes','action' => 'view', $lote->id]);
                        }
                       
                    }
                    $this->Flash->error(__('?'));

                }

                $pessoas = $this->Servicos->Pessoas->find('list', ['limit' => 200]);
                $tiposervicos = $this->Servicos->Tiposervicos->find('list', ['limit' => 200]);
                $this->set(compact('servico', 'lote', 'pessoas', 'tiposervicos'));
            }else{
                $this->Flash->error('Não é possivel acresentar mao de obra a um lote finalizado');

                return $this->redirect(['controller'=>'Lotes','action' => 'view', $lote->id]);
            }
        }
    }




    public function servicoremessa($id=null)
    {
        if($id==null){
            $this->Flash->error('Informe a remessa');
            return $this->redirect(['controller'=>'Remessas','action' => 'index']);
        }else{
            $remessa = TableRegistry::get('Remessas')->get($id); 

            $servico = $this->Servicos->newEntity();
            if ($this->request->is('post')) {
                $servico = $this->Servicos->patchEntity($servico, $this->request->getData());
                
                // carrego na variavel as informações do tipo de serviço para pegar a taxa
                $tiposervico = TableRegistry::get('Tiposervicos')->get($servico->tiposervico_id); 

                //gravo o protocolo por referencia
                $servico->remessa_id=$id;
                $servico->servico=1;


                //faço a conta do valor a ser pago
                $servico->valor=($servico->quantidade)*($tiposervico->taxa);



                // ------------------- bloco de atualização do protocolo na tabela Protocolos -----------------
                    // Instancia a tabela 
                    $this->Remessas = TableRegistry::get('Remessas');
                    
                    //atualizo o valor da mao de obra no protocolo
                    $remessa->maodeobra=($remessa->maodeobra) + ($servico->valor);
                    

                // ------------------- fim do bloco de atualização do protocolo na tabela Protocolos -----------------
                            





                
                if (($this->Servicos->save($servico)) && ($this->Remessas->save($remessa))) {
                    $this->Flash->success('Mão de obra do protocolo gravada com sucesso');

                    return $this->redirect(['controller'=>'Remessas','action' => 'view', $remessa->id]);
                }
                $this->Flash->error(__('The servico could not be saved. Please, try again.'));

            }

            $pessoas = $this->Servicos->Pessoas->find('list', ['limit' => 200]);
            $tiposervicos = $this->Servicos->Tiposervicos->find('list', ['limit' => 200]);
            $this->set(compact('servico', 'remessa', 'pessoas', 'tiposervicos'));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Servico id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $servico = $this->Servicos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $servico = $this->Servicos->patchEntity($servico, $this->request->getData());
            if ($this->Servicos->save($servico)) {
                $this->Flash->success(__('The servico has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The servico could not be saved. Please, try again.'));
        }
        $protocolos = $this->Servicos->Protocolos->find('list', ['limit' => 200]);
        $lotes = $this->Servicos->Lotes->find('list', ['limit' => 200]);
        $remessas = $this->Servicos->Remessas->find('list', ['limit' => 200]);
        $pessoas = $this->Servicos->Pessoas->find('list', ['limit' => 200]);
        $tiposervicos = $this->Servicos->Tiposervicos->find('list', ['limit' => 200]);
        $this->set(compact('servico', 'protocolos', 'lotes', 'remessas', 'pessoas', 'tiposervicos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Servico id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $servico = $this->Servicos->get($id);
        if ($this->Servicos->delete($servico)) {
            $this->Flash->success(__('The servico has been deleted.'));
        } else {
            $this->Flash->error(__('The servico could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    /*
    public function add()
    {
        $servico = $this->Servicos->newEntity();
        if ($this->request->is('post')) {
            $servico = $this->Servicos->patchEntity($servico, $this->request->getData());
            if ($this->Servicos->save($servico)) {
                $this->Flash->success(__('The servico has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The servico could not be saved. Please, try again.'));
        }
        $protocolos = $this->Servicos->Protocolos->find('list', ['limit' => 200]);
        $lotes = $this->Servicos->Lotes->find('list', ['limit' => 200]);
        $remessas = $this->Servicos->Remessas->find('list', ['limit' => 200]);
        $pessoas = $this->Servicos->Pessoas->find('list', ['limit' => 200]);
        $tiposervicos = $this->Servicos->Tiposervicos->find('list', ['limit' => 200]);
        $this->set(compact('servico', 'protocolos', 'lotes', 'remessas', 'pessoas', 'tiposervicos'));
    }
    */



    /*
    public function view($id = null)
    {
        $servico = $this->Servicos->get($id, [
            'contain' => ['Protocolos', 'Lotes', 'Remessas', 'Pessoas', 'Tiposervicos']
        ]);

        $this->set('servico', $servico);
    }
    */
}
