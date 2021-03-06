<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fabricacao Entity
 *
 * @property int $id
 * @property int|null $produto_id
 * @property \Cake\I18n\FrozenTime|null $data_fabricacao
 * @property \Cake\I18n\FrozenTime|null $data_validade
 * @property float|null $quantidade
 * @property int|null $unidade_medida_id
 * @property string|null $observacao
 *
 * @property \App\Model\Entity\Produto $produto
 * @property \App\Model\Entity\UnidadeMedida $unidade_medida
 */
class Fabricacao extends Entity
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
        'produto_id' => true,
        'data_fabricacao' => true,
        'data_validade' => true,
        'quantidade' => true,
        'unidade_medida_id' => true,
        'observacao' => true,
        'produto' => true,
        'unidade_medida' => true
    ];
}
