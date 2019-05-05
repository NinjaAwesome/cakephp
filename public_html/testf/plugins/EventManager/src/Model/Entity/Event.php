<?php
namespace EventManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string $location
 * @property string $organizar_name
 * @property string $organizer_email
 * @property string $banner_image
 * @property float $amount
 * @property int $max_participants
 * @property \Cake\I18n\FrozenTime $start_date
 * @property \Cake\I18n\FrozenTime $end_date
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_description
 * @property bool $is_join
 * @property bool $is_register
 * @property bool $is_paid
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \EventManager\Model\Entity\User $user
 * @property \EventManager\Model\Entity\EventBooking[] $event_bookings
 * @property \EventManager\Model\Entity\EventDocument[] $event_documents
 * @property \EventManager\Model\Entity\EventJoin[] $event_joins
 * @property \EventManager\Model\Entity\EventReview[] $event_reviews
 */
class Event extends Entity
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
//    protected $_accessible = [
//        'user_id' => true,
//        'title' => true,
//        'short_description' => true,
//        'description' => true,
//        'location' => true,
//        'organizar_name' => true,
//        'organizer_email' => true,
//        'banner_image' => true,
//        'amount' => true,
//        'max_participants' => true,
//        'start_date' => true,
//        'end_date' => true,
//        'meta_title' => true,
//        'meta_keyword' => true,
//        'meta_description' => true,
//        'is_join' => true,
//        'is_register' => true,
//        'is_paid' => true,
//        'status' => true,
//        'created' => true,
//        'modified' => true,
//        'user' => true,
//        'event_bookings' => true,
//        'event_images' => true,
//        'event_videos' => true,
//        'event_documents' => true,
//        'event_joins' => true,
//        'event_reviews' => true,
//        'event_options' => true,
//        'event_option_values' => true,
//        'options' => true,
//        'option_values' => true
//    ];
    
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
