<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InternshipEnvironment Entity
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $province
 * @property string $postal_code
 * @property string $region
 * @property int $active
 * @property int $employer_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Employer $employer
 * @property \App\Model\Entity\CustomerType[] $Customer_types
 * @property \App\Model\Entity\EnvironmentMission[] $Environment_missions
 */
class InternshipEnvironment extends Entity
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
        'name' => true,
        'address' => true,
        'city' => true,
        'province' => true,
        'postal_code' => true,
        'region' => true,
        'active' => true,
        'employer_id' => true,
        'created' => true,
        'modified' => true,
        'employer' => true,
        'type_id' => true,
        'customer_types' => true,
        'environment_missions' => true,
        'Comments' => true,
        'must_update' => true
    ];
}
