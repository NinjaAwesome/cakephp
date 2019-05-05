<?php
namespace LocationManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use LocationManager\Model\Table\LocationsTable;

/**
 * LocationManager\Model\Table\LocationsTable Test Case
 */
class LocationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \LocationManager\Model\Table\LocationsTable
     */
    public $Locations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.location_manager.locations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Locations') ? [] : ['className' => LocationsTable::class];
        $this->Locations = TableRegistry::get('Locations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Locations);

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
