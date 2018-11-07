<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StudentsFixture
 *
 */
class StudentsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'null' => false],
        'id_user' => ['type' => 'integer', 'null' => false],
        'da' => ['type' => 'integer', 'null' => false],
        'last_name' => ['type' => 'string', 'null' => false],
        'first_name' => ['type' => 'string', 'null' => false],
        'phone' => ['type' => 'string'],
        'email' => ['type' => 'string'],
        'additional_info' => ['type' => 'string'],
        'note' => ['type' => 'string'],
        'active' => ['type' => 'tinyinteger'],
        'created' => ['type' => 'datetime'],
        'modified' => ['type' => 'datetime'],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'students_ibfk_1' => ['type' => 'foreign', 'columns' => ['id_user'], 'references' => ['users', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ]
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
                'id' => 1,
                'id_user' => 1,
                'da' => 1,
                'last_name' => 'Lorem ipsum dolor sit amet',
                'first_name' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'additional_info' => 'Lorem ipsum dolor sit amet',
                'note' => 'Lorem ipsum dolor sit amet',
                'active' => 1,
                'created' => '2018-09-19 20:30:06',
                'modified' => '2018-09-19 20:30:06'
            ],
        ];
        parent::init();
    }
}
