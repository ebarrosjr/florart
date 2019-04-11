<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pedido Entity
 *
 * @property int $id
 * @property int|null $cliente_id
 * @property \Cake\I18n\FrozenTime|null $data_pedido
 * @property \Cake\I18n\FrozenTime|null $previsao_entrega
 * @property \Cake\I18n\FrozenTime|null $data_entrega
 * @property bool|null $situacao
 * @property string|null $observacao
 *
 * @property \App\Model\Entity\Cliente $cliente
 */
class Pedido extends Entity
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
        'cliente_id' => true,
        'data_pedido' => true,
        'previsao_entrega' => true,
        'data_entrega' => true,
        'situacao' => true,
        'observacao' => true,
        'cliente' => true
    ];
}
