<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RefEnvironmentMission Entity
 *
 * @property int $environment_id
 * @property int $mission_id
 *
 * @property \App\Model\Entity\InternshipEnvironment $internship_environment
 * @property \App\Model\Entity\EnvironmentMission $environment_mission
 */
class RefEnvironmentMission extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'environment_id' => true,
        'mission_id' => true,
        'internship_environment' => true,
        'environment_mission' => true
    ];
}
