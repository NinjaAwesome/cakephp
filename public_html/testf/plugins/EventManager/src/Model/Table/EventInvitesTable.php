<?php
namespace EventManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventInvites Model
 *
 * @property \EventManager\Model\Table\EventsTable|\Cake\ORM\Association\BelongsTo $Events
 * @property \EventManager\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \EventManager\Model\Entity\EventInvite get($primaryKey, $options = [])
 * @method \EventManager\Model\Entity\EventInvite newEntity($data = null, array $options = [])
 * @method \EventManager\Model\Entity\EventInvite[] newEntities(array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventInvite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EventManager\Model\Entity\EventInvite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventInvite[] patchEntities($entities, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventInvite findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventInvitesTable extends Table
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

        $this->setTable('event_invites');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
            'className' => 'EventManager.Events'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'EventManager.Users'
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
            ->scalar('sessionId')
            ->maxLength('sessionId', 200)
            ->requirePresence('sessionId', 'create')
            ->notEmpty('sessionId');

        $validator
            ->requirePresence('status_in', 'create')
            ->notEmpty('status_in');

        $validator
            ->dateTime('modify')
           // ->requirePresence('modify', 'create')
            ->allowEmpty('modify');

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
        $rules->add($rules->existsIn(['event_id'], 'Events'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
