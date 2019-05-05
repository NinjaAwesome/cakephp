<?php
namespace BusinessDirectoryManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * ListingCatalog Entity
 *
 * @property int $id
 * @property int $listing_id
 * @property string $images
 * @property string $caption
 * @property int $sort_order
 *
 * @property \BusinessDirectoryManager\Model\Entity\Listing $listing
 */
class ListingCatalog extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'listing_id' => true,
        'images' => true,
        'caption' => true,
        'sort_order' => true,
        'listing' => true
    ];
}
