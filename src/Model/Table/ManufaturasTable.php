<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Manufaturas Model
 *
 * @property \App\Model\Table\FabricacaoTable|\Cake\ORM\Association\HasMany $Fabricacao
 *
 * @method \App\Model\Entity\Manufatura get($primaryKey, $options = [])
 * @method \App\Model\Entity\Manufatura newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Manufatura[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Manufatura|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Manufatura|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Manufatura patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Manufatura[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Manufatura findOrCreate($search, callable $callback = null, $options = [])
 */
class ManufaturasTable extends Table
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

        $this->setTable('manufaturas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Fabricacao', [
            'foreignKey' => 'manufatura_id'
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
            ->maxLength('nome', 150)
            ->allowEmptyString('nome');

        $validator
            ->numeric('valor_base')
            ->greaterThanOrEqual('valor_base', 0)
            ->allowEmptyString('valor_base');

        $validator
            ->boolean('unidade')
            ->allowEmptyString('unidade');

        return $validator;
    }
}
