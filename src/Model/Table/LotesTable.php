<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lotes Model
 *
 * @property \App\Model\Table\FabricacaosTable|\Cake\ORM\Association\BelongsTo $Fabricacaos
 * @property \App\Model\Table\UnidadeMedidasTable|\Cake\ORM\Association\BelongsTo $UnidadeMedidas
 *
 * @method \App\Model\Entity\Lote get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lote newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Lote[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lote|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lote|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lote[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lote findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LotesTable extends Table
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

        $this->setTable('lotes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Fabricacao', [
            'foreignKey' => 'fabricacao_id'
        ]);
        $this->belongsTo('UnidadeMedidas', [
            'foreignKey' => 'unidade_medida_id'
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
            ->scalar('numero')
            ->maxLength('numero', 45)
            ->allowEmptyString('numero');

        $validator
            ->date('validade')
            ->allowEmptyDate('validade');

        $validator
            ->numeric('quantidade')
            ->greaterThanOrEqual('quantidade', 0)
            ->allowEmptyString('quantidade');

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
        $rules->add($rules->existsIn(['fabricacao_id'], 'Fabricacao'));
        $rules->add($rules->existsIn(['unidade_medida_id'], 'UnidadeMedidas'));

        return $rules;
    }
}
