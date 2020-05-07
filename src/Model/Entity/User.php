<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property string $id
 * @property string $fullname
 * @property string|null $email
 * @property string $mobile
 * @property string|null $password
 * @property string|null $image_id
 * @property string $isactive
 * @property string $isverify
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $description
 * @property string $type
 * @property string|null $shop_id
 *
 * @property \App\Model\Entity\Image $image
 * @property \App\Model\Entity\Shop $shop
 * @property \App\Model\Entity\Address[] $addresses
 * @property \App\Model\Entity\GoodsTransaction[] $goods_transactions
 * @property \App\Model\Entity\Order[] $orders
 * @property \App\Model\Entity\Payment[] $payments
 * @property \App\Model\Entity\UserAuthen[] $user_authens
 * @property \App\Model\Entity\UserOtp[] $user_otps
 */
class User extends Entity
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
        'fullname' => true,
        'email' => true,
        'mobile' => true,
        'password' => true,
        'image_id' => true,
        'isactive' => true,
        'isverify' => true,
        'created' => true,
        'modified' => true,
        'description' => true,
        'type' => true,
        'shop_id' => true,
        'image' => true,
        'shop' => true,
        'addresses' => true,
        'goods_transactions' => true,
        'orders' => true,
        'payments' => true,
        'user_authens' => true,
        'user_otps' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}
