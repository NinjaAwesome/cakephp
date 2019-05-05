<?php
namespace EventManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventBookingOptionValue Entity
 *
 * @property int $id
 * @property int $event_booking_option_id
 * @property string $opt_value
 *
 * @property \EventManager\Model\Entity\EventBookingOption $event_booking_option
 */
class EventBookingOptionValue extends Entity
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
        'event_booking_option_id' => true,
        'opt_value' => true,
        'event_booking_option' => true
    ];
}
