<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employer Entity
 *
 * @property int $id
 * @property int $id_user
 * @property string $prefix
 * @property string $last_name
 * @property string $first_name
 * @property string $title
 * @property string $location
 * @property string $address
 * @property string $city
 * @property string $province
 * @property string $postal_code
 * @property string $email
 * @property string $phone
 * @property string $extension
 * @property string $cellphone
 * @property string $fax
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\InternshipEnvironment[] $internship_environments
 */
class Employer extends Entity
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
        'id_user' => true,
        'prefix' => true,
        'last_name' => true,
        'first_name' => true,
        'title' => true,
        'location' => true,
        'address' => true,
        'city' => true,
        'province' => true,
        'postal_code' => true,
        'email' => true,
        'phone' => true,
        'extension' => true,
        'cellphone' => true,
        'fax' => true,
        'created' => true,
        'modified' => true,
        'internship_environments' => true
    ];
}
