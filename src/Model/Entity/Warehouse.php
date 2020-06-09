<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Warehouse Entity
 *
 * @property string $id
 * @property string $name
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $isactive
 * @property string|null $description
 * @property string $shop_id
 * @property string|null $status
 *
 * @property \App\Model\Entity\Shop $shop
 * @property \App\Model\Entity\GoodsTransaction[] $goods_transactions
 * @property \App\Model\Entity\UsedWarehouse[] $used_warehouses
 * @property \App\Model\Entity\WarehouseProduct[] $warehouse_products
 */
class Warehouse extends Entity
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
        'name' => true,
        'created' => true,
        'modified' => true,
        'isactive' => true,
        'description' => true,
        'shop_id' => true,
        'status' => true,
        'shop' => true,
        'goods_transactions' => true,
        'used_warehouses' => true,
        'warehouse_products' => true,
    ];
}
