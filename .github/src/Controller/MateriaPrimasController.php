<?php
namespace App\Controller;

use App\Controller\AppController;

class MateriaPrimasController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'contain' => ['TipoMateriaPrimas']
        ];
        $materiaPrimas = $this->paginate($this->MateriaPrimas);
        $this->set(compact('materiaPrimas'));
    }

    public function busca()
    {
        $this->viewBuilder()->setTemplate('ajax');
        $tp = $this->request->getData('tipo_id');
        $mp = $this->MateriaPrimas->find('all',['fields'=>['id','nome']])->where(['tipo_materia_prima_id'=>$tp]);
        $mp->hydrate();
        $_mp = $mp->toList();
        $this->RequestHandler->renderAs($this, 'json');
        $this->set('retorno', $_mp);    
    }

    public function view($id = null)
    {
        $materiaPrima = $this->MateriaPrimas->get($id, [
            'contain' => ['TipoMateriaPrimas']
        ]);

        $this->set('materiaPrima', $materiaPrima);
    }

    public function add()
    {
        $materiaPrima = $this->MateriaPrimas->newEntity();
        if ($this->request->is('post')) {
            $materiaPrima = $this->MateriaPrimas->patchEntity($materiaPrima, $this->request->getData());
            if ($this->MateriaPrimas->save($materiaPrima)) {
                $this->Flash->success(__('The materia prima has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The materia prima could not be saved. Please, try again.'));
        }
        $tipoMateriaPrimas = $this->MateriaPrimas->TipoMateriaPrimas->find('list', ['limit' => 200]);
        $this->set(compact('materiaPrima', 'tipoMateriaPrimas'));
    }

    public function edit($id = null)
    {
        $materiaPrima = $this->MateriaPrimas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $materiaPrima = $this->MateriaPrimas->patchEntity($materiaPrima, $this->request->getData());
            if ($this->MateriaPrimas->save($materiaPrima)) {
                $this->Flash->success(__('The materia prima has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The materia prima could not be saved. Please, try again.'));
        }
        $tipoMateriaPrimas = $this->MateriaPrimas->TipoMateriaPrimas->find('list', ['limit' => 200]);
        $this->set(compact('materiaPrima', 'tipoMateriaPrimas'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $materiaPrima = $this->MateriaPrimas->get($id);
        if ($this->MateriaPrimas->delete($materiaPrima)) {
            $this->Flash->success(__('The materia prima has been deleted.'));
        } else {
            $this->Flash->error(__('The materia prima could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
