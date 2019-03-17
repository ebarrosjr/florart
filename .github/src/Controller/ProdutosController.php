<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class ProdutosController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'contain' => ['GrupoProdutos']
        ];
        $produtos = $this->paginate($this->Produtos);
        $this->set(compact('produtos'));
    }

    public function maoDeObra()
    {
        $this->Manufaturas = TableRegistry::get('Manufaturas');
        $manufaturas = $this->paginate($this->Manufaturas);
        $this->set(compact('manufaturas'));
    }

    public function addmao()
    {
        $this->Manufaturas = TableRegistry::get('Manufaturas');
        $mao_de_obra = $this->Manufaturas->newEntity();
        if ($this->request->is('post')) {
            $mao_de_obra = $this->Manufaturas->patchEntity($mao_de_obra, $this->request->getData());
            if ($this->Manufaturas->save($mao_de_obra)) {
                $this->Flash->success(__('The produto has been saved.'));

                return $this->redirect(['action' => 'mao-de-obra']);
            }
            $this->Flash->error(__('The produto could not be saved. Please, try again.'));
        }
        $this->set(compact('mao_de_obra'));
    }

    public function edtmao($id=null)
    {
        $this->Manufaturas = TableRegistry::get('Manufaturas');
        $mao_de_obra = $this->Manufaturas->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mao_de_obra = $this->Manufaturas->patchEntity($mao_de_obra, $this->request->getData());
            if ($this->Manufaturas->save($mao_de_obra)) {
                $this->Flash->success(__('The produto has been saved.'));

                return $this->redirect(['action' => 'mao-de-obra']);
            }
            $this->Flash->error(__('The produto could not be saved. Please, try again.'));
        }
        $this->set(compact('mao_de_obra'));
    }

    public function delmao($id = null)
    {
        $this->Manufaturas = TableRegistry::get('Manufaturas');
        $this->request->allowMethod(['post', 'delete']);
        $mao_de_obra = $this->Manufaturas->get($id);
        if ($this->Manufaturas->delete($mao_de_obra)) {
            $this->Flash->success(__('The produto has been deleted.'));
        } else {
            $this->Flash->error(__('The produto could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'maoDeObra']);
    }

    public function add()
    {
        $produto = $this->Produtos->newEntity();
        if ($this->request->is('post')) {
            $produto = $this->Produtos->patchEntity($produto, $this->request->getData());
            if ($this->Produtos->save($produto)) {
                $this->Flash->success(__('The produto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The produto could not be saved. Please, try again.'));
        }
        $grupoProdutos = $this->Produtos->GrupoProdutos->find('list', ['limit' => 200]);
        $this->set(compact('produto', 'grupoProdutos'));
    }

    public function edit($id = null)
    {
        $produto = $this->Produtos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $produto = $this->Produtos->patchEntity($produto, $this->request->getData());
            if ($this->Produtos->save($produto)) {
                $this->Flash->success(__('The produto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The produto could not be saved. Please, try again.'));
        }
        $grupoProdutos = $this->Produtos->GrupoProdutos->find('list', ['limit' => 200]);
        $this->set(compact('produto', 'grupoProdutos'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $produto = $this->Produtos->get($id);
        if ($this->Produtos->delete($produto)) {
            $this->Flash->success(__('The produto has been deleted.'));
        } else {
            $this->Flash->error(__('The produto could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
