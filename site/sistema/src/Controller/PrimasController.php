<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * Primas Controller
 *
 * @property \App\Model\Table\PrimasTable $Primas
 *
 * @method \App\Model\Entity\Prima[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PrimasController extends AppController
{

    public function buscaPorAlmoxarifado()
    {
        $id = $this->request->getData('id');
        $this->Primasestoques = TableRegistry::get('Primasestoques');
        $query = $this->Primasestoques->find('all')->select(['id','nome']);
        if($id!=null){
            $query->where(['prima_id'=>$id, 'estoque > 0']);
        }
        $query->hydrate();
        $linhas = $query->toList();
        $this->viewBuilder()->setTemplate('ajax');
        $this->RequestHandler->renderAs($this, 'json');
        $this->set('retorno', $linhas);
    }
    
    //metodo da redundancia dos campos
    public function index()
    {
        $primas = $this->Primas->find('all')->contain(['Primasestoques', 'Primatipos'])->order([ 'Primas.ativo'=>'desc', 'Primas.nome'=>'asc']);
        $primas = $this->paginate($primas);

        $this->set(compact('primas'));
    }
    
    

    //ok
    //trazendo a view do banco
    /*
    public function index()
    {
        
        $this->Primasmovimentos= TableRegistry::get('Primasmovimentos');
        $primas = $this->Primasmovimentos->find('all')->contain(['Primas']);
        $this->set(compact('primas'));
    }
    */

    //ok
    public function view($id = null)
    {
        $prima = $this->Primas->get($id, [
            'contain' => [ 'Primasestoques']
        ]);

        $this->Primasestoques= TableRegistry::get('Primasestoques');
        $pest = $this->Primasestoques->find('all')->contain(['Primas'])
                                                    ->where(['Primasestoques.prima_id'=>$id]) 
                                                    ->order(['Primasestoques.operacao'=>'Asc', 'Primasestoques.estoque'=>'desc'])
        ;

        $this->Itenslotes= TableRegistry::get('Itenslotes');
        $lt = $this->Itenslotes->find('all')->contain(['Primas', 'Lotes', 'Primasestoques'])
                                                    ->where(['Itenslotes.prima_id'=>$id]) 
                                                    
        ;

        $this->Prejuizos= TableRegistry::get('Prejuizos');
        $prej = $this->Prejuizos->find('all')->contain(['Primas', 'Primasestoques'])
                                                    ->where(['Prejuizos.prima_id'=>$id]) 
                                                    
        ;


        $this->set(compact('prima', $prima, 'pest', 'lt', 'prej'));
    }
    

    //ok
    public function add()
    {
        $prima = $this->Primas->newEntity();
        if ($this->request->is('post')) {
            $prima = $this->Primas->patchEntity($prima, $this->request->getData());
            if ($this->Primas->save($prima)) {
                $this->Flash->success(__('The prima has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The prima could not be saved. Please, try again.'));
        }
        $this->Primatipos= TableRegistry::get('Primatipos');
        $tipos = $this->Primatipos->find('list');
        $this->set(compact('prima', 'tipos'));
    }

    //ok
    public function edit($id = null)
    {
        $prima = $this->Primas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $prima = $this->Primas->patchEntity($prima, $this->request->getData());
            if ($this->Primas->save($prima)) {
                $this->Flash->success(__('The prima has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The prima could not be saved. Please, try again.'));
        }
        $this->Primatipos= TableRegistry::get('Primatipos');
        $tipos = $this->Primatipos->find('list');
        $this->set(compact('prima', 'tipos'));   
    }

    //ok
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $prima = $this->Primas->get($id);
        $prima->ativo=0;
        if ($this->Primas->save($prima)) {
            $this->Flash->success(__('The prima has been deleted.'));
        } else {
            $this->Flash->error(__('The prima could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
