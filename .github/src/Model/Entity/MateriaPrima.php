<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MateriaPrima Entity
 *
 * @property int $id
 * @property int|null $tipo_materia_prima_id
 * @property string|null $nome
 * @property int|null $estoque_minimo
 *
 * @property \App\Model\Entity\TipoMateriaPrima $tipo_materia_prima
 */
class MateriaPrima extends Entity
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
        'tipo_materia_prima_id' => true,
        'nome' => true,
        'estoque_minimo' => true,
        'tipo_materia_prima' => true
    ];
}
