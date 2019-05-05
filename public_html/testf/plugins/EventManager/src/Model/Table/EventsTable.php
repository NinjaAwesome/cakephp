<?php

namespace EventManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

//use Cake\Filesystem\File;

/**
 * Events Model
 *
 * @property \EventManager\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \EventManager\Model\Table\EventBookingsTable|\Cake\ORM\Association\HasMany $EventBookings
 * @property \EventManager\Model\Table\EventDocumentsTable|\Cake\ORM\Association\HasMany $EventDocuments
 * @property \EventManager\Model\Table\EventJoinsTable|\Cake\ORM\Association\HasMany $EventJoins
 * @property \EventManager\Model\Table\EventReviewsTable|\Cake\ORM\Association\HasMany $EventReviews
 *
 * @method \EventManager\Model\Entity\Event get($primaryKey, $options = [])
 * @method \EventManager\Model\Entity\Event newEntity($data = null, array $options = [])
 * @method \EventManager\Model\Entity\Event[] newEntities(array $data, array $options = [])
 * @method \EventManager\Model\Entity\Event|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EventManager\Model\Entity\Event patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EventManager\Model\Entity\Event[] patchEntities($entities, array $data, array $options = [])
 * @method \EventManager\Model\Entity\Event findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        //$this->_dir = 'uploads' . DS . 'testimonials' . DS;

        $this->setTable('events');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

//        $this->addBehavior('Upload', [
//            'fields' => [
//                'banner_image' => [
//                    'path' => $this->_dir . ':name'
//                ]
//            ]
//                ]
//        );

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'EventManager.Users'
        ]);
        $this->hasMany('EventBookings', [
            'foreignKey' => 'event_id',
            'className' => 'EventManager.EventBookings'
        ]);
        $this->hasMany('EventImages', [
            'foreignKey' => 'event_id',
            'className' => 'EventManager.EventDocuments',
            'conditions' => ['EventImages.file_type' => 1]
        ]);

        $this->hasMany('EventVideos', [
            'foreignKey' => 'event_id',
            'className' => 'EventManager.EventDocuments',
            'conditions' => ['EventVideos.file_type' => 2]
        ]);

        $this->hasMany('EventDocuments', [
            'foreignKey' => 'event_id',
            'className' => 'EventManager.EventDocuments',
        ]);

        $this->hasMany('EventJoins', [
            'foreignKey' => 'event_id',
            'className' => 'EventManager.EventJoins'
        ]);
        $this->hasMany('EventReviews', [
            'foreignKey' => 'event_id',
            'className' => 'EventManager.EventReviews'
        ]);

        $this->hasMany('EventOptions', [
            'foreignKey' => 'event_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
            'className' => 'EventManager.EventOptions'
        ]);
        
        $this->hasMany('EventOptionValues', [
            'foreignKey' => 'event_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
            'className' => 'EventManager.EventOptionValues'
        ]);
        
        $this->hasMany('EventInvites', [
            'foreignKey' => 'event_id',
            'className' => 'EventManager.EventInvites'
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
                ->requirePresence('title', 'create', 'update')
                ->notEmpty('title', 'Please enter title')
                ->add('title', [
                    'minLength' => [
                        'rule' => ['minLength', 3],
                        'last' => true,
                        'message' => 'Please enter minimum 3 character'
                    ],
                    'maxLength' => [
                        'rule' => ['maxLength', 255],
                        'message' => 'Please enter minimum 15 character'
                    ]
        ]);

        $validator
                ->requirePresence('short_description', 'create', 'update')
                ->notEmpty('short_description', 'Please enter short description')
                ->add('short_description', [
                    'minLength' => [
                        'rule' => ['minLength', 5],
                        'last' => true,
                        'message' => 'Please enter minimum 15 character'
                    ],
                    'maxLength' => [
                        'rule' => ['maxLength', 400],
                        'message' => 'Please enter minimum 400 character'
                    ]
        ]);

        $validator
                ->scalar('description')
                ->requirePresence('description', 'create', 'update')
                ->notEmpty('description', 'Please enter description');

        $validator
                ->requirePresence('location', 'create', 'update')
                ->notEmpty('location', 'Please enter event location')
                ->add('location', [
                    'minLength' => [
                        'rule' => ['minLength', 5],
                        'last' => true,
                        'message' => 'Please enter minimum 15 character'
                    ],
                    'maxLength' => [
                        'rule' => ['maxLength', 255],
                        'message' => 'Please enter minimum 255 character'
                    ]
        ]);

        $validator
                ->requirePresence('organizar_name', 'create', 'update')
                ->notEmpty('organizar_name', 'Please enter organizar name')
                ->add('organizar_name', [
                    'minLength' => [
                        'rule' => ['minLength', 5],
                        'last' => true,
                        'message' => 'Please enter minimum 15 character'
                    ],
                    'maxLength' => [
                        'rule' => ['maxLength', 150],
                        'message' => 'Please enter minimum 255 character'
                    ]
        ]);

        $validator
                ->email('organizer_email')
                ->maxLength('organizer_email', 250)
                ->requirePresence('organizer_email', 'create')
                ->notEmpty('organizer_email', 'Please enter email address')
                ->add('organizer_email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
                ->scalar('banner_image')
                //->maxLength('banner_image', 255)
                //->requirePresence('banner_image', 'create')
                ->allowEmpty('banner_image');

//        $validator
//                ->allowEmpty('banner_image_file')
//                ->add('banner_image_file', [
//                    'validExtension' => [
//                        'rule' => ['extension', ['png', 'gif', 'jpeg', 'jpg']], // default  ['gif', 'jpeg', 'png', 'jpg']
//                        'message' => __('These files extension are allowed: .png,.gif,.jpeg or jpg')
//                    ]
//        ]);

        $validator
                ->decimal('amount')
                ->requirePresence('amount', 'create', 'update')
                ->allowEmpty('amount', 'Please enter amount');

        $validator
                ->integer('max_participants')
                ->requirePresence('max_participants', 'create', 'update')
                ->allowEmpty('max_participants', 'Please enter max participants');

        $validator
                ->date('start_date')
                ->requirePresence('start_date', 'create', 'update')
                ->notEmpty('start_date', 'Please select start date');

        $validator
                ->date('end_date')
                ->requirePresence('end_date', 'create', 'update')
                ->notEmpty('end_date', 'Please select end date');


        $validator
                ->requirePresence('meta_title', 'create', 'update')
                ->notEmpty('meta_title', 'Please enter meta title')
                ->add('meta_title', [
                    'minLength' => [
                        'rule' => ['minLength', 5],
                        'last' => true,
                        'message' => 'Please enter minimum 15 character'
                    ],
                    'maxLength' => [
                        'rule' => ['maxLength', 255],
                        'message' => 'Please enter minimum 255 character'
                    ]
        ]);

        $validator
                ->requirePresence('meta_keyword', 'create', 'update')
                ->notEmpty('meta_keyword', 'Please enter meta keyword')
                ->add('meta_keyword', [
                    'minLength' => [
                        'rule' => ['minLength', 5],
                        'last' => true,
                        'message' => 'Please enter minimum 15 character'
                    ],
                    'maxLength' => [
                        'rule' => ['maxLength', 255],
                        'message' => 'Please enter minimum 255 character'
                    ]
        ]);


        $validator
                ->scalar('meta_description')
                ->requirePresence('meta_description', 'create', 'update')
                ->notEmpty('meta_description', 'Please enter meta description');

        $validator
                ->boolean('is_join')
                ->allowEmpty('is_join');

        $validator
                ->boolean('is_register')
                ->allowEmpty('is_register');

        $validator
                ->boolean('is_paid')
                ->allowEmpty('is_paid');

        $validator
                ->boolean('status')
                ->allowEmpty('status');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }

//    public function findDefault(Query $query) {
//        $conditions['Events.status'] = 1;
//        $query->where($conditions);
//        $query->contain(['EventDocuments' => function($q) {
//                return $q->order(['EventDocuments.sort_order' => 'ASC']);
//            }]);
//                return $query;
//            }
}
