<?php
namespace BannerManager\Test\TestCase\Model\Table;

use BannerManager\Model\Table\BannersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * BannerManager\Model\Table\BannersTable Test Case
 */
class BannersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \BannerManager\Model\Table\BannersTable
     */
    public $Banners;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.banner_manager.banners'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Banners') ? [] : ['className' => BannersTable::class];
        $this->Banners = TableRegistry::getTableLocator()->get('Banners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Banners);

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
     * Test validationUpdate method
     *
     * @return void
     */
    public function testValidationUpdate()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findDefault method
     *
     * @return void
     */
    public function testFindDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test deleteImage method
     *
     * @return void
     */
    public function testDeleteImage()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
