<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GrupoProdutos Model
 *
 * @property \App\Model\Table\ProdutosTable|\Cake\ORM\Association\HasMany $Produtos
 *
 * @method \App\Model\Entity\GrupoProduto get($primaryKey, $options = [])
 * @method \App\Model\Entity\GrupoProduto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GrupoProduto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GrupoProduto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GrupoProduto|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GrupoProduto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GrupoProduto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GrupoProduto findOrCreate($search, callable $callback = null, $options = [])
 */
class GrupoProdutosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('grupo_produtos');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->hasMany('Produtos', [
            'foreignKey' => 'grupo_produto_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 150)
            ->allowEmptyString('nome');

        return $validator;
    }
}
