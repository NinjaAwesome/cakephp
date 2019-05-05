<?php
namespace EventManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EventManager\Model\Table\EventBookingOptionsTable;

/**
 * EventManager\Model\Table\EventBookingOptionsTable Test Case
 */
class EventBookingOptionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EventManager\Model\Table\EventBookingOptionsTable
     */
    public $EventBookingOptions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.event_manager.event_booking_options',
        'plugin.event_manager.event_bookings',
        'plugin.event_manager.events',
        'plugin.event_manager.options',
        'plugin.event_manager.option_values',
        'plugin.event_manager.event_booking_option_values'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EventBookingOptions') ? [] : ['className' => EventBookingOptionsTable::class];
        $this->EventBookingOptions = TableRegistry::get('EventBookingOptions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventBookingOptions);

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
