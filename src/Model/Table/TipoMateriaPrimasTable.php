<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TipoMateriaPrimasTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('tipo_materia_primas');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->hasMany('MateriaPrimas', [
            'foreignKey' => 'tipo_materia_prima_id'
        ]);
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
