<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property string $id
 * @property string $brand_id
 * @property string $name
 * @property string $isretail
 * @property string $iswholesale
 * @property string $isstock
 * @property string|null $isactive
 * @property string $product_category_id
 * @property float $price
 * @property float $special_price
 * @property string|null $short_description
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $note
 * @property int|null $qty
 *
 * @property \App\Model\Entity\Brand $brand
 * @property \App\Model\Entity\ProductCategory $product_category
 * @property \App\Model\Entity\GoodsLine[] $goods_lines
 * @property \App\Model\Entity\ProductImage[] $product_images
 * @property \App\Model\Entity\WholesaleRate[] $wholesale_rates
 */
class Product extends Entity
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
        'brand_id' => true,
        'name' => true,
        'isretail' => true,
        'iswholesale' => true,
        'isstock' => true,
        'isactive' => true,
        'product_category_id' => true,
        'price' => true,
        'special_price' => true,
        'short_description' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'note' => true,
        'qty' => true,
        'brand' => true,
        'product_category' => true,
        'goods_lines' => true,
        'product_images' => true,
        'wholesale_rates' => true,
    ];
}
