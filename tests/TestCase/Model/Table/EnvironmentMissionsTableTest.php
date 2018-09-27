<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnvironmentMissionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnvironmentMissionsTable Test Case
 */
class EnvironmentMissionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EnvironmentMissionsTable
     */
    public $EnvironmentMissions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('EnvironmentMissions') ? [] : ['className' => EnvironmentMissionsTable::class];
        $this->EnvironmentMissions = TableRegistry::getTableLocator()->get('EnvironmentMissions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EnvironmentMissions);

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
