<?php

namespace EventManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventDocuments Model
 *
 * @property \EventManager\Model\Table\EventsTable|\Cake\ORM\Association\BelongsTo $Events
 *
 * @method \EventManager\Model\Entity\EventDocument get($primaryKey, $options = [])
 * @method \EventManager\Model\Entity\EventDocument newEntity($data = null, array $options = [])
 * @method \EventManager\Model\Entity\EventDocument[] newEntities(array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventDocument|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EventManager\Model\Entity\EventDocument patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventDocument[] patchEntities($entities, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventDocument findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventDocumentsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('event_documents');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
            'className' => 'EventManager.Events'
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
                ->integer('file_type')
                ->requirePresence('file_type', 'create')
                ->allowEmpty('file_type');

        $validator
                ->scalar('file_name','create', 'update')
                ->maxLength('file_name', 255)
                ->notEmpty('file_name','Please select & enter documents');

//        $validator
//                ->scalar('caption')
//                ->maxLength('caption', 255)
//                ->requirePresence('caption', 'create')
//                ->notEmpty('caption');

        $validator
                ->requirePresence('caption', 'create', 'update')
                ->notEmpty('caption', 'Please enter caption')
                ->add('caption', [
                    'minLength' => [
                        'rule' => ['minLength', 3],
                        'last' => true,
                        'message' => 'Please enter minimum 3 character'
                    ],
                    'maxLength' => [
                        'rule' => ['maxLength', 255],
                        'message' => 'Please enter minimum 255 character'
                    ]
        ]);

        $validator
                ->integer('sort_order')
                ->requirePresence('sort_order', 'create', 'update')
                ->notEmpty('sort_order', 'Please enter sort number');

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
        return $rules;
    }

}
