<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PreorderRate Entity
 *
 * @property string $id
 * @property int $seq
 * @property int $startqty
 * @property int|null $endqty
 * @property float $price
 * @property string $product_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $description
 *
 * @property \App\Model\Entity\Product $product
 */
class PreorderRate extends Entity
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
        'seq' => true,
        'startqty' => true,
        'endqty' => true,
        'price' => true,
        'product_id' => true,
        'created' => true,
        'modified' => true,
        'description' => true,
        'product' => true,
    ];
}
