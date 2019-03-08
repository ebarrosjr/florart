<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fabricacao Entity
 *
 * @property int $id
 * @property int|null $produto_id
 * @property int|null $materia_prima_id
 * @property float|null $quantidade
 * @property int|null $manufatura_id
 * @property int|null $user_id
 * @property float|null $valor
 * @property bool|null $unitario
 * @property \Cake\I18n\FrozenTime|null $data
 *
 * @property \App\Model\Entity\Produto $produto
 * @property \App\Model\Entity\MateriaPrima $materia_prima
 * @property \App\Model\Entity\Manufatura $manufatura
 * @property \App\Model\Entity\User $user
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
        'materia_prima_id' => true,
        'quantidade' => true,
        'manufatura_id' => true,
        'user_id' => true,
        'valor' => true,
        'unitario' => true,
        'data' => true,
        'produto' => true,
        'materia_prima' => true,
        'manufatura' => true,
        'user' => true
    ];
}
