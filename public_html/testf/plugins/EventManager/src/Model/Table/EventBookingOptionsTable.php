<?php

namespace EventManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use ArrayObject;
use Cake\Event\Event;

/**
 * EventBookingOptions Model
 *
 * @property \EventManager\Model\Table\EventBookingsTable|\Cake\ORM\Association\BelongsTo $EventBookings
 * @property \EventManager\Model\Table\OptionsTable|\Cake\ORM\Association\BelongsTo $Options
 * @property \EventManager\Model\Table\EventBookingOptionValuesTable|\Cake\ORM\Association\HasMany $EventBookingOptionValues
 *
 * @method \EventManager\Model\Entity\EventBookingOption get($primaryKey, $options = [])
 * @method \EventManager\Model\Entity\EventBookingOption newEntity($data = null, array $options = [])
 * @method \EventManager\Model\Entity\EventBookingOption[] newEntities(array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventBookingOption|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EventManager\Model\Entity\EventBookingOption patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventBookingOption[] patchEntities($entities, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventBookingOption findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventBookingOptionsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('event_booking_options');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EventBookings', [
            'foreignKey' => 'event_booking_id',
            'joinType' => 'INNER',
            'className' => 'EventManager.EventBookings'
        ]);
        $this->belongsTo('Evoptions', [
            'foreignKey' => 'option_id',
            'joinType' => 'INNER',
            'className' => 'EventManager.Evoptions'
        ]);
        $this->hasMany('EventBookingOptionValues', [
            'foreignKey' => 'event_booking_option_id',
            'className' => 'EventManager.EventBookingOptionValues'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                //->scalar('name')
                ->maxLength('name', 200)
                //->requirePresence('name', 'create')
                ->allowEmpty('name');

        $validator
                //->scalar('option_value')
                ->maxLength('option_value', 250)
                ->allowEmpty('option_value');

        $validator
                //->scalar('option_type')
                ->maxLength('option_type', 50)
                //->requirePresence('option_type', 'create')
                ->allowEmpty('option_type');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['event_booking_id'], 'EventBookings'));
        $rules->add($rules->existsIn(['option_id'], 'Evoptions'));

        return $rules;
    }

    public function beforeMarshal(Event $event, ArrayObject $data) {
        //pr($data);die;
        if (isset($data['event_booking_option_values'])) {
            foreach ($data['event_booking_option_values'] as $k => $evpv) {
                if (empty($evpv['opt_value'])) {
                    unset($data['event_booking_option_values'][$k]);
                }
            }
        }
    }
}
