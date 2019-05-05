<?php
namespace EventManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EventManager\Model\Table\EventOptionsTable;

/**
 * EventManager\Model\Table\EventOptionsTable Test Case
 */
class EventOptionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EventManager\Model\Table\EventOptionsTable
     */
    public $EventOptions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.event_manager.event_options',
        'plugin.event_manager.events',
        'plugin.event_manager.options',
        'plugin.event_manager.event_option_values'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EventOptions') ? [] : ['className' => EventOptionsTable::class];
        $this->EventOptions = TableRegistry::get('EventOptions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventOptions);

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
