<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property int $id
 * @property int $id_user
 * @property int $da
 * @property string $last_name
 * @property string $first_name
 * @property string $phone
 * @property string $email
 * @property string $additional_info
 * @property string $note
 * @property int $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Student extends Entity
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
        'da' => true,
        'last_name' => true,
        'first_name' => true,
        'phone' => true,
        'email' => true,
        'additional_info' => true,
        'note' => true,
        'active' => true,
        'created' => true,
        'modified' => true
    ];
}
