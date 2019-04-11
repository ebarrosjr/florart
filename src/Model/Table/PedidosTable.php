<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pedidos Model
 *
 * @property \App\Model\Table\ClientesTable|\Cake\ORM\Association\BelongsTo $Clientes
 * @property |\Cake\ORM\Association\HasMany $PedidoProdutos
 *
 * @method \App\Model\Entity\Pedido get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pedido newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pedido[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pedido|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pedido|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pedido patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pedido[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pedido findOrCreate($search, callable $callback = null, $options = [])
 */
class PedidosTable extends Table
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

        $this->setTable('pedidos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id'
        ]);
        $this->hasMany('PedidoProdutos', [
            'foreignKey' => 'pedido_id'
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
            ->dateTime('data_pedido')
            ->allowEmptyDateTime('data_pedido');

        $validator
            ->dateTime('previsao_entrega')
            ->allowEmptyDateTime('previsao_entrega');

        $validator
            ->dateTime('data_entrega')
            ->allowEmptyDateTime('data_entrega');

        $validator
            ->boolean('situacao')
            ->allowEmptyString('situacao');

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
        $rules->add($rules->existsIn(['cliente_id'], 'Clientes'));

        return $rules;
    }
}
