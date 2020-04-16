<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Shop Entity
 *
 * @property string $id
 * @property string $name
 * @property string $code
 * @property string $username
 * @property string $user_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $isactive
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Warehouse[] $warehouses
 */
class Shop extends Entity
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
        'code' => true,
        'username' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'isactive' => true,
        'user' => true,
        'warehouses' => true,
    ];
}
