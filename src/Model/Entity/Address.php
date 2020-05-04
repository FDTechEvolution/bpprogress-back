<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Address Entity
 *
 * @property string $id
 * @property string $address_line
 * @property string $subdistrict
 * @property string $district
 * @property string $province
 * @property string $zipcode
 * @property string $mobile
 * @property string|null $type
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $user_id
 * @property string|null $shop_id
 * @property string|null $isactive
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Shop $shop
 * @property \App\Model\Entity\Order[] $orders
 */
class Address extends Entity
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
        'address_line' => true,
        'subdistrict' => true,
        'district' => true,
        'province' => true,
        'zipcode' => true,
        'mobile' => true,
        'type' => true,
        'created' => true,
        'modified' => true,
        'user_id' => true,
        'shop_id' => true,
        'isactive' => true,
        'user' => true,
        'shop' => true,
        'orders' => true,
    ];
}
