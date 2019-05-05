<?php
namespace EventManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventOptionValue Entity
 *
 * @property int $id
 * @property int $event_id
 * @property int $option_id
 * @property int $event_option_id
 * @property int $option_value_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \EventManager\Model\Entity\OptionValue $option_value
 * @property \EventManager\Model\Entity\Event $event
 * @property \EventManager\Model\Entity\Option $option
 * @property \EventManager\Model\Entity\EventOption $event_option
 */
class EventOptionValue extends Entity
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
//        'event_id' => true,
//        'option_id' => true,
//        'event_option_id' => true,
//        'option_value_id' => true,
//        'option_value' => true,
//        'created' => true,
//        'modified' => true,
//        'event' => true,
//        'option' => true,
//        'event_option' => true
//    ];
    
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
