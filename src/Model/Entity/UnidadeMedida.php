<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UnidadeMedida Entity
 *
 * @property int $id
 * @property string|null $nome
 * @property string|null $sigla
 * @property int|null $parent_id
 * @property float|null $fator_multiplicativo
 *
 * @property \App\Model\Entity\ItensNota[] $itens_notas
 */
class UnidadeMedida extends Entity
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
        'nome' => true,
        'sigla' => true,
        'parent_id' => true,
        'fator_multiplicativo' => true,
        'itens_notas' => true,
        'parent_unidade_medida' => true
    ];
}
