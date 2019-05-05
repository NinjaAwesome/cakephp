<?php
namespace EventManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventBooking Entity
 *
 * @property int $id
 * @property int $event_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $mobile
 * @property string $address
 * @property float $amount
 * @property float $discount
 * @property int $coupon_id
 * @property float $total_amount
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \EventManager\Model\Entity\Event $event
 * @property \EventManager\Model\Entity\Coupon $coupon
 * @property \EventManager\Model\Entity\EventBookingOption[] $event_booking_options
 * @property \EventManager\Model\Entity\Transaction[] $transactions
 */
class EventBooking extends Entity
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
        'event_id' => true,
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'mobile' => true,
        'address' => true,
        'amount' => true,
        'discount' => true,
        'coupon_id' => true,
        'total_amount' => true,
        'created' => true,
        'modified' => true,
        'event' => true,
        'coupon' => true,
        'event_booking_options' => true,
        'transactions' => true
    ];
}
