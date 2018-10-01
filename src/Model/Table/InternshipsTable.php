<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Internships Model
 *
 * @property \App\Model\Table\InternshipEnvironmentsTable|\Cake\ORM\Association\BelongsTo $InternshipEnvironments
 *
 * @method \App\Model\Entity\Internship get($primaryKey, $options = [])
 * @method \App\Model\Entity\Internship newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Internship[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Internship|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Internship|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Internship patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Internship[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Internship findOrCreate($search, callable $callback = null, $options = [])
 */
class InternshipsTable extends Table
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

        $this->setTable('internships');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('InternshipEnvironments', [
            'foreignKey' => 'environment_id'
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
            ->scalar('position')
            ->requirePresence('position', 'create')
            ->notEmpty('position');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');


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
        $rules->add($rules->existsIn(['environment_id'], 'InternshipEnvironments'));

        return $rules;
    }
}
