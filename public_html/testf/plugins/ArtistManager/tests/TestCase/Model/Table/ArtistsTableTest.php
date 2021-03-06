<?php
namespace ArtistManager\Test\TestCase\Model\Table;

use ArtistManager\Model\Table\ArtistsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * ArtistManager\Model\Table\ArtistsTable Test Case
 */
class ArtistsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ArtistManager\Model\Table\ArtistsTable
     */
    public $Artists;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('Artists') ? [] : ['className' => ArtistsTable::class];
        $this->Artists = TableRegistry::getTableLocator()->get('Artists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Artists);

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
