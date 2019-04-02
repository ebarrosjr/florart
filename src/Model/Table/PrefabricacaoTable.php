<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PrefabricacaoTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('prefabricacao');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->belongsTo('Produtos', [
            'foreignKey' => 'produto_id'
        ]);
        $this->belongsTo('GrupoProdutos', [
            'foreignKey' => 'grupo_produto_id'
        ]);
        $this->belongsTo('TipoProdutos', [
            'foreignKey' => 'tipo_produto_id'
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
            ->dateTime('data_fabricacao')
            ->allowEmptyDateTime('data_fabricacao');

        $validator
            ->dateTime('data_validade')
            ->allowEmptyDateTime('data_validade');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 45)
            ->allowEmptyString('nome');

        $validator
            ->numeric('quantidade')
            ->allowEmptyString('quantidade');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['unidade_medida_id'], 'UnidadeMedidas'));
        return $rules;
    }
}
