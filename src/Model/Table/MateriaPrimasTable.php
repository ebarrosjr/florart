<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class MateriaPrimasTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('materia_primas');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->belongsTo('TipoMateriaPrimas', [
            'foreignKey' => 'tipo_materia_prima_id'
        ]);
        $this->hasMany('Compras', [
            'foreignKey' => 'item'
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

        $validator
            ->nonNegativeInteger('estoque_minimo')
            ->allowEmptyString('estoque_minimo');

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
        $rules->add($rules->existsIn(['tipo_materia_prima_id'], 'TipoMateriaPrimas'));

        return $rules;
    }
}
