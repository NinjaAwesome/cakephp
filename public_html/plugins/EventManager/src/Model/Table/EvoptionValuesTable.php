<?php

namespace EventManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EvoptionValues Model
 *
 * @property \EventManager\Model\Table\OptionsTable|\Cake\ORM\Association\BelongsTo $Options
 *
 * @method \EventManager\Model\Entity\EvoptionValue get($primaryKey, $options = [])
 * @method \EventManager\Model\Entity\EvoptionValue newEntity($data = null, array $options = [])
 * @method \EventManager\Model\Entity\EvoptionValue[] newEntities(array $data, array $options = [])
 * @method \EventManager\Model\Entity\EvoptionValue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EventManager\Model\Entity\EvoptionValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EvoptionValue[] patchEntities($entities, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EvoptionValue findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EvoptionValuesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('evoption_values');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Evoptions', [
            'foreignKey' => 'evoption_id',
            'joinType' => 'INNER',
            'className' => 'EventManager.Evoptions'
        ]);

        $this->belongsTo('EventOptionValue', [
            'foreignKey' => 'evoption_value_id',
            'joinType' => 'INNER',
            'className' => 'EventManager.EventOptionValue'
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
                ->scalar('title')
                ->maxLength('title', 100)
                ->requirePresence('title', 'create')
                ->notEmpty('title');


        $validator
                ->integer('sort_order')
                ->requirePresence('sort_order', 'create')
                ->notEmpty('sort_order');

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
        $rules->add($rules->existsIn(['evoption_id'], 'Evoptions'));

        return $rules;
    }

}
