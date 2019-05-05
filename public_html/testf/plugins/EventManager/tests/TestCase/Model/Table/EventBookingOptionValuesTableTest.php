<?php
namespace EventManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EventManager\Model\Table\EventBookingOptionValuesTable;

/**
 * EventManager\Model\Table\EventBookingOptionValuesTable Test Case
 */
class EventBookingOptionValuesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EventManager\Model\Table\EventBookingOptionValuesTable
     */
    public $EventBookingOptionValues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.event_manager.event_booking_option_values',
        'plugin.event_manager.event_booking_options'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EventBookingOptionValues') ? [] : ['className' => EventBookingOptionValuesTable::class];
        $this->EventBookingOptionValues = TableRegistry::get('EventBookingOptionValues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventBookingOptionValues);

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
