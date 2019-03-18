<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fabricacao Model
 *
 * @property \App\Model\Table\ProdutosTable|\Cake\ORM\Association\BelongsTo $Produtos
 * @property \App\Model\Table\UnidadeMedidasTable|\Cake\ORM\Association\BelongsTo $UnidadeMedidas
 * @property |\Cake\ORM\Association\HasMany $Lotes
 *
 * @method \App\Model\Entity\Fabricacao get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fabricacao newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Fabricacao[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fabricacao|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fabricacao|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fabricacao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fabricacao[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fabricacao findOrCreate($search, callable $callback = null, $options = [])
 */
class FabricacaoTable extends Table
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

        $this->setTable('fabricacao');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Produtos', [
            'foreignKey' => 'produto_id'
        ]);
        $this->belongsTo('UnidadeMedidas', [
            'foreignKey' => 'unidade_medida_id'
        ]);
        $this->hasMany('Lotes', [
            'foreignKey' => 'fabricacao_id'
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
            ->dateTime('data_fabricacao')
            ->allowEmptyDateTime('data_fabricacao');

        $validator
            ->dateTime('data_validade')
            ->allowEmptyDateTime('data_validade');

        $validator
            ->numeric('quantidade')
            ->greaterThanOrEqual('quantidade', 0)
            ->allowEmptyString('quantidade');

        $validator
            ->scalar('observacao')
            ->maxLength('observacao', 4294967295)
            ->allowEmptyString('observacao');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['produto_id'], 'Produtos'));
        $rules->add($rules->existsIn(['unidade_medida_id'], 'UnidadeMedidas'));

        return $rules;
    }
}
