<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PedidoProduto Entity
 *
 * @property int $id
 * @property int|null $pedido_id
 * @property int|null $produto_id
 * @property int|null $quantidade
 * @property float|null $valor_combinado
 * @property int|null $unidade_medida_id
 * @property bool|null $entregue
 *
 * @property \App\Model\Entity\Pedido $pedido
 * @property \App\Model\Entity\Produto $produto
 * @property \App\Model\Entity\UnidadeMedida $unidade_medida
 */
class PedidoProduto extends Entity
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
        'pedido_id' => true,
        'produto_id' => true,
        'quantidade' => true,
        'valor_combinado' => true,
        'unidade_medida_id' => true,
        'entregue' => true,
        'pedido' => true,
        'produto' => true,
        'unidade_medida' => true
    ];
}
