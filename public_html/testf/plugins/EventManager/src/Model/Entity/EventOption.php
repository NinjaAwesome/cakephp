<?php
namespace EventManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventOption Entity
 *
 * @property int $id
 * @property int $event_id
 * @property int $option_id
 * @property string $value
 * @property bool $required
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \EventManager\Model\Entity\Event $event
 * @property \EventManager\Model\Entity\Option $option
 * @property \EventManager\Model\Entity\EventOptionValue[] $event_option_values
 */
class EventOption extends Entity
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
//        'value' => true,
//        'required' => true,
//        'created' => true,
//        'modified' => true,
//        'event' => true,
//        'option' => true,
//        'event_option_values' => true
//    ];
    
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
