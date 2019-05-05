<?php
namespace ArtistManager\Test\TestCase\Model\Table;

use ArtistManager\Model\Table\GroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * ArtistManager\Model\Table\GroupsTable Test Case
 */
class GroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ArtistManager\Model\Table\GroupsTable
     */
    public $Groups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.artist_manager.groups',
        'plugin.artist_manager.artists'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Groups') ? [] : ['className' => GroupsTable::class];
        $this->Groups = TableRegistry::getTableLocator()->get('Groups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Groups);

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
}
