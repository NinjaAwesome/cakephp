<?php
namespace CollabedManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CollabLikes Model
 *
 * @property \CollabedManager\Model\Table\CollabsTable|\Cake\ORM\Association\BelongsTo $Collabs
 *
 * @method \CollabedManager\Model\Entity\CollabLike get($primaryKey, $options = [])
 * @method \CollabedManager\Model\Entity\CollabLike newEntity($data = null, array $options = [])
 * @method \CollabedManager\Model\Entity\CollabLike[] newEntities(array $data, array $options = [])
 * @method \CollabedManager\Model\Entity\CollabLike|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CollabedManager\Model\Entity\CollabLike|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CollabedManager\Model\Entity\CollabLike patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CollabedManager\Model\Entity\CollabLike[] patchEntities($entities, array $data, array $options = [])
 * @method \CollabedManager\Model\Entity\CollabLike findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CollabedLikesTable extends Table
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

        $this->setTable('collabed_likes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Collabeds', [
            'foreignKey' => 'collabed_id',
            'joinType' => 'INNER',
            'className' => 'CollabedManager.Collabeds'
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
            ->scalar('ip_address')
            ->maxLength('ip_address', 100)
            ->requirePresence('ip_address', 'create')
            ->notEmpty('ip_address');

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
        $rules->add($rules->existsIn(['collabed_id'], 'Collabeds'));

        return $rules;
    }
}
