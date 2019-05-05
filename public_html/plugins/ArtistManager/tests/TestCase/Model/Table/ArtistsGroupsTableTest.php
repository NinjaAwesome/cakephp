<?php
namespace ArtistManager\Test\TestCase\Model\Table;

use ArtistManager\Model\Table\ArtistsGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * ArtistManager\Model\Table\ArtistsGroupsTable Test Case
 */
class ArtistsGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ArtistManager\Model\Table\ArtistsGroupsTable
     */
    public $ArtistsGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.artist_manager.artists_groups',
        'plugin.artist_manager.artists',
        'plugin.artist_manager.groups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ArtistsGroups') ? [] : ['className' => ArtistsGroupsTable::class];
        $this->ArtistsGroups = TableRegistry::getTableLocator()->get('ArtistsGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ArtistsGroups);

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
