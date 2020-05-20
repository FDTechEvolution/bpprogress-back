<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsedWarehouse Entity
 *
 * @property string $id
 * @property string $order_line_id
 * @property string $warehouse_id
 * @property int $qty
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $description
 *
 * @property \App\Model\Entity\OrderLine $order_line
 * @property \App\Model\Entity\Warehouse $warehouse
 */
class UsedWarehouse extends Entity
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
        'order_line_id' => true,
        'warehouse_id' => true,
        'qty' => true,
        'created' => true,
        'modified' => true,
        'description' => true,
        'order_line' => true,
        'warehouse' => true,
    ];
}
