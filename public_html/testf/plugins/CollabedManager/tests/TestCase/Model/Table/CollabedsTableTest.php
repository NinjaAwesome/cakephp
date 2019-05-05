<?php
namespace CollabedManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use CollabedManager\Model\Table\CollabedsTable;

/**
 * CollabedManager\Model\Table\CollabedsTable Test Case
 */
class CollabedsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CollabedManager\Model\Table\CollabedsTable
     */
    public $Collabeds;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.collabed_manager.collabeds',
        'plugin.collabed_manager.banners'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Collabeds') ? [] : ['className' => CollabedsTable::class];
        $this->Collabeds = TableRegistry::getTableLocator()->get('Collabeds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Collabeds);

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
