<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * Produtogrupos Controller
 *
 * @property \App\Model\Table\ProdutogruposTable $Produtogrupos
 *
 * @method \App\Model\Entity\Produtogrupo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProdutogruposController extends AppController
{

    //ok
    public function index()
    {
        //$produtogrupos = $this->paginate($this->Produtogrupos);

        $produtogrupos = $this->Produtogrupos->find('all');


        $this->set(compact('produtogrupos'));
    }

    //ok
    public function view($id = null)
    {
        $produtogrupo = $this->Produtogrupos->get($id, [
            'contain' => ['Produtos', 'Produtotipos']
        ]);

        $this->Lotes= TableRegistry::get('Lotes');
        $lt = $this->Lotes->find('all')->contain(['Produtogrupos'])
                                                    ->where(['Lotes.produtogrupo_id'=>$id]) 
        ;

        $this->Produtos= TableRegistry::get('Produtos');
        $pd = $this->Produtos->find('all')->contain(['Produtogrupos'])
                                                    ->where(['Produtos.produtogrupo_id'=>$id]) 
        ;

        $this->set(compact('produtogrupo', $produtogrupo, 'lt', 'pd'));
    }

    
    public function add()
    {
        $produtogrupo = $this->Produtogrupos->newEntity();
        if ($this->request->is('post')) {
            $produtogrupo = $this->Produtogrupos->patchEntity($produtogrupo, $this->request->getData());
            if ($this->Produtogrupos->save($produtogrupo)) {
                $this->Flash->success(__('The produtogrupo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The produtogrupo could not be saved. Please, try again.'));
        }

        $this->Produtotipos = TableRegistry::get('Produtotipos');
        $pt = $this->Produtotipos->find('list')->order(['Produtotipos.nome'=>'asc']);
        $this->set(compact('produtogrupo', 'pt'));
    }

    
    public function edit($id = null)
    {
        $produtogrupo = $this->Produtogrupos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $produtogrupo = $this->Produtogrupos->patchEntity($produtogrupo, $this->request->getData());
            if ($this->Produtogrupos->save($produtogrupo)) {
                $this->Flash->success(__('The produtogrupo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The produtogrupo could not be saved. Please, try again.'));
        }
        $this->set(compact('produtogrupo'));
    }

    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $produtogrupo = $this->Produtogrupos->get($id);
        if ($this->Produtogrupos->delete($produtogrupo)) {
            $this->Flash->success(__('The produtogrupo has been deleted.'));
        } else {
            $this->Flash->error(__('The produtogrupo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function codigo($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $produtogrupo = $this->Produtogrupos->get($id);
        $produtogrupo->codigogrupo=($id+900);
        if ($this->Produtogrupos->save($produtogrupo)) {
            $this->Flash->success(__('The produtotipo has been deleted.'));
        } else {
            $this->Flash->error(__('The produtotipo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
