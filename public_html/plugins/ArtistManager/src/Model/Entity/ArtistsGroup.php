<?php
namespace ArtistManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * ArtistsGroup Entity
 *
 * @property int $id
 * @property int $artist_id
 * @property int $group_id
 *
 * @property \ArtistManager\Model\Entity\Artist $artist
 * @property \ArtistManager\Model\Entity\Group $group
 */
class ArtistsGroup extends Entity
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
        'artist_id' => true,
        'group_id' => true,
        'artist' => true,
        'group' => true
    ];
}
