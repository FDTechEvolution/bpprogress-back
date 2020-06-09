<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Addresses Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ShopsTable&\Cake\ORM\Association\BelongsTo $Shops
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\HasMany $Orders
 *
 * @method \App\Model\Entity\Address get($primaryKey, $options = [])
 * @method \App\Model\Entity\Address newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Address[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Address|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Address saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Address patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Address[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Address findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AddressesTable extends Table
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

        $this->setTable('addresses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('Shops', [
            'foreignKey' => 'shop_id',
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'address_id',
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
            ->scalar('address_line')
            ->maxLength('address_line', 255)
            ->requirePresence('address_line', 'create')
            ->notEmptyString('address_line');

        $validator
            ->scalar('subdistrict')
            ->maxLength('subdistrict', 100)
            ->requirePresence('subdistrict', 'create')
            ->notEmptyString('subdistrict');

        $validator
            ->scalar('district')
            ->maxLength('district', 100)
            ->requirePresence('district', 'create')
            ->notEmptyString('district');

        $validator
            ->scalar('province')
            ->maxLength('province', 100)
            ->requirePresence('province', 'create')
            ->notEmptyString('province');

        $validator
            ->scalar('zipcode')
            ->maxLength('zipcode', 5)
            ->requirePresence('zipcode', 'create')
            ->notEmptyString('zipcode');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 45)
            ->requirePresence('mobile', 'create')
            ->notEmptyString('mobile');

        $validator
            ->scalar('type')
            ->maxLength('type', 45)
            ->allowEmptyString('type');

        $validator
            ->scalar('isactive')
            ->allowEmptyString('isactive');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['shop_id'], 'Shops'));

        return $rules;
    }
}
