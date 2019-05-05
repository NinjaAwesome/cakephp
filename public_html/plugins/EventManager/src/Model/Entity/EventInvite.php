<?php
namespace EventManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventInvite Entity
 *
 * @property int $id
 * @property int $event_id
 * @property int $user_id
 * @property string $sessionId
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modify
 *
 * @property \EventManager\Model\Entity\Event $event
 * @property \EventManager\Model\Entity\User $user
 */
class EventInvite extends Entity
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
        'user_id' => true,
        'sessionId' => true,
        'status_in' => true,
        'created' => true,
        'modify' => true,
        'event' => true,
        'user' => true,
        'event_id_new'=>true
    ];
}
