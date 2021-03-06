<?php
namespace BannerManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Banner Entity
 *
 * @property int $id
 * @property string $title
 * @property bool $status
 * @property string $image
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Banner extends Entity
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
        'title' => true,
        'status' => true,
        'image' => true,
        'image_file' => true,
        'created' => true,
        'modified' => true
    ];
    
   
}
