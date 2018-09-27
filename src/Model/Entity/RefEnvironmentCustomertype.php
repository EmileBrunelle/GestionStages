<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RefEnvironmentCustomertype Entity
 *
 * @property int $environment_id
 * @property int $customertype_id
 *
 * @property \App\Model\Entity\InternshipEnvironment $internship_environment
 * @property \App\Model\Entity\CustomerType $customer_type
 */
class RefEnvironmentCustomertype extends Entity
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
        'customertype_id' => true,
        'internship_environment' => true,
        'customer_type' => true
    ];
}
