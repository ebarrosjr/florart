<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItensProducao Entity
 *
 * @property int $id
 * @property int|null $manufatura_id
 * @property int|null $materia_prima_id
 * @property int|null $prefabricacao_id
 * @property int|null $user_id
 * @property float|null $quantidade
 * @property float|null $valor_combinado
 * @property bool|null $unitario
 * @property \Cake\I18n\FrozenTime|null $data_inicio
 * @property \Cake\I18n\FrozenTime|null $data_fim
 * @property float|null $valor_pago
 * @property int|null $forma_pagamento_id
 *
 * @property \App\Model\Entity\Manufatura $manufatura
 * @property \App\Model\Entity\MateriaPrima $materia_prima
 * @property \App\Model\Entity\Prefabricacao $prefabricacao
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\FormaPagamento $forma_pagamento
 */
class ItensProducao extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'manufatura_id' => true,
        'materia_prima_id' => true,
        'prefabricacao_id' => true,
        'user_id' => true,
        'quantidade' => true,
        'valor_combinado' => true,
        'unitario' => true,
        'data_inicio' => true,
        'data_fim' => true,
        'valor_pago' => true,
        'forma_pagamento_id' => true,
        'manufatura' => true,
        'materia_prima' => true,
        'prefabricacao' => true,
        'user' => true,
        'forma_pagamento' => true
    ];
}
