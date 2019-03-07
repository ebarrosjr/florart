<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItensNota Entity
 *
 * @property int $id
 * @property int|null $nota_id
 * @property int|null $item
 * @property float|null $quantidade
 * @property float|null $valor_unitario
 * @property int|null $unidade_medida_id
 * @property int|null $situacao_id
 *
 * @property \App\Model\Entity\Nota $nota
 * @property \App\Model\Entity\UnidadeMedida $unidade_medida
 * @property \App\Model\Entity\Situacao $situacao
 */
class ItensNota extends Entity
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
        'nota_id' => true,
        'item' => true,
        'quantidade' => true,
        'valor_unitario' => true,
        'unidade_medida_id' => true,
        'situacao_id' => true,
        'compra' => true,
        'unidade_medida' => true,
        'situacao' => true
    ];
}
