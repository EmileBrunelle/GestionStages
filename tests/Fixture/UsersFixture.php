<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart

    public $fields = [
        'id' => ['type' => 'integer'],
        'username' => ['type' => 'string', 'null' => true],
        'password' => ['type' => 'string', 'null' => true],
        'role' => ['type' => 'string', 'null' => false],
        'created' => ['type' => 'timestamp', 'null' => true],
        'updated' => ['type' => 'timestamp', 'null' => true],
        '_constraints' => ['primary' => ['type' => 'primary', 'columns' => ['id']]]
    ];
/*    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'username' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'role' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
    ];*/
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
                'id' => 1,
                'username' => 'louisbouchard',
                'password' => 'louis123$',
                'role' => 'employer',
                'created' => '2018-09-19 18:43:23',
                'modified' => '2018-09-19 18:43:23'
            ],

            [
                'id' => 2,
                'username' => 'wernerburat',
                'password' => 'werner123$',
                'role' => 'employer',
                'created' => '2018-11-06 21:22:01',
                'modified' => '2018-11-06 21:22:15'
            ],

            [
                'id' => 3,
                'username' => 'juliencardinal',
                'password' => 'julien123$',
                'role' => 'student',
                'created' => '2018-11-06 21:24:32',
                'modified' => '2018-11-06 21:24:33'
            ],

            [
                'id' => 4,
                'username' => 'emilebrunelle',
                'password' => 'emile123$',
                'role' => 'student',
                'created' => '2018-11-06 21:27:21',
                'modified' => '2018-11-06 21:28:32'
            ],
        ];
        parent::init();
    }
}
