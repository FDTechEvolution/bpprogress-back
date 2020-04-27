<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GoodsTransactions Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\WarehousesTable&\Cake\ORM\Association\BelongsTo $Warehouses
 * @property \App\Model\Table\GoodsLinesTable&\Cake\ORM\Association\HasMany $GoodsLines
 *
 * @method \App\Model\Entity\GoodsTransaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\GoodsTransaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GoodsTransaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GoodsTransaction|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GoodsTransaction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GoodsTransaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GoodsTransaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GoodsTransaction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GoodsTransactionsTable extends Table
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

        $this->setTable('goods_transactions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Warehouses', [
            'foreignKey' => 'warehouse_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('GoodsLines', [
            'foreignKey' => 'goods_transaction_id',
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
            ->requirePresence('docno', 'create')
            ->notEmptyString('docno');

        $validator
            ->scalar('type')
            ->maxLength('type', 45)
            ->notEmptyString('type');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['warehouse_id'], 'Warehouses'));

        return $rules;
    }
}
