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
        'environment_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'autoIncrement' => null],
        'customertype_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'autoIncrement' => null],
        '_indexes' => [
            'ref_environment_customertypes_environment_id_customertype_id_index' => ['type' => 'index', 'columns' => ['environment_id', 'customertype_id'], 'length' => []],
        ],
        '_constraints' => [
            'customertype_id_fk' => ['type' => 'foreign', 'columns' => ['customertype_id'], 'references' => ['customer_types', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'environment_id_fk' => ['type' => 'foreign', 'columns' => ['environment_id'], 'references' => ['internship_environments', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
