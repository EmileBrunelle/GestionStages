<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RefEnvironmentMissionsFixture
 *
 */
class RefEnvironmentMissionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'environment_id' => ['autoIncrement' => null, 'type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null],
        'mission_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'autoIncrement' => null],
        '_indexes' => [
            'ref_environment_missions_environment_id_mission_id_index' => ['type' => 'index', 'columns' => ['environment_id', 'mission_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['environment_id', 'mission_id'], 'length' => []],
            'sqlite_autoindex_ref_environment_missions_1' => ['type' => 'unique', 'columns' => ['environment_id', 'mission_id'], 'length' => []],
            'mission_id_fk' => ['type' => 'foreign', 'columns' => ['mission_id'], 'references' => ['environment_missions', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'mission_id' => 1
            ],
        ];
        parent::init();
    }
}
