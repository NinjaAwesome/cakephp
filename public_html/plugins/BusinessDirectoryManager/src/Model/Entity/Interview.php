<?php
namespace BusinessDirectoryManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Interview Entity
 *
 * @property int $id
 * @property int $job_seeker_id
 * @property string $interviewer_name
 * @property \Cake\I18n\FrozenTime $interview_date
 * @property string $interview_time_from
 * @property string $interview_time_to
 * @property bool $status
 * @property int $reshedule_count
 * @property string $comments
 *
 * @property \BusinessDirectoryManager\Model\Entity\JobSeeker $job_seeker
 */
class Interview extends Entity
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
        'job_seeker_id' => true,
        'interviewer_name' => true,
        'interview_date' => true,
        'interview_time_from' => true,
        'interview_time_to' => true,
        'status' => true,
        'reshedule_count' => true,
        'comments' => true,
        'job_seeker' => true
    ];
}
