<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Produtotipos Controller
 *
 * @property \App\Model\Table\ProdutotiposTable $Produtotipos
 *
 * @method \App\Model\Entity\Produtotipo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProdutotiposController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => []
        ];
        $produtotipos = $this->paginate($this->Produtotipos);

        $this->set(compact('produtotipos'));
    }

    /**
     * View method
     *
     * @param string|null $id Produtotipo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $produtotipo = $this->Produtotipos->get($id, [
            'contain' => []
        ]);

        $this->set('produtotipo', $produtotipo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $produtotipo = $this->Produtotipos->newEntity();
        if ($this->request->is('post')) {
            $produtotipo = $this->Produtotipos->patchEntity($produtotipo, $this->request->getData());
            if ($this->Produtotipos->save($produtotipo)) {
                $this->Flash->success(__('The produtotipo has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The produtotipo could not be saved. Please, try again.'));
        }
        $this->set(compact('produtotipo'));
    }


    

    
    public function edit($id = null)
    {
        $produtotipo = $this->Produtotipos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $produtotipo = $this->Produtotipos->patchEntity($produtotipo, $this->request->getData());
            if ($this->Produtotipos->save($produtotipo)) {
                $this->Flash->success(__('The produtotipo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The produtotipo could not be saved. Please, try again.'));
        }
        $this->set(compact('produtotipo'));
    }

    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $produtotipo = $this->Produtotipos->get($id);
        if ($this->Produtotipos->delete($produtotipo)) {
            $this->Flash->success(__('The produtotipo has been deleted.'));
        } else {
            $this->Flash->error(__('The produtotipo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function codigo($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $produtotipo = $this->Produtotipos->get($id);
        $produtotipo->codigotipo=($id+900);
        if ($this->Produtotipos->save($produtotipo)) {
            $this->Flash->success(__('The produtotipo has been deleted.'));
        } else {
            $this->Flash->error(__('The produtotipo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
