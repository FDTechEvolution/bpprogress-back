<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GoodsTransaction Entity
 *
 * @property string $id
 * @property \Cake\I18n\FrozenDate $docdate
 * @property string $docno
 * @property string $user_id
 * @property string $warehouse_id
 * @property string $type
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string $status
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Warehouse $warehouse
 * @property \App\Model\Entity\GoodsLine[] $goods_lines
 */
class GoodsTransaction extends Entity
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
        'docdate' => true,
        'docno' => true,
        'user_id' => true,
        'warehouse_id' => true,
        'type' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'status' => true,
        'user' => true,
        'warehouse' => true,
        'goods_lines' => true,
    ];
}
