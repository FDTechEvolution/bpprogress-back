<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsedWarehouses Model
 *
 * @property \App\Model\Table\OrderLinesTable&\Cake\ORM\Association\BelongsTo $OrderLines
 * @property \App\Model\Table\WarehousesTable&\Cake\ORM\Association\BelongsTo $Warehouses
 *
 * @method \App\Model\Entity\UsedWarehouse get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsedWarehouse newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UsedWarehouse[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsedWarehouse|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsedWarehouse saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsedWarehouse patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsedWarehouse[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsedWarehouse findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsedWarehousesTable extends Table
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

        $this->setTable('used_warehouses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('OrderLines', [
            'foreignKey' => 'order_line_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Warehouses', [
            'foreignKey' => 'warehouse_id',
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
        $rules->add($rules->existsIn(['order_line_id'], 'OrderLines'));
        $rules->add($rules->existsIn(['warehouse_id'], 'Warehouses'));

        return $rules;
    }
}
