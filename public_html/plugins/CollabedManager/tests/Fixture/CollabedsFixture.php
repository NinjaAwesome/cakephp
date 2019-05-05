<?php
namespace CollabedManager\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CollabedsFixture
 *
 */
class CollabedsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'artist_id_1' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'artist_id_2' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'banner_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'image' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'artist_id_1' => ['type' => 'index', 'columns' => ['artist_id_1'], 'length' => []],
            'artist_id_2' => ['type' => 'index', 'columns' => ['artist_id_2'], 'length' => []],
            'banner_id' => ['type' => 'index', 'columns' => ['banner_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'collabeds_ibfk_1' => ['type' => 'foreign', 'columns' => ['artist_id_1'], 'references' => ['artists', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'collabeds_ibfk_2' => ['type' => 'foreign', 'columns' => ['artist_id_2'], 'references' => ['artists', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'collabeds_ibfk_3' => ['type' => 'foreign', 'columns' => ['banner_id'], 'references' => ['banners', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'artist_id_1' => 1,
                'artist_id_2' => 1,
                'banner_id' => 1,
                'image' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2018-11-21 10:07:06',
                'modified' => '2018-11-21 10:07:06'
            ],
        ];
        parent::init();
    }
}
