<?php
namespace EventManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EventManager\Model\Table\EventDocumentsTable;

/**
 * EventManager\Model\Table\EventDocumentsTable Test Case
 */
class EventDocumentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EventManager\Model\Table\EventDocumentsTable
     */
    public $EventDocuments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.event_manager.event_documents',
        'plugin.event_manager.events'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EventDocuments') ? [] : ['className' => EventDocumentsTable::class];
        $this->EventDocuments = TableRegistry::get('EventDocuments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventDocuments);

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
