<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class LotesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('lotes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Fabricacaos', [
            'foreignKey' => 'fabricacao_id'
        ]);
        $this->belongsTo('UnidadeMedidas', [
            'foreignKey' => 'unidade_medida_id'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 45)
            ->allowEmptyString('numero');

        $validator
            ->date('validade')
            ->allowEmptyDate('validade');

        $validator
            ->boolean('finalizado')
            ->allowEmptyString('finalizado');

        $validator
            ->numeric('quantidade')
            ->greaterThanOrEqual('quantidade', 0)
            ->allowEmptyString('quantidade');

        return $validator;
    }
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['fabricacao_id'], 'Fabricacao'));
        $rules->add($rules->existsIn(['unidade_medida_id'], 'UnidadeMedidas'));
        return $rules;
    }
}
