<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PedidoProdutosTable extends Table
{
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

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['pedido_id'], 'Pedidos'));
        $rules->add($rules->existsIn(['produto_id'], 'Produtos'));
        $rules->add($rules->existsIn(['unidade_medida_id'], 'UnidadeMedidas'));

        return $rules;
    }
}
