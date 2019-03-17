<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MateriaPrimas Model
 *
 * @property \App\Model\Table\TipoMateriaPrimasTable|\Cake\ORM\Association\BelongsTo $TipoMateriaPrimas
 *
 * @method \App\Model\Entity\MateriaPrima get($primaryKey, $options = [])
 * @method \App\Model\Entity\MateriaPrima newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MateriaPrima[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MateriaPrima|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MateriaPrima|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MateriaPrima patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MateriaPrima[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MateriaPrima findOrCreate($search, callable $callback = null, $options = [])
 */
class MateriaPrimasTable extends Table
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

        $this->setTable('materia_primas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('TipoMateriaPrimas', [
            'foreignKey' => 'tipo_materia_prima_id'
        ]);
        $this->hasMany('Compras', [
            'foreignKey' => 'item'
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
