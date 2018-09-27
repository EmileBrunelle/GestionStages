<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RefEnvironmentMissions Model
 *
 * @property \App\Model\Table\InternshipEnvironmentsTable|\Cake\ORM\Association\BelongsTo $InternshipEnvironments
 * @property \App\Model\Table\EnvironmentMissionsTable|\Cake\ORM\Association\BelongsTo $EnvironmentMissions
 *
 * @method \App\Model\Entity\RefEnvironmentMission get($primaryKey, $options = [])
 * @method \App\Model\Entity\RefEnvironmentMission newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RefEnvironmentMission[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RefEnvironmentMission|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RefEnvironmentMission|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RefEnvironmentMission patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RefEnvironmentMission[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RefEnvironmentMission findOrCreate($search, callable $callback = null, $options = [])
 */
class RefEnvironmentMissionsTable extends Table
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

        $this->setTable('ref_environment_missions');

        $this->belongsTo('InternshipEnvironments', [
            'foreignKey' => 'environment_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('EnvironmentMissions', [
            'foreignKey' => 'mission_id',
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
        $rules->add($rules->existsIn(['mission_id'], 'EnvironmentMissions'));

        return $rules;
    }
}
