<?php

namespace EventManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


/**
 * EventBookingOptionValues Model
 *
 * @property \EventManager\Model\Table\EventBookingOptionsTable|\Cake\ORM\Association\BelongsTo $EventBookingOptions
 *
 * @method \EventManager\Model\Entity\EventBookingOptionValue get($primaryKey, $options = [])
 * @method \EventManager\Model\Entity\EventBookingOptionValue newEntity($data = null, array $options = [])
 * @method \EventManager\Model\Entity\EventBookingOptionValue[] newEntities(array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventBookingOptionValue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EventManager\Model\Entity\EventBookingOptionValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventBookingOptionValue[] patchEntities($entities, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventBookingOptionValue findOrCreate($search, callable $callback = null, $options = [])
 */
class EventBookingOptionValuesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('event_booking_option_values');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('EventBookingOptions', [
            'foreignKey' => 'event_booking_option_id',
            'joinType' => 'INNER',
            'className' => 'EventManager.EventBookingOptions'
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
                //->scalar('opt_value')
                ->maxLength('opt_value', 200)
                //->requirePresence('opt_value', 'create')
                ->allowEmpty('opt_value');

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
        $rules->add($rules->existsIn(['event_booking_option_id'], 'EventBookingOptions'));

        return $rules;
    }

    

}
