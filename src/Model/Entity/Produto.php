<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Produto Entity
 *
 * @property int $id
 * @property int|null $grupo_produto_id
 * @property string|null $nome
 * @property float|null $valor_varejo
 * @property float|null $valor_atacado
 * @property int|null $estoque_minimo
 *
 * @property \App\Model\Entity\GrupoProduto $grupo_produto
 */
class Produto extends Entity
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
        'grupo_produto_id' => true,
        'nome' => true,
        'valor_varejo' => true,
        'valor_atacado' => true,
        'estoque_minimo' => true,
        'atacado_minimo' => true,
        'grupo_produto' => true
    ];
}
