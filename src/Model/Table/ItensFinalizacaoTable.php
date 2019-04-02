<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItensFinalizacao Model
 *
 * @property \App\Model\Table\FabricacaosTable|\Cake\ORM\Association\BelongsTo $Fabricacaos
 * @property \App\Model\Table\ManufaturasTable|\Cake\ORM\Association\BelongsTo $Manufaturas
 * @property \App\Model\Table\MateriaPrimasTable|\Cake\ORM\Association\BelongsTo $MateriaPrimas
 * @property \App\Model\Table\PrefabricacaosTable|\Cake\ORM\Association\BelongsTo $Prefabricacaos
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\FormaPagamentosTable|\Cake\ORM\Association\BelongsTo $FormaPagamentos
 *
 * @method \App\Model\Entity\ItensFinalizacao get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItensFinalizacao newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItensFinalizacao[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItensFinalizacao|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItensFinalizacao|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItensFinalizacao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItensFinalizacao[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItensFinalizacao findOrCreate($search, callable $callback = null, $options = [])
 */
class ItensFinalizacaoTable extends Table
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

        $this->setTable('itens_finalizacao');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Fabricacao', [
            'foreignKey' => 'fabricacao_id'
        ]);
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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['fabricacao_id'], 'Fabricacao'));
        $rules->add($rules->existsIn(['manufatura_id'], 'Manufaturas'));
        $rules->add($rules->existsIn(['materia_prima_id'], 'MateriaPrimas'));
        $rules->add($rules->existsIn(['prefabricacao_id'], 'Prefabricacao'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['forma_pagamento_id'], 'FormaPagamentos'));

        return $rules;
    }
}
