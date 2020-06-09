<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Warehouses Model
 *
 * @property \App\Model\Table\ShopsTable&\Cake\ORM\Association\BelongsTo $Shops
 * @property \App\Model\Table\GoodsTransactionsTable&\Cake\ORM\Association\HasMany $GoodsTransactions
 * @property \App\Model\Table\UsedWarehousesTable&\Cake\ORM\Association\HasMany $UsedWarehouses
 * @property \App\Model\Table\WarehouseProductsTable&\Cake\ORM\Association\HasMany $WarehouseProducts
 *
 * @method \App\Model\Entity\Warehouse get($primaryKey, $options = [])
 * @method \App\Model\Entity\Warehouse newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Warehouse[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Warehouse|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Warehouse saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Warehouse patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Warehouse[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Warehouse findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WarehousesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('warehouses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Shops', [
            'foreignKey' => 'shop_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('GoodsTransactions', [
            'foreignKey' => 'warehouse_id',
        ]);
        $this->hasMany('UsedWarehouses', [
            'foreignKey' => 'warehouse_id',
        ]);
        $this->hasMany('WarehouseProducts', [
            'foreignKey' => 'warehouse_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('isactive')
            ->allowEmptyString('isactive');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

        $validator
            ->scalar('status')
            ->maxLength('status', 45)
            ->allowEmptyString('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['shop_id'], 'Shops'));

        return $rules;
    }
}
