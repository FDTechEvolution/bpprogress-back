<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property string $id
 * @property string $user_id
 * @property string $order_id
 * @property float|null $amount
 * @property string|null $image_id
 * @property string|null $transfertime
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $description
 * @property string|null $status
 * @property float|null $expectamt
 * @property \Cake\I18n\FrozenDate|null $docdate
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Image $image
 */
class Payment extends Entity
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
        'order_id' => true,
        'amount' => true,
        'image_id' => true,
        'transfertime' => true,
        'created' => true,
        'modified' => true,
        'description' => true,
        'status' => true,
        'expectamt' => true,
        'docdate' => true,
        'user' => true,
        'order' => true,
        'image' => true,
    ];
}
