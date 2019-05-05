<?php
namespace EventManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventDocument Entity
 *
 * @property int $id
 * @property int $event_id
 * @property bool $file_type
 * @property string $file_name
 * @property string $caption
 * @property int $sort_order
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \EventManager\Model\Entity\Event $event
 */
class EventDocument extends Entity
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
        'file_type' => true,
        'file_name' => true,
        'caption' => true,
        'sort_order' => true,
        'created' => true,
        'modified' => true,
        'event' => true
    ];
}
