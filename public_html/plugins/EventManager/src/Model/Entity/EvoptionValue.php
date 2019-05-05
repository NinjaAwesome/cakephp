<?php

namespace EventManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * EvoptionValue Entity
 *
 * @property int $id
 * @property string $option_id
 * @property string $title
 * @property string $image
 * @property int $sort_order
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \EventManager\Model\Entity\Option $option
 */
class EvoptionValue extends Entity {

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
        'evoption_id' => true,
        'title' => true,
        'image' => true,
        'sort_order' => true,
        'created' => true,
        'modified' => true,
        'evoption' => true
    ];

}
