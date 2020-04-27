<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GoodsLine Entity
 *
 * @property string $id
 * @property string $goods_transaction_id
 * @property string $product_id
 * @property int $qty
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $description
 *
 * @property \App\Model\Entity\GoodsTransaction $goods_transaction
 * @property \App\Model\Entity\Product $product
 */
class GoodsLine extends Entity
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
        'goods_transaction_id' => true,
        'product_id' => true,
        'qty' => true,
        'created' => true,
        'modified' => true,
        'description' => true,
        'goods_transaction' => true,
        'product' => true,
    ];
}
