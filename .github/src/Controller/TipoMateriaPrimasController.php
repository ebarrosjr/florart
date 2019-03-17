<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TipoMateriaPrimas Controller
 *
 * @property \App\Model\Table\TipoMateriaPrimasTable $TipoMateriaPrimas
 *
 * @method \App\Model\Entity\TipoMateriaPrima[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TipoMateriaPrimasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tipoMateriaPrimas = $this->paginate($this->TipoMateriaPrimas);

        $this->set(compact('tipoMateriaPrimas'));
    }

    /**
     * View method
     *
     * @param string|null $id Tipo Materia Prima id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tipoMateriaPrima = $this->TipoMateriaPrimas->get($id, [
            'contain' => ['MateriaPrimas']
        ]);

        $this->set('tipoMateriaPrima', $tipoMateriaPrima);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tipoMateriaPrima = $this->TipoMateriaPrimas->newEntity();
        if ($this->request->is('post')) {
            $tipoMateriaPrima = $this->TipoMateriaPrimas->patchEntity($tipoMateriaPrima, $this->request->getData());
            if ($this->TipoMateriaPrimas->save($tipoMateriaPrima)) {
                $this->Flash->success(__('The tipo materia prima has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo materia prima could not be saved. Please, try again.'));
        }
        $this->set(compact('tipoMateriaPrima'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tipo Materia Prima id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tipoMateriaPrima = $this->TipoMateriaPrimas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tipoMateriaPrima = $this->TipoMateriaPrimas->patchEntity($tipoMateriaPrima, $this->request->getData());
            if ($this->TipoMateriaPrimas->save($tipoMateriaPrima)) {
                $this->Flash->success(__('The tipo materia prima has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo materia prima could not be saved. Please, try again.'));
        }
        $this->set(compact('tipoMateriaPrima'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tipo Materia Prima id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tipoMateriaPrima = $this->TipoMateriaPrimas->get($id);
        if ($this->TipoMateriaPrimas->delete($tipoMateriaPrima)) {
            $this->Flash->success(__('The tipo materia prima has been deleted.'));
        } else {
            $this->Flash->error(__('The tipo materia prima could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
