<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmployersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmployersTable Test Case
 */
class EmployersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmployersTable
     */
    public $Employers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.employers',
        'app.internship_environments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Employers') ? [] : ['className' => EmployersTable::class];
        $this->Employers = TableRegistry::getTableLocator()->get('Employers', $config);
    }

    public function testFindById() {
        $query = $this->Employers->findById('1');
        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
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
                'created' => '2018-09-19 20:29:49',
                'modified' => '2018-09-19 20:29:49'
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Employers);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
