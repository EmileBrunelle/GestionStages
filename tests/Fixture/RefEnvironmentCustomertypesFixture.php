<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RefEnvironmentCustomertypesFixture
 *
 */
class RefEnvironmentCustomertypesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'environment_id' => ['autoIncrement' => null, 'type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null],
        'customertype_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['environment_id', 'customertype_id'], 'length' => []],
            'sqlite_autoindex_ref_environment_customertypes_1' => ['type' => 'unique', 'columns' => ['environment_id', 'customertype_id'], 'length' => []],
            'customertype_id_fk' => ['type' => 'foreign', 'columns' => ['customertype_id'], 'references' => ['customer_types', null], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'environment_id_fk' => ['type' => 'foreign', 'columns' => ['environment_id'], 'references' => ['internship_environments', null], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'environment_id' => 1,
                'customertype_id' => 1
            ],
        ];
        parent::init();
    }
}
