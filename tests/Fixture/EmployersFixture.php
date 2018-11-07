<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmployersFixture
 *
 */
class EmployersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'unsigned' => false, 'null' => false],
        'id_user' => ['type' => 'integer', 'unsigned' => false, 'null' => false],
        'prefix' => ['type' => 'string', 'null' => false, 'default' => null],
        'last_name' => ['type' => 'string', 'null' => false, 'default' => null],
        'first_name' => ['type' => 'string', 'null' => false, 'default' => null],
        'title' => ['type' => 'string', 'null' => true, 'default' => null],
        'location' => ['type' => 'string', 'null' => true, 'default' => null],
        'address' => ['type' => 'string', 'null' => true, 'default' => null],
        'city' => ['type' => 'string', 'null' => true, 'default' => null],
        'province' => ['type' => 'string', 'null' => true, 'default' => null],
        'postal_code' => ['type' => 'string', 'null' => true, 'default' => null],
        'email' => ['type' => 'string', 'null' => true, 'default' => null],
        'phone' => ['type' => 'string', 'null' => true, 'default' => null],
        'extension' => ['type' => 'string', 'null' => true, 'default' => null],
        'cellphone' => ['type' => 'string', 'null' => true, 'default' => null],
        'fax' => ['type' => 'string', 'null' => true, 'default' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'employers_ibfk_1' => ['type' => 'foreign', 'columns' => ['id_user'], 'references' => ['users', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'prefix' => 'Mr',
                'last_name' => 'Bouchard',
                'first_name' => 'Louis',
                'title' => 'Boss',
                'location' => 'Head office',
                'address' => '402 des Rochers',
                'city' => 'Laval',
                'province' => 'Quebec',
                'postal_code' => 'J5E4L1',
                'email' => 'email@email.com',
                'phone' => '4505959595',
                'extension' => '4224',
                'cellphone' => '5148765432',
                'fax' => '4505959595',
                'created' => null,
                'modified' => null
            ],

            [
                'id' => 2,
                'id_user' => 2,
                'prefix' => 'Mr',
                'last_name' => 'Burat',
                'first_name' => 'Werner',
                'title' => 'Head HR',
                'location' => 'Head office',
                'address' => '104 des Rapides',
                'city' => 'Laval',
                'province' => 'Quebec',
                'postal_code' => 'G5B4E5',
                'email' => 'werner@email.com',
                'phone' => '4505896932',
                'extension' => '4855',
                'cellphone' => '4387569856',
                'fax' => '4502516799',
                'created' => null,
                'modified' => null
            ],
        ];
        parent::init();
    }
}
