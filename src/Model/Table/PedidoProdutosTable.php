<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PedidoProdutos Model
 *
 * @property \App\Model\Table\PedidosTable|\Cake\ORM\Association\BelongsTo $Pedidos
 * @property \App\Model\Table\ProdutosTable|\Cake\ORM\Association\BelongsTo $Produtos
 * @property \App\Model\Table\UnidadeMedidasTable|\Cake\ORM\Association\BelongsTo $UnidadeMedidas
 *
 * @method \App\Model\Entity\PedidoProduto get($primaryKey, $options = [])
 * @method \App\Model\Entity\PedidoProduto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PedidoProduto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PedidoProduto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PedidoProduto|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PedidoProduto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PedidoProduto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PedidoProduto findOrCreate($search, callable $callback = null, $options = [])
 */
class PedidoProdutosTable extends Table
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

        $this->setTable('pedido_produtos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Pedidos', [
            'foreignKey' => 'pedido_id'
        ]);
        $this->belongsTo('Produtos', [
            'foreignKey' => 'produto_id'
        ]);
        $this->belongsTo('UnidadeMedidas', [
            'foreignKey' => 'unidade_medida_id'
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
            ->nonNegativeInteger('quantidade')
            ->allowEmptyString('quantidade');

        $validator
            ->numeric('valor_combinado')
            ->greaterThanOrEqual('valor_combinado', 0)
            ->allowEmptyString('valor_combinado');

        $validator
            ->boolean('entregue')
            ->allowEmptyString('entregue');

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
        $rules->add($rules->existsIn(['pedido_id'], 'Pedidos'));
        $rules->add($rules->existsIn(['produto_id'], 'Produtos'));
        $rules->add($rules->existsIn(['unidade_medida_id'], 'UnidadeMedidas'));

        return $rules;
    }
}
