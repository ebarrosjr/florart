<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ItensNotasTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('itens_notas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Compras', [
            'foreignKey' => 'nota_id'
        ]);
        $this->belongsTo('MateriaPrimas', [
            'foreignKey' => 'item'
        ]);
        $this->belongsTo('UnidadeMedidas', [
            'foreignKey' => 'unidade_medida_id'
        ]);
        $this->belongsTo('Situacaos', [
            'foreignKey' => 'situacao_id'
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
            ->nonNegativeInteger('item')
            ->allowEmptyString('item');

        $validator
            ->numeric('quantidade')
            ->greaterThanOrEqual('quantidade', 0)
            ->allowEmptyString('quantidade');

        $validator
            ->numeric('valor_unitario')
            ->greaterThanOrEqual('valor_unitario', 0)
            ->allowEmptyString('valor_unitario');

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
        $rules->add($rules->existsIn(['nota_id'], 'Compras'));
        $rules->add($rules->existsIn(['unidade_medida_id'], 'UnidadeMedidas'));
        $rules->add($rules->existsIn(['situacao_id'], 'Situacaos'));

        return $rules;
    }
}
