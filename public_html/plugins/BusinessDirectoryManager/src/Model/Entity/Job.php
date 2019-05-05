<?php
namespace BusinessDirectoryManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Job Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $listing_id
 * @property string $job_title
 * @property string $designation
 * @property int $vacancy
 * @property string $experience
 * @property string $qualification
 * @property float $salary_min
 * @property float $salary_max
 * @property \Cake\I18n\FrozenTime $job_end
 * @property string $job_summary
 * @property bool $status
 * @property string $job_time
 * @property string $job_type
 * @property string $job_for
 * @property string $position_type
 * @property int $is_featured
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \BusinessDirectoryManager\Model\Entity\User $user
 * @property \BusinessDirectoryManager\Model\Entity\Listing $listing
 * @property \BusinessDirectoryManager\Model\Entity\JobSeeker[] $job_seekers
 * @property \BusinessDirectoryManager\Model\Entity\Location[] $locations
 */
class Job extends Entity
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
        'user_id' => true,
        'listing_id' => true,
        'job_title' => true,
        'designation' => true,
        'vacancy' => true,
        'experience' => true,
        'qualification' => true,
        'salary_min' => true,
        'salary_max' => true,
        'job_end' => true,
        'job_summary' => true,
        'status' => true,
        'job_time' => true,
        'job_type' => true,
        'job_for' => true,
        'position_type' => true,
        'is_featured' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'listing' => true,
        'job_seekers' => true,
        'locations' => true
    ];
}
