<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class TipoMateriaPrimasController extends AppController
{
    public function index()
    {
        $tipoMateriaPrimas = $this->TipoMateriaPrimas->find('all');
        $tipoProdutos = TableRegistry::get('TipoProdutos')->find('all');
        $grupoProdutos = TableRegistry::get('GrupoProdutos')->find('all');
        $this->set(compact('tipoMateriaPrimas','tipoProdutos','grupoProdutos'));
    }

    public function add()
    {
        $grtp = $this->TipoMateriaPrimas->newEntity();
        if ($this->request->is('post')) {
            $grtp = $this->TipoMateriaPrimas->patchEntity($grtp, $this->request->getData());
            if ($this->TipoMateriaPrimas->save($grtp)) {
                $this->Flash->success(__('The tipo materia prima has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo materia prima could not be saved. Please, try again.'));
        }
        $this->set(compact('grtp'));
    }

    public function addTipo()
    {
        $this->viewBuilder()->setTemplate('add');
        $this->TipoProdutos = TableRegistry::get('TipoProdutos');
        $grtp = $this->TipoProdutos->newEntity();
        if ($this->request->is('post')) {
            $tipoMateriaPrima = $this->TipoProdutos->patchEntity($grtp, $this->request->getData());
            if ($this->TipoProdutos->save($grtp)) {
                $this->Flash->success(__('The tipo produto has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo produto could not be saved. Please, try again.'));
        }
        $this->set(compact('grtp'));
    }

    public function addGrupo()
    {
        $this->viewBuilder()->setTemplate('add');
        $this->GrupoProdutos = TableRegistry::get('GrupoProdutos');
        $grtp = $this->GrupoProdutos->newEntity();
        if ($this->request->is('post')) {
            $tipoMateriaPrima = $this->GrupoProdutos->patchEntity($grtp, $this->request->getData());
            if ($this->GrupoProdutos->save($grtp)) {
                $this->Flash->success(__('The tipo produto has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo produto could not be saved. Please, try again.'));
        }
        $this->set(compact('grtp'));
    }

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
