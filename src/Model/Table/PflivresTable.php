<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pflivres Model
 *
 * @method \App\Model\Entity\Pflivre get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pflivre newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pflivre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pflivre|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pflivre|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pflivre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pflivre[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pflivre findOrCreate($search, callable $callback = null, $options = [])
 */
class PflivresTable extends Table
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

        $this->setTable('pflivres');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');
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
            ->requirePresence('id', 'create')
            ->allowEmptyString('id', false);

        $validator
            ->scalar('nome')
            ->maxLength('nome', 67)
            ->allowEmptyString('nome');

        return $validator;
    }
}
