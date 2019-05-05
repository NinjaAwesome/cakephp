<?php
namespace CollabedManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use CollabedManager\Model\Table\CollabLikesTable;

/**
 * CollabedManager\Model\Table\CollabLikesTable Test Case
 */
class CollabLikesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CollabedManager\Model\Table\CollabLikesTable
     */
    public $CollabLikes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.collabed_manager.collab_likes',
        'plugin.collabed_manager.collabs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CollabLikes') ? [] : ['className' => CollabLikesTable::class];
        $this->CollabLikes = TableRegistry::getTableLocator()->get('CollabLikes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CollabLikes);

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
