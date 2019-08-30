<?php
namespace App\Controller;

use App\Controller\AppController;

class UnidadeMedidasController extends AppController
{

    public function index()
    {
        $unidades = $this->UnidadeMedidas->find('all')->contain(['ChildUnidadeMedidas','ParentUnidadeMedidas']);
        $unidades = $this->paginate($unidades);

        $this->set(compact('unidades'));
    }

    public function add()
    {
        $um = $this->UnidadeMedidas->newEntity();
        if($this->request->is('post'))
        {
            $um = $this->UnidadeMedidas->patchEntity($um,$this->request->getData());
            $um = $this->UnidadeMedidas->save($um);
            if($um)
            {
                $this->Flash->success('A unidade de medida foi gravada com sucesso!');
                return $this->redirect(['action'=>'index']);
            }else{
                $this->Flash->error('Houve um erro gravando a unidade, por favor tente novamente!');
            }
        }
        $unidades = $this->UnidadeMedidas->find('list')->where('(parent_id IS NULL)');
        $this->set(compact('um','unidades'));
    }

    public function edit($id)
    {
        $um = $this->UnidadeMedidas->get($id);
        if($this->request->is(['post','put','patch']))
        {
            $um = $this->UnidadeMedidas->patchEntity($um,$this->request->getData());
            $um = $this->UnidadeMedidas->save($um);
            if($um)
            {
                $this->Flash->success('A unidade de medida foi atualizada com sucesso!');
                return $this->redirect(['action'=>'index']);
            }else{
                $this->Flash->error('Houve um erro editando a unidade de medida, por favor tente novamente!');
            }
        }
        $unidades = $this->UnidadeMedidas->find('list')->where('(parent_id IS NULL)');
        $this->set(compact('um','unidades'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $um = $this->UnidadeMedidas->get($id);
        if ($this->UnidadeMedidas->delete($um)) {
            $this->Flash->success('Unidade de medida excluída com sucesso!');
        } else {
            $this->Flash->error('Não é possível excluir a unidade de medida. Por favor, tente novamente.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
