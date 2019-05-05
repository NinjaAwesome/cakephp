<?php
namespace EventManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EventManager\Model\Table\EventOptionValuesTable;

/**
 * EventManager\Model\Table\EventOptionValuesTable Test Case
 */
class EventOptionValuesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EventManager\Model\Table\EventOptionValuesTable
     */
    public $EventOptionValues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.event_manager.event_option_values',
        'plugin.event_manager.events',
        'plugin.event_manager.options',
        'plugin.event_manager.event_options',
        'plugin.event_manager.option_values'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EventOptionValues') ? [] : ['className' => EventOptionValuesTable::class];
        $this->EventOptionValues = TableRegistry::get('EventOptionValues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventOptionValues);

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
