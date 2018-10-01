<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Internship Entity
 *
 * @property int $id
 * @property string $position
 * @property string $description
 * @property int $environment_id
 * @property \Cake\I18n\FrozenTime $CREATED
 * @property \Cake\I18n\FrozenTime $MODIFIED
 *
 * @property \App\Model\Entity\InternshipEnvironment $internship_environment
 */
class Internship extends Entity
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
        'position' => true,
        'description' => true,
        'environment_id' => true,
        'internship_environment' => true
    ];
}
