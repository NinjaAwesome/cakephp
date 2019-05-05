<?php
namespace CollabedManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Collabed Entity
 *
 * @property int $id
 * @property int $artist_id_1
 * @property int $artist_id_2
 * @property int $banner_id
 * @property string $image
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \CollabedManager\Model\Entity\Banner $banner
 */
class Collabed extends Entity
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
        '*' => true,
        'id' => false
    ];
}
