<?php
namespace EventManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventBookings Model
 *
 * @property \EventManager\Model\Table\EventsTable|\Cake\ORM\Association\BelongsTo $Events
 * @property \EventManager\Model\Table\CouponsTable|\Cake\ORM\Association\BelongsTo $Coupons
 * @property \EventManager\Model\Table\EventBookingOptionsTable|\Cake\ORM\Association\HasMany $EventBookingOptions
 * @property \EventManager\Model\Table\TransactionsTable|\Cake\ORM\Association\BelongsToMany $Transactions
 *
 * @method \EventManager\Model\Entity\EventBooking get($primaryKey, $options = [])
 * @method \EventManager\Model\Entity\EventBooking newEntity($data = null, array $options = [])
 * @method \EventManager\Model\Entity\EventBooking[] newEntities(array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventBooking|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EventManager\Model\Entity\EventBooking patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventBooking[] patchEntities($entities, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventBooking findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventBookingsTable extends Table
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

        $this->setTable('event_bookings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
            'className' => 'EventManager.Events'
        ]);
        $this->belongsTo('Coupons', [
            'foreignKey' => 'coupon_id',
            'joinType' => 'INNER',
            'className' => 'EventManager.Coupons'
        ]);
        $this->hasMany('EventBookingOptions', [
            'foreignKey' => 'event_booking_id',
            'className' => 'EventManager.EventBookingOptions'
        ]);
        $this->belongsToMany('Transactions', [
            'foreignKey' => 'event_booking_id',
            'targetForeignKey' => 'transaction_id',
            'joinTable' => 'transactions_event_bookings',
            'className' => 'EventManager.Transactions'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 150)
            //->requirePresence('first_name', 'create')
            ->allowEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 150)
            //->requirePresence('last_name', 'create')
            ->allowEmpty('last_name');

        $validator
            ->email('email')
            //->requirePresence('email', 'create')
            ->allowEmpty('email');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 16)
            //->requirePresence('mobile', 'create')
            ->allowEmpty('mobile');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            //->requirePresence('address', 'create')
            ->allowEmpty('address');

        $validator
            ->decimal('amount')
            //->requirePresence('amount', 'create')
            ->allowEmpty('amount');

        $validator
            ->decimal('discount')
            //->requirePresence('discount', 'create')
            ->allowEmpty('discount');

        $validator
            ->decimal('total_amount')
            //->requirePresence('total_amount', 'create')
            ->allowEmpty('total_amount');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['event_id'], 'Events'));
        $rules->add($rules->existsIn(['coupon_id'], 'Coupons'));

        return $rules;
    }
}
