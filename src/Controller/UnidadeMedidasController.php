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
}
