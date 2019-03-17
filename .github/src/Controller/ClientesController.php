<?php
namespace App\Controller;

use App\Controller\AppController;

class ClientesController extends AppController
{
    public function index()
    {
        $clientes = $this->paginate($this->Clientes->find()->where(['tipo IN '=>['A','C']]));
        $this->set(compact('clientes'));
    }

    public function fornecedores()
    {
        $this->viewBuilder()->setTemplate('index');
        $clientes = $this->paginate($this->Clientes->find()->where(['tipo IN '=>['A','F']]));
        $titulo = 'F';
        $this->set(compact('clientes','titulo'));
    }

    public function view($id = null)
    {
        $cliente = $this->Clientes->get($id, [
            'contain' => []
        ]);
        $this->set('cliente', $cliente);
    }

    public function add()
    {
        $cliente = $this->Clientes->newEntity();
        if ($this->request->is('post')) {
            $cliente = $this->Clientes->patchEntity($cliente, $this->request->getData());
            if ($this->Clientes->save($cliente)) {
                $this->Flash->success(__('The cliente has been saved.'));
                if($cliente->tipo=='F'){
                    return $this->redirect(['action' => 'fornecedores']);
                }else{
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The cliente could not be saved. Please, try again.'));
        }
        $this->set(compact('cliente'));
    }

    public function ativar($id)
    {
        $cliente = $this->Clientes->get($id);
        $cliente->active = ($cliente->active==1?0:1);
        $this->Clientes->save($cliente);
        return $this->redirect($this->referer());
    }

    public function edit($id = null)
    {
        $cliente = $this->Clientes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cliente = $this->Clientes->patchEntity($cliente, $this->request->getData());
            if ($this->Clientes->save($cliente)) {
                $this->Flash->success(__('The cliente has been saved.'));
                if($cliente->tipo=='F'){
                    return $this->redirect(['action' => 'fornecedores']);
                }else{
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The cliente could not be saved. Please, try again.'));
        }
        $this->set(compact('cliente'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cliente = $this->Clientes->get($id);
        if ($this->Clientes->delete($cliente)) {
            $this->Flash->success(__('The cliente has been deleted.'));
        } else {
            $this->Flash->error(__('The cliente could not be deleted. Please, try again.'));
        }
        if($cliente->tipo=='F'){
            return $this->redirect(['action' => 'fornecedores']);
        }else{
            return $this->redirect(['action' => 'index']);
        }   
    }
}
