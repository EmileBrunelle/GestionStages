<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InternshipEnvironments Model
 *
 * @property \App\Model\Table\EmployersTable|\Cake\ORM\Association\BelongsTo $Employers
 * @property \App\Model\Table\EmployersTable|\Cake\ORM\Association\BelongsTo $Establishment_types
 * @property \App\Model\Table\EmployersTable|\Cake\ORM\Association\BelongsToMany $Customer_types
 *
 * @method \App\Model\Entity\InternshipEnvironment get($primaryKey, $options = [])
 * @method \App\Model\Entity\InternshipEnvironment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InternshipEnvironment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InternshipEnvironment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InternshipEnvironment|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InternshipEnvironment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InternshipEnvironment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InternshipEnvironment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InternshipEnvironmentsTable extends Table
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

        $this->setTable('internship_environments');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Employers', [
            'foreignKey' => 'employer_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Establishment_types', [
            'foreignKey' => 'type_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsToMany('Customer_Types', [
            'foreignKey' => 'environment_id',
            'targetForeignKey' => 'customertype_id',
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
            ->allowEmpty('id', 'create');

        $validator
            ->integer('employer_id')
            ->allowEmpty('employer_id', 'create');

        $validator
            ->integer('type_id')
            ->requirePresence('type_id', 'create')
            ->notEmpty('type_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 40)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->allowEmpty('address');

        $validator
            ->scalar('city')
            ->maxLength('city', 255)
            ->allowEmpty('city');

        $validator
            ->scalar('province')
            ->maxLength('province', 255)
            ->allowEmpty('province');

        $validator
            ->scalar('postal_code')
            ->maxLength('postal_code', 255)
            ->allowEmpty('postal_code');

        $validator
            ->scalar('region')
            ->maxLength('region', 255)
            ->allowEmpty('region');

        $validator
            ->allowEmpty('active');

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
        $rules->add($rules->existsIn(['employer_id'], 'Employers'));
        $rules->add($rules->existsIn(['type_id'], 'Establishment_types'));

        return $rules;
    }
}
