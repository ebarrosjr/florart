<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ComprasTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('compras');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id'
        ]);
        $this->belongsTo('FormaPagamentos', [
            'foreignKey' => 'forma_pagamento_id'
        ]);
        $this->hasMany('ItensNotas', [
            'foreignKey' => 'nota_id'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->dateTime('data')
            ->allowEmptyDateTime('data');

        $validator
            ->scalar('numero_nota')
            ->maxLength('numero_nota', 45)
            ->allowEmptyString('numero_nota');

        $validator
            ->numeric('valor_total')
            ->greaterThanOrEqual('valor_total', 0)
            ->allowEmptyString('valor_total');

        $validator
            ->numeric('frete')
            ->greaterThanOrEqual('frete', 0)
            ->allowEmptyString('frete');

        $validator
            ->boolean('pago')
            ->allowEmptyString('pago');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['cliente_id'], 'Clientes'));
        $rules->add($rules->existsIn(['forma_pagamento_id'], 'FormaPagamentos'));

        return $rules;
    }
}
