<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RefEnvironmentCustomertypes Model
 *
 * @property \App\Model\Table\InternshipEnvironmentsTable|\Cake\ORM\Association\BelongsTo $InternshipEnvironments
 * @property \App\Model\Table\CustomerTypesTable|\Cake\ORM\Association\BelongsTo $CustomerTypes
 *
 * @method \App\Model\Entity\RefEnvironmentCustomertype get($primaryKey, $options = [])
 * @method \App\Model\Entity\RefEnvironmentCustomertype newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RefEnvironmentCustomertype[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RefEnvironmentCustomertype|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RefEnvironmentCustomertype|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RefEnvironmentCustomertype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RefEnvironmentCustomertype[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RefEnvironmentCustomertype findOrCreate($search, callable $callback = null, $options = [])
 */
class RefEnvironmentCustomertypesTable extends Table
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

        $this->setTable('ref_environment_customertypes');

        $this->belongsTo('InternshipEnvironments', [
            'foreignKey' => 'environment_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CustomerTypes', [
            'foreignKey' => 'customertype_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['environment_id'], 'InternshipEnvironments'));
        $rules->add($rules->existsIn(['customertype_id'], 'CustomerTypes'));

        return $rules;
    }
}
