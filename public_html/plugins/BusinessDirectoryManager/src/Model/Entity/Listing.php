<?php
namespace BusinessDirectoryManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Listing Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $industry_id
 * @property int $location_id
 * @property string $slug
 * @property string $title
 * @property string $company_name
 * @property string $company_mobile_no
 * @property string $business_name
 * @property string $contact_person_name
 * @property string $contact_person_designation
 * @property string $contact_person_email
 * @property string $contact_person_phone
 * @property string $address_line_1
 * @property string $address_line_2
 * @property int $postcode
 * @property string $latitude
 * @property string $longitude
 * @property string $company_fax_no
 * @property string $company_tollfree_no
 * @property string $company_email
 * @property string $company_website
 * @property string $video
 * @property string $logo
 * @property bool $status
 * @property string $sort_order
 * @property string $short_description
 * @property string $description
 * @property string $banner_image
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \BusinessDirectoryManager\Model\Entity\User $user
 * @property \BusinessDirectoryManager\Model\Entity\Industry $industry
 * @property \BusinessDirectoryManager\Model\Entity\Location $location
 * @property \BusinessDirectoryManager\Model\Entity\ListingCatalog[] $listing_catalogs
 */
class Listing extends Entity
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
        'user_id' => true,
        'industry_id' => true,
        'location_id' => true,
        'slug' => true,
        'title' => true,
        'company_name' => true,
        'company_mobile_no' => true,
        'business_name' => true,
        'contact_person_name' => true,
        'contact_person_designation' => true,
        'contact_person_email' => true,
        'contact_person_phone' => true,
        'address_line_1' => true,
        'address_line_2' => true,
        'postcode' => true,
        'latitude' => true,
        'longitude' => true,
        'company_fax_no' => true,
        'company_tollfree_no' => true,
        'company_email' => true,
        'company_website' => true,
        'video' => true,
        'logo' => true,
        'status' => true,
        'sort_order' => true,
        'short_description' => true,
        'description' => true,
        'banner_image' => true,
        'meta_title' => true,
        'meta_keyword' => true,
        'meta_description' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'industry' => true,
        'location' => true,
        'listing_catalogs' => true
    ];
}
