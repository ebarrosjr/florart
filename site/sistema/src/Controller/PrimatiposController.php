<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Primatipos Controller
 *
 * @property \App\Model\Table\PrimatiposTable $Primatipos
 *
 * @method \App\Model\Entity\Primatipo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PrimatiposController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $primatipos = $this->paginate($this->Primatipos);

        $this->set(compact('primatipos'));
    }

    /**
     * View method
     *
     * @param string|null $id Primatipo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $primatipo = $this->Primatipos->get($id, [
            'contain' => []
        ]);

        $this->set('primatipo', $primatipo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $primatipo = $this->Primatipos->newEntity();
        if ($this->request->is('post')) {
            $primatipo = $this->Primatipos->patchEntity($primatipo, $this->request->getData());
            if ($this->Primatipos->save($primatipo)) {
                $this->Flash->success(__('The primatipo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The primatipo could not be saved. Please, try again.'));
        }
        $this->set(compact('primatipo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Primatipo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $primatipo = $this->Primatipos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $primatipo = $this->Primatipos->patchEntity($primatipo, $this->request->getData());
            if ($this->Primatipos->save($primatipo)) {
                $this->Flash->success(__('The primatipo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The primatipo could not be saved. Please, try again.'));
        }
        $this->set(compact('primatipo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Primatipo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $primatipo = $this->Primatipos->get($id);
        if ($this->Primatipos->delete($primatipo)) {
            $this->Flash->success(__('The primatipo has been deleted.'));
        } else {
            $this->Flash->error(__('The primatipo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
