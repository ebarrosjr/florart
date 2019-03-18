<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ItensProducaoTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('itens_producao');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Manufaturas', [
            'foreignKey' => 'manufatura_id'
        ]);
        $this->belongsTo('MateriaPrimas', [
            'foreignKey' => 'materia_prima_id'
        ]);
        $this->belongsTo('Prefabricacao', [
            'foreignKey' => 'prefabricacao_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('FormaPagamentos', [
            'foreignKey' => 'forma_pagamento_id'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->numeric('quantidade')
            ->greaterThanOrEqual('quantidade', 0)
            ->allowEmptyString('quantidade');

        $validator
            ->numeric('valor_combinado')
            ->greaterThanOrEqual('valor_combinado', 0)
            ->allowEmptyString('valor_combinado');

        $validator
            ->boolean('unitario')
            ->allowEmptyString('unitario');

        $validator
            ->dateTime('data_inicio')
            ->allowEmptyDateTime('data_inicio');

        $validator
            ->dateTime('data_fim')
            ->allowEmptyDateTime('data_fim');

        $validator
            ->numeric('valor_pago')
            ->greaterThanOrEqual('valor_pago', 0)
            ->allowEmptyString('valor_pago');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        return $rules;
    }
}
