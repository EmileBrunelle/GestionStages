<?php
/**
 * Created by PhpStorm.
 * User: ebrun
 * Date: 2018-11-07
 * Time: 12:21
 */

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class RefEnvironmentCustomertypesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'environment_id' => ['type' => 'integer', 'null' => false],
        'customertype_id' => ['type' => 'integer', 'null' => false],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['environment_id', 'customertype_id']],
            'environment_internship' => ['type' => 'foreign', 'columns' => ['environment_id'], 'references' => ['internship_environments', 'id'], 'update' => 'restrict', 'delete' => 'restrict'],
            'environment_customer' => ['type' => 'foreign', 'columns' => ['customertype_id'], 'references' => ['customer_types', 'id'], 'update' => 'cascade', 'delete' => 'cascade']
        ]
    ];

}