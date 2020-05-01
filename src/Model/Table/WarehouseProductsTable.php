<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WarehouseProducts Model
 *
 * @property \App\Model\Table\WarehousesTable&\Cake\ORM\Association\BelongsTo $Warehouses
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\WarehouseProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\WarehouseProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WarehouseProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WarehouseProduct|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WarehouseProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WarehouseProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WarehouseProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WarehouseProduct findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WarehouseProductsTable extends Table
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

        $this->setTable('warehouse_products');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Warehouses', [
            'foreignKey' => 'warehouse_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
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
            ->integer('qty')
            ->notEmptyString('qty');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

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
        $rules->add($rules->existsIn(['warehouse_id'], 'Warehouses'));
        $rules->add($rules->existsIn(['product_id'], 'Products'));

        return $rules;
    }
}
