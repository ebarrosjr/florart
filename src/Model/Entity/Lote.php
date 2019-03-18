<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lote Entity
 *
 * @property int $id
 * @property int|null $fabricacao_id
 * @property string|null $numero
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenDate|null $validade
 * @property bool|null $finalizado
 * @property float|null $quantidade
 * @property int|null $unidade_medida_id
 *
 * @property \App\Model\Entity\Fabricacao $fabricacao
 */
class Lote extends Entity
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
        'fabricacao_id' => true,
        'numero' => true,
        'created' => true,
        'validade' => true,
        'finalizado' => true,
        'quantidade' => true,
        'unidade_medida_id' => true,
        'fabricacao' => true
    ];
}
