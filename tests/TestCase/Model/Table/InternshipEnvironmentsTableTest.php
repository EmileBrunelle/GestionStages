<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InternshipEnvironmentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InternshipEnvironmentsTable Test Case
 */
class InternshipEnvironmentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InternshipEnvironmentsTable
     */
    public $InternshipEnvironments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.internship_environments',
        'app.employers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('InternshipEnvironments') ? [] : ['className' => InternshipEnvironmentsTable::class];
        $this->InternshipEnvironments = TableRegistry::getTableLocator()->get('InternshipEnvironments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InternshipEnvironments);

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
