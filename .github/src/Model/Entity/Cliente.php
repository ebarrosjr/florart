<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cliente Entity
 *
 * @property int $id
 * @property string|null $nome
 * @property string|null $cpfcnpj
 * @property string|null $razao_social
 * @property string|null $endereco
 * @property string|null $telefone
 * @property string|null $email
 * @property int|null $active
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $tipo
 */
class Cliente extends Entity
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
        'cpfcnpj' => true,
        'razao_social' => true,
        'endereco' => true,
        'telefone' => true,
        'email' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'tipo' => true
    ];
}
