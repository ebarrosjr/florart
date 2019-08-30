<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Remessas Controller
 *
 * @property \App\Model\Table\RemessasTable $Remessas
 *
 * @method \App\Model\Entity\Remessa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RemessasController extends AppController
{

    //OK
    public function index()
    {
        $this->paginate = [
            'contain' => []
        ];
        $remessas = $this->paginate($this->Remessas);

        $this->set(compact('remessas'));
    }

    //OK
    public function view($id = null)
    {
        $remessa = $this->Remessas->get($id, [
            'contain' => [ 'Entregas', 'Itensremessas']
        ]);

        $this->Entregas= TableRegistry::get('Entregas');
        $entregas = $this->Entregas->find('all')->contain(['Pedidos','Protocolos'=>['Lojas'] ])
                                                    ->where(['Entregas.remessa_id'=>$id]) 
                                                    ->order(['Entregas.id'=>'desc'])
        ;
        $this->Itensremessas= TableRegistry::get('Itensremessas');
        $itens = $this->Itensremessas->find('all')->contain(['Remessas', 'Primas', 'Primasestoques'])
                                                    ->where(['Itensremessas.remessa_id'=>$id]) 
                                                    ->order(['Itensremessas.id'=>'desc'])
        ;

        $this->set(compact('remessa', $remessa, 'entregas', 'itens'));
    }


    //ok
    public function add()
    {
        $remessa = $this->Remessas->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['data'] = parent::acertaData($this->request->getData('data'));
            $remessa = $this->Remessas->patchEntity($remessa, $this->request->getData());

            $remessa->estoque=($remessa->quantidade);
            if ($this->Remessas->save($remessa)) {
                $this->Flash->success('Remessa acadastrada com sucesso');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The remessa could not be saved. Please, try again.'));
        }
        $this->set(compact('remessa'));
    }

    //ok
    //flag completo==1; não será possivel acrescentar mais itens
    public function completaremessa($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $remessa = $this->Remessas->get($id);

        //verifico se exiete algum item não finalizado
        $this->Itensremessas = TableRegistry::get('Itensremessas');
        $itemaberto = $this->Itensremessas->find('all')->where(['Itensremessas.remessa_id '=>$id])->where(['Itensremessas.finalizado ='=>0])->first();
        

        if($itemaberto==null){
            $remessa->completo=1;
            if ($this->Remessas->save($remessa)) {
                $this->Flash->success('Remessa completa. Não será possivel acrescentar novos itens.');
            } else {
                $this->Flash->error('Não foi possivel completar a remessa');
            }

            return $this->redirect(['action' => 'view', $remessa->id]);
        }else{
            $this->Flash->error('Não é possivel completar a remessa com itens desbloqueados');
            return $this->redirect(['action' => 'view', $remessa->id]);

        }

        
    }

    
   

    //ok
    //so edita qtdd para remessas nao finalizadas
    public function edit($id = null)
    {
        $remessa = $this->Remessas->get($id, [
            'contain' => []
        ]);
        
        //so é possivel editar uma remessa que não esteja finalizado
        if($remessa->finalizado==0){
            $qtdinit=$remessa->quantidade;
            $estoqueinit=$remessa->estoque;
            if ($this->request->is(['patch', 'post', 'put'])) {
                $remessa = $this->Remessas->patchEntity($remessa, $this->request->getData());
                if($qtdinit==null){
                    $remessa->estoque=($remessa->quantidade);
                    
                }else{
                    $dif=($remessa->quantidade)-($qtdinit);
                    $remessa->estoque=($remessa->estoque)+$dif;
                }
                if ($this->Remessas->save($remessa)) {
                    $this->Flash->success('Quantidade atualizada');

                    return $this->redirect(['action' => 'view', $remessa->id]);
                }
                $this->Flash->error('A quantidade não pode ser alterada');
            }
            $this->set(compact('remessa'));
        }else{
            $this->Flash->error('Não é possível editar um remessa finalizado');
            return $this->redirect(['action' => 'view', $remessa->id]);
        }
    }
    


    //ok
    // função que edita apenas nome e etc
    public function muda($id = null) 
    {
        $remessa = $this->Remessas->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['data'] = parent::acertaData($this->request->getData('data'));

            $remessa = $this->Remessas->patchEntity($remessa, $this->request->getData());
           
            if ($this->Remessa->save($remessa)) {
                $this->Flash->success('remessa atualizado');

                return $this->redirect(['action' => 'view', $remessa->id]);
            }
            $this->Flash->error('a remessa não pode ser alterada');
        }
        $this->set(compact('remessa'));
        
    }

    //OK
    // calcula e atualiza os custos
    public function finalizaremessa($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $remessa = $this->Remessas->get($id);

        $remessa = $this->Remessas->get($id);
        if($remessa->finalizado==0){// teste se ja estava finalizado

            if($remessa->quantidade!=null ){// so é possivel finalizar se a quantidade estiver cadastrada
                if($remessa->completo==1){// a remessa tem que estar completo, ou seja, esta garantido que nao entrará mais nenhum item neste lote e nenhum será editado

                    //procuro na tabela itensremessa todos os itens desse remessa e somo os custos
                    $this->Itensremessas = TableRegistry::get('Itensremessas');
                    $itens = $this->Itensremessas->find('all')->where(['Itensremessas.remessa_id '=>$id]);

                    if($itens->isEmpty()){

                        $this->Flash->error('Não existem itens relacionados a esta remessa');
                        return $this->redirect(['action' => 'view', $remessa->id]);
                        
                    }else{
                        //crio a variavel soma para acumular os custos de cada item deste lote
                        $soma=0;
                        foreach ($itens as $itensremessa):
                            $soma=$soma+$itensremessa->custoitem;
                        endforeach;
        
                        // ----------BLOCO PARA ATUALIZAR O REGISTRO DA REMESSA ---------------------
        
                            $remessa->custoitens=$soma;
                            $remessa->custoremessa=($remessa->custoitens) + ($remessa->maodeobra);

                            $remessa->custounit=($remessa->custoremessa)/$remessa->quantidade;
                            $remessa->finalizado=1;
        
                        // ---------- FIM DO BLOCO DE ATUALIZAÇÃO DA REMESSA ------------------------
                        
        
        
                        if ($this->Remessas->save($remessa)) {
                            $this->Flash->success('Lote finalizado com sucesso');
                        } else {
                            $this->Flash->error('Não foi possível finalizar a remessa.');
                        }
                        return $this->redirect(['action' => 'view', $remessa->id]);  
                    }

                }else{
                    $this->Flash->error('A remessa não está completo. Finalize os ítens, feche a remessa para finalizar');
                    return $this->redirect(['action' => 'view', $remessa->id]);
                }
                                                    
            }else{
                $this->Flash->error('Não é possivel finalizar sem a quantidae produzida na remessa');
                return $this->redirect(['action' => 'view', $remessa->id]);
            }
        }else{
            $this->Flash->error('remessa já finalizado');
            return $this->redirect(['action' => 'view', $remessa->id]);
        }
    }
    /*
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $remessa = $this->Remessas->get($id);
        if ($this->Remessas->delete($remessa)) {
            $this->Flash->success(__('The remessa has been deleted.'));
        } else {
            $this->Flash->error(__('The remessa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    */


    /*
    public function edit($id = null)
    {
        $remessa = $this->Remessas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $remessa = $this->Remessas->patchEntity($remessa, $this->request->getData());
            if ($this->Remessas->save($remessa)) {
                $this->Flash->success(__('The remessa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The remessa could not be saved. Please, try again.'));
        }
        $primas = $this->Remessas->Primas->find('list', ['limit' => 200]);
        $this->set(compact('remessa', 'primas'));
    }
    */
}
