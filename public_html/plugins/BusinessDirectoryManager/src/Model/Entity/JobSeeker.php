<?php
namespace BusinessDirectoryManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * JobSeeker Entity
 *
 * @property int $id
 * @property int $job_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $mobile
 * @property string $message
 * @property string $attachment
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \BusinessDirectoryManager\Model\Entity\Job $job
 */
class JobSeeker extends Entity
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
    // protected $_accessible = [
    //     'job_id' => true,
    //     'first_name' => true,
    //     'last_name' => true,
    //     'email' => true,
    //     'mobile' => true,
    //     'message' => true,
    //     'attachment' => true,
    //     'created' => true,
    //     'modified' => true,
    //     'job' => true
    // ];

    protected $_accessible = [
         '*' => true,
        'id' => false
    ];
}
