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
        $this->setDisplayField('id');
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
        return $validator;
    }
}
