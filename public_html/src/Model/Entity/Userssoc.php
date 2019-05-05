<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $display_name
 * @property int $age
 * @property \Cake\I18n\FrozenDate $dob
 * @property string $town
 * @property int $state_id
 * @property int $country_id
 * @property string $zipcode
 * @property string $mobile
 * @property string $email
 * @property string $password
 * @property string $banner
 * @property string $profile_photo
 * @property int $status
 * @property bool $is_verified
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $fake_pass
 *
 * @property \UserManager\Model\Entity\State $state
 * @property \UserManager\Model\Entity\Country $country
 * @property \UserManager\Model\Entity\UserToken[] $user_tokens
 * @property \UserManager\Model\Entity\Venue[] $venues
 * @property \UserManager\Model\Entity\AccountType[] $account_types
 */
class Userssoc extends Entity
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
