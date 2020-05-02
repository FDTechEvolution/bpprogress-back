<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property string $id
 * @property string $shop_id
 * @property string $user_id
 * @property \Cake\I18n\FrozenDate $docdate
 * @property string|null $status
 * @property float|null $totalamt
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $address_id
 * @property string|null $payment_method
 *
 * @property \App\Model\Entity\Shop $shop
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\OrderLine[] $order_lines
 */
class Order extends Entity
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
        'shop_id' => true,
        'user_id' => true,
        'docdate' => true,
        'status' => true,
        'totalamt' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'address_id' => true,
        'payment_method' => true,
        'shop' => true,
        'user' => true,
        'order_lines' => true,
    ];
}
