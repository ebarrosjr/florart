<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UnidadeMedidasTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('unidade_medidas');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->belongsTo('ParentUnidadeMedidas', [
            'className' => 'UnidadeMedidas',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('Fabricacao', [
            'foreignKey' => 'unidade_medida_id'
        ]);
        $this->hasMany('ItensNotas', [
            'foreignKey' => 'unidade_medida_id'
        ]);
        $this->hasMany('Lotes', [
            'foreignKey' => 'unidade_medida_id'
        ]);
        $this->hasMany('PedidoProdutos', [
            'foreignKey' => 'unidade_medida_id'
        ]);
        $this->hasMany('Prefabricacao', [
            'foreignKey' => 'unidade_medida_id'
        ]);
        $this->hasMany('ChildUnidadeMedidas', [
            'className' => 'UnidadeMedidas',
            'foreignKey' => 'parent_id'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 45)
            ->allowEmptyString('nome');

        $validator
            ->scalar('sigla')
            ->maxLength('sigla', 10)
            ->allowEmptyString('sigla');

        $validator
            ->numeric('fator_multiplicativo')
            ->greaterThanOrEqual('fator_multiplicativo', 0)
            ->allowEmptyString('fator_multiplicativo');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentUnidadeMedidas'));

        return $rules;
    }
}
