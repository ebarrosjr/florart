<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Prefabricacao Entity
 *
 * @property int $id
 * @property int|null $produto_id
 * @property int|null $grupo_produto_id
 * @property int|null $tipo_produto_id
 * @property \Cake\I18n\FrozenTime|null $data_fabricacao
 * @property \Cake\I18n\FrozenTime|null $data_validade
 * @property string|null $nome
 * @property float|null $quantidade
 * @property int|null $unidade_medida_id
 *
 * @property \App\Model\Entity\Produto $produto
 * @property \App\Model\Entity\GrupoProduto $grupo_produto
 * @property \App\Model\Entity\TipoProduto $tipo_produto
 * @property \App\Model\Entity\UnidadeMedida $unidade_medida
 */
class Prefabricacao extends Entity
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
        'grupo_produto_id' => true,
        'tipo_produto_id' => true,
        'data_fabricacao' => true,
        'data_validade' => true,
        'nome' => true,
        'quantidade' => true,
        'unidade_medida_id' => true,
        'produto' => true,
        'grupo_produto' => true,
        'tipo_produto' => true,
        'unidade_medida' => true
    ];
}
