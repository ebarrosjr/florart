<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fabricacao Model
 *
 * @property \App\Model\Table\ProdutosTable|\Cake\ORM\Association\BelongsTo $Produtos
 * @property \App\Model\Table\MateriaPrimasTable|\Cake\ORM\Association\BelongsTo $MateriaPrimas
 * @property \App\Model\Table\ManufaturasTable|\Cake\ORM\Association\BelongsTo $Manufaturas
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Fabricacao get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fabricacao newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Fabricacao[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fabricacao|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fabricacao|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fabricacao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fabricacao[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fabricacao findOrCreate($search, callable $callback = null, $options = [])
 */
class FabricacaoTable extends Table
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

        $this->setTable('fabricacao');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Produtos', [
            'foreignKey' => 'produto_id'
        ]);
        $this->belongsTo('MateriaPrimas', [
            'foreignKey' => 'materia_prima_id'
        ]);
        $this->belongsTo('Manufaturas', [
            'foreignKey' => 'manufatura_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->numeric('quantidade')
            ->greaterThanOrEqual('quantidade', 0)
            ->allowEmptyString('quantidade');

        $validator
            ->numeric('valor')
            ->greaterThanOrEqual('valor', 0)
            ->allowEmptyString('valor');

        $validator
            ->boolean('unitario')
            ->allowEmptyString('unitario');

        $validator
            ->dateTime('data')
            ->allowEmptyDateTime('data');

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
        $rules->add($rules->existsIn(['produto_id'], 'Produtos'));
        $rules->add($rules->existsIn(['materia_prima_id'], 'MateriaPrimas'));
        $rules->add($rules->existsIn(['manufatura_id'], 'Manufaturas'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
