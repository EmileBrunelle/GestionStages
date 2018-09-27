<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomerTypes Model
 *
 * @method \App\Model\Entity\CustomerType get($primaryKey, $options = [])
 * @method \App\Model\Entity\CustomerType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CustomerType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CustomerType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomerType|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomerType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CustomerType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CustomerType findOrCreate($search, callable $callback = null, $options = [])
 */
class CustomerTypesTable extends Table
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

        $this->setTable('customer_types');
        $this->setDisplayField('types');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Internship_environments', [
            'foreignKey' => 'customertype_id',
            'targetForeignKey' => 'environment_id',
            'joinTable' => 'ref_environment_customertypes'
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
            ->integer('id')
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('types')
            ->allowEmpty('types');

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
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }
}
