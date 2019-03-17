<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Situacaos Model
 *
 * @property \App\Model\Table\ItensNotasTable|\Cake\ORM\Association\HasMany $ItensNotas
 *
 * @method \App\Model\Entity\Situacao get($primaryKey, $options = [])
 * @method \App\Model\Entity\Situacao newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Situacao[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Situacao|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Situacao|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Situacao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Situacao[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Situacao findOrCreate($search, callable $callback = null, $options = [])
 */
class SituacaosTable extends Table
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

        $this->setTable('situacaos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('ItensNotas', [
            'foreignKey' => 'situacao_id'
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

        return $validator;
    }
}
