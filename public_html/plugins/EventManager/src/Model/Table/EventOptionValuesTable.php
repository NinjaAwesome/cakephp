<?php
namespace EventManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventOptionValues Model
 *
 * @property \EventManager\Model\Table\EventsTable|\Cake\ORM\Association\BelongsTo $Events
 * @property \EventManager\Model\Table\OptionsTable|\Cake\ORM\Association\BelongsTo $Options
 * @property \EventManager\Model\Table\EventOptionsTable|\Cake\ORM\Association\BelongsTo $EventOptions
 * @property \EventManager\Model\Table\OptionValuesTable|\Cake\ORM\Association\BelongsTo $OptionValues
 *
 * @method \EventManager\Model\Entity\EventOptionValue get($primaryKey, $options = [])
 * @method \EventManager\Model\Entity\EventOptionValue newEntity($data = null, array $options = [])
 * @method \EventManager\Model\Entity\EventOptionValue[] newEntities(array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventOptionValue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EventManager\Model\Entity\EventOptionValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventOptionValue[] patchEntities($entities, array $data, array $options = [])
 * @method \EventManager\Model\Entity\EventOptionValue findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventOptionValuesTable extends Table
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

        $this->setTable('event_option_values');
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
            'joinType' => 'INNER',
            'className' => 'EventManager.Evoptions'
        ]);
        $this->belongsTo('EventOptions', [
            'foreignKey' => 'event_option_id',
            'joinType' => 'INNER',
            'className' => 'EventManager.EventOptions'
        ]);
        $this->belongsTo('EvoptionValues', [
            'foreignKey' => 'evoptions_value_id',
            'joinType' => 'LEFT',
            'className' => 'EventManager.EvoptionValues'
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
            ->scalar('option_value')
            //->requirePresence('option_value', 'create')
            ->allowEmpty('option_value');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules){
        $rules->add($rules->existsIn(['event_id'], 'Events'));
        $rules->add($rules->existsIn(['evoption_id'], 'Evoptions'));
        $rules->add($rules->existsIn(['event_option_id'], 'EventOptions'));
        $rules->add($rules->existsIn(['evoption_value_id'], 'EvoptionValues'));
        return $rules;
    }
}
