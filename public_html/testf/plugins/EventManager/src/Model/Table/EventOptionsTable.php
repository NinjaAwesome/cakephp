<?php

namespace EventManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventOptions Model
 *
 * @property \EventManager\Model\Table\EventsTable|\Cake\ORM\Association\BelongsTo $Events
 * @property \EventManager\Model\Table\OptionsTable|\Cake\ORM\Association\BelongsTo $Options
 * @property \EventManager\Model\Table\EventOptionValuesTable|\Cake\ORM\Association\HasMany $EventOptionValues
 *
 * @method \EventManager\Model\Entity\EventOption get($primaryKey, $options = [])
 * @method \EventManager\Model\Entity\EventOption newEntity($data = null, array $options = [])
 * @method \EventManager\Model\Entity\EventOption[] newEntities(array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventOption|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EventManager\Model\Entity\EventOption patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventOption[] patchEntities($entities, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventOption findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventOptionsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('event_options');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
            'className' => 'EventManager.Events'
        ]);
        $this->belongsTo('Evoptions', [
            'foreignKey' => 'evoption_id',
            'joinType' => 'LEFT',
            'className' => 'EventManager.Evoptions'
        ]);
        
        $this->hasMany('EventOptionValues', [
            'foreignKey' => 'event_option_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
            'className' => 'EventManager.EventOptionValues',
        ]);
        
//         $this->hasMany('EventOptionValues', [
//            'foreignKey' => 'option_value_id',
//            'className' => 'EventManager.EventOptionValues',
//            'dependent' => true,
//            'cascadeCallbacks' => true,
//        ]);
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
                ->scalar('value')
                ->allowEmpty('value');
        $validator
                ->scalar('label')
                ->requirePresence('label', 'create')
                ->notEmpty('label');

        $validator
                ->boolean('is_required')
                ->requirePresence('is_required', 'create')
                ->allowEmpty('is_required');

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
        $rules->add($rules->existsIn(['event_id'], 'Events'));
        $rules->add($rules->existsIn(['evoption_id'], 'Evoptions'));

        return $rules;
    }

}
