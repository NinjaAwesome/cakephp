<?php
namespace LocationManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Location Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property string $latitude
 * @property string $longitude
 * @property string $iso_alpha2_code
 * @property string $iso_alpha3_code
 * @property int $iso_numeric_code
 * @property string $formatted_address
 * @property int $lft
 * @property int $rght
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_description
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \LocationManager\Model\Entity\ParentLocation $parent_location
 * @property \LocationManager\Model\Entity\ChildLocation[] $child_locations
 */
class Location extends Entity
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
        'parent_id' => true,
        'title' => true,
        'latitude' => true,
        'longitude' => true,
        'iso_alpha2_code' => true,
        'iso_alpha3_code' => true,
        'iso_numeric_code' => true,
        'formatted_address' => true,
        'lft' => true,
        'rght' => true,
        'meta_title' => true,
        'meta_keyword' => true,
        'meta_description' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'parent_location' => true,
        'child_locations' => true
    ];
}
