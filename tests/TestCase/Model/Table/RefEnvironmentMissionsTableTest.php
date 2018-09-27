<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RefEnvironmentMissionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RefEnvironmentMissionsTable Test Case
 */
class RefEnvironmentMissionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RefEnvironmentMissionsTable
     */
    public $RefEnvironmentMissions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ref_environment_missions',
        'app.internship_environments',
        'app.environment_missions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RefEnvironmentMissions') ? [] : ['className' => RefEnvironmentMissionsTable::class];
        $this->RefEnvironmentMissions = TableRegistry::getTableLocator()->get('RefEnvironmentMissions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RefEnvironmentMissions);

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
