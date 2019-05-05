<?php
namespace EventManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventBookingOption Entity
 *
 * @property int $id
 * @property int $event_booking_id
 * @property int $option_id
 * @property string $name
 * @property string $option_type
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \EventManager\Model\Entity\OptionValue $option_value
 * @property \EventManager\Model\Entity\EventBooking $event_booking
 * @property \EventManager\Model\Entity\Event $event
 * @property \EventManager\Model\Entity\Option $option
 * @property \EventManager\Model\Entity\EventBookingOptionValue[] $event_booking_option_values
 */
class EventBookingOption extends Entity
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
        'event_booking_id' => true,
        'evoption_id' => true,
        'name' => true,
        'option_value' => true,
        'option_type' => true,
        'created' => true,
        'modified' => true,
        'event_booking' => true,
        'event' => true,
        'evoption' => true,
        'event_booking_option_values' => true
    ];
}
