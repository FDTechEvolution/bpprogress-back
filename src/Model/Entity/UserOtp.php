<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserOtp Entity
 *
 * @property string $id
 * @property string $user_id
 * @property string $otp_ref
 * @property int $otp_code
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $isactive
 *
 * @property \App\Model\Entity\User $user
 */
class UserOtp extends Entity
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
        'otp_ref' => true,
        'otp_code' => true,
        'created' => true,
        'modified' => true,
        'isactive' => true,
        'user' => true,
    ];
}
