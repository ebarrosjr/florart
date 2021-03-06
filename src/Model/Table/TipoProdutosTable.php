<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TipoProdutosTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('tipo_produtos');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 45)
            ->allowEmptyString('nome');

        $validator
            ->scalar('codigo_ncn')
            ->maxLength('codigo_ncn', 45)
            ->allowEmptyString('codigo_ncn');

        return $validator;
    }
}
