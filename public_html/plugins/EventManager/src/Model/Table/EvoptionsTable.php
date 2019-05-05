<?php

namespace EventManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Evoptions Model
 *
 * @method \EventManager\Model\Entity\Evoption get($primaryKey, $options = [])
 * @method \EventManager\Model\Entity\Evoption newEntity($data = null, array $options = [])
 * @method \EventManager\Model\Entity\Evoption[] newEntities(array $data, array $options = [])
 * @method \EventManager\Model\Entity\Evoption|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EventManager\Model\Entity\Evoption patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EventManager\Model\Entity\Evoption[] patchEntities($entities, array $data, array $options = [])
 * @method \EventManager\Model\Entity\Evoption findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EvoptionsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('evoptions');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('EvoptionValues', [
            'foreignKey' => 'evoption_id',
            'className' => 'EventManager.EvoptionValues',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        $this->hasMany('EventOptions', [
            'foreignKey' => 'event_option_id',
            'className' => 'EventManager.EventOptions',
            'dependent' => true,
            'cascadeCallbacks' => true,
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
                ->scalar('option_type')
                ->maxLength('option_type', 20)
                ->requirePresence('option_type', 'create')
                ->notEmpty('option_type');

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

}
