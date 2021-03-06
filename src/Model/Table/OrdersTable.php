<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property \App\Model\Table\ShopsTable&\Cake\ORM\Association\BelongsTo $Shops
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\AddressesTable&\Cake\ORM\Association\BelongsTo $Addresses
 * @property \App\Model\Table\ShippingsTable&\Cake\ORM\Association\BelongsTo $Shippings
 * @property \App\Model\Table\OrderLinesTable&\Cake\ORM\Association\HasMany $OrderLines
 * @property \App\Model\Table\PaymentsTable&\Cake\ORM\Association\HasMany $Payments
 *
 * @method \App\Model\Entity\Order get($primaryKey, $options = [])
 * @method \App\Model\Entity\Order newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Order[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Shops', [
            'foreignKey' => 'shop_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Addresses', [
            'foreignKey' => 'address_id',
        ]);
        $this->belongsTo('Shippings', [
            'foreignKey' => 'shipping_id',
        ]);
        $this->hasMany('OrderLines', [
            'foreignKey' => 'order_id',
        ]);
        $this->hasMany('Payments', [
            'foreignKey' => 'order_id',
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
            ->date('docdate')
            ->requirePresence('docdate', 'create')
            ->notEmptyDate('docdate');

        $validator
            ->scalar('docno')
            ->maxLength('docno', 45)
            ->allowEmptyString('docno');

        $validator
            ->scalar('status')
            ->maxLength('status', 45)
            ->allowEmptyString('status');

        $validator
            ->decimal('totalamt')
            ->allowEmptyString('totalamt');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

        $validator
            ->scalar('payment_method')
            ->maxLength('payment_method', 45)
            ->allowEmptyString('payment_method');

        $validator
            ->scalar('payment_status')
            ->maxLength('payment_status', 45)
            ->allowEmptyString('payment_status');

        $validator
            ->scalar('trackingno')
            ->maxLength('trackingno', 50)
            ->allowEmptyString('trackingno');

        $validator
            ->scalar('ispreorder')
            ->allowEmptyString('ispreorder');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['address_id'], 'Addresses'));
        $rules->add($rules->existsIn(['shipping_id'], 'Shippings'));

        return $rules;
    }
}
