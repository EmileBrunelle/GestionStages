<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RefEnvironmentCustomertypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RefEnvironmentCustomertypesTable Test Case
 */
class RefEnvironmentCustomertypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RefEnvironmentCustomertypesTable
     */
    public $RefEnvironmentCustomertypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ref_environment_customertypes',
        'app.internship_environments',
        'app.customer_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RefEnvironmentCustomertypes') ? [] : ['className' => RefEnvironmentCustomertypesTable::class];
        $this->RefEnvironmentCustomertypes = TableRegistry::getTableLocator()->get('RefEnvironmentCustomertypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RefEnvironmentCustomertypes);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
