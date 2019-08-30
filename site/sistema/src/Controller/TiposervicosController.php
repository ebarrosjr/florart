<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tiposervicos Controller
 *
 * @property \App\Model\Table\TiposervicosTable $Tiposervicos
 *
 * @method \App\Model\Entity\Tiposervico[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TiposervicosController extends AppController
{

    //ok
    public function index()
    {
        $tiposervicos = $this->paginate($this->Tiposervicos);

        $this->set(compact('tiposervicos'));
    }

    /*
    public function view($id = null)
    {
        $tiposervico = $this->Tiposervicos->get($id, [
            'contain' => ['Servicos']
        ]);

        $this->set('tiposervico', $tiposervico);
    }
    */

    //ok
    public function add()
    {
        $tiposervico = $this->Tiposervicos->newEntity();
        if ($this->request->is('post')) {
            $tiposervico = $this->Tiposervicos->patchEntity($tiposervico, $this->request->getData());
            if ($this->Tiposervicos->save($tiposervico)) {
                $this->Flash->success(__('The tiposervico has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tiposervico could not be saved. Please, try again.'));
        }
        $this->set(compact('tiposervico'));
    }

    //ok
    public function edit($id = null)
    {
        $tiposervico = $this->Tiposervicos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tiposervico = $this->Tiposervicos->patchEntity($tiposervico, $this->request->getData());
            if ($this->Tiposervicos->save($tiposervico)) {
                $this->Flash->success(__('The tiposervico has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tiposervico could not be saved. Please, try again.'));
        }
        $this->set(compact('tiposervico'));
    }

    /*
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tiposervico = $this->Tiposervicos->get($id);
        if ($this->Tiposervicos->delete($tiposervico)) {
            $this->Flash->success(__('The tiposervico has been deleted.'));
        } else {
            $this->Flash->error(__('The tiposervico could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    */
}
