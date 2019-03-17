<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Compra extends Entity
{
    protected $_accessible = [
        'cliente_id' => true,
        'data' => true,
        'numero_nota' => true,
        'forma_pagamento_id' => true,
        'valor_total' => true,
        'frete' => true,
        'cliente' => true,
        'forma_pagamento' => true,
        'pago'=>true
    ];
}
