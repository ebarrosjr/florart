<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FormaPagamentos Model
 *
 * @property \App\Model\Table\ComprasTable|\Cake\ORM\Association\HasMany $Compras
 *
 * @method \App\Model\Entity\FormaPagamento get($primaryKey, $options = [])
 * @method \App\Model\Entity\FormaPagamento newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FormaPagamento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FormaPagamento|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FormaPagamento|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FormaPagamento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FormaPagamento[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FormaPagamento findOrCreate($search, callable $callback = null, $options = [])
 */
class FormaPagamentosTable extends Table
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

        $this->setTable('forma_pagamentos');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->hasMany('Compras', [
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
            ->scalar('nome')
            ->maxLength('nome', 45)
            ->allowEmptyString('nome');

        return $validator;
    }
}
