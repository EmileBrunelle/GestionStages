<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employers Model
 *
 * @property \App\Model\Table\InternshipEnvironmentsTable|\Cake\ORM\Association\HasMany $InternshipEnvironments
 *
 * @method \App\Model\Entity\Employer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Employer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employer|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmployersTable extends Table
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

        $this->setTable('employers');
        $this->setDisplayField('last_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'id_user',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('InternshipEnvironments', [
            'foreignKey' => 'employer_id'
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
            ->integer('id_user')
            ->allowEmpty('id_user', 'create');

        $validator
            ->scalar('prefix')
            ->maxLength('prefix', 10)
            ->requirePresence('prefix', 'create')
            ->notEmpty('prefix');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 25)
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 25)
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->scalar('title')
            ->maxLength('title', 15)
            ->notEmpty('title');

        $validator
            ->scalar('location')
            ->maxLength('location', 30)
            ->notEmpty('location');

        $validator
            ->scalar('address')
            ->maxLength('address', 15)
            ->notEmpty('address');

        $validator
            ->scalar('city')
            ->maxLength('city', 20)
            ->notEmpty('city');

        $validator
            ->scalar('province')
            ->maxLength('province', 20)
            ->notEmpty('province');

        $validator
            ->scalar('postal_code')
            ->maxLength('postal_code', 6)
            ->minLength('postal_code', 6)
            ->notEmpty('postal_code');

        $validator
            ->email('email')
            ->notEmpty('email');

        $validator
            ->integer('phone')
            ->maxLength('phone', 10)
            ->notEmpty('phone');

        $validator
            ->scalar('extension')
            ->maxLength('extension', 6)
            ->allowEmpty('extension');

        $validator
            ->scalar('cellphone')
            ->maxLength('cellphone', 10)
            ->minLength('cellphone', 10)
            ->notEmpty('cellphone');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 255)
            ->allowEmpty('fax');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['id_user']));

        return $rules;
    }
}
