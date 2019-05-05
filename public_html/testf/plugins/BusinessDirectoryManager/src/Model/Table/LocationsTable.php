<?php
namespace BusinessDirectoryManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Locations Model
 *
 * @property \BusinessDirectoryManager\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $ParentLocations
 * @property \BusinessDirectoryManager\Model\Table\ListingsTable|\Cake\ORM\Association\HasMany $Listings
 * @property \BusinessDirectoryManager\Model\Table\LocationsTable|\Cake\ORM\Association\HasMany $ChildLocations
 * @property \BusinessDirectoryManager\Model\Table\JobsTable|\Cake\ORM\Association\BelongsToMany $Jobs
 *
 * @method \BusinessDirectoryManager\Model\Entity\Location get($primaryKey, $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Location newEntity($data = null, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Location[] newEntities(array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Location|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Location patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Location[] patchEntities($entities, array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Location findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class LocationsTable extends Table
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

        $this->setTable('locations');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('ParentLocations', [
            'className' => 'BusinessDirectoryManager.Locations',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('Listings', [
            'foreignKey' => 'location_id',
            'className' => 'BusinessDirectoryManager.Listings'
        ]);
        $this->hasMany('ChildLocations', [
            'className' => 'BusinessDirectoryManager.Locations',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsToMany('Jobs', [
            'foreignKey' => 'location_id',
            'targetForeignKey' => 'job_id',
            'joinTable' => 'jobs_locations',
            'className' => 'BusinessDirectoryManager.Jobs'
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
            ->scalar('title')
            ->maxLength('title', 150)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('latitude')
            ->maxLength('latitude', 150)
            ->requirePresence('latitude', 'create')
            ->notEmpty('latitude');

        $validator
            ->scalar('longitude')
            ->maxLength('longitude', 150)
            ->requirePresence('longitude', 'create')
            ->notEmpty('longitude');

        $validator
            ->scalar('iso_alpha2_code')
            ->maxLength('iso_alpha2_code', 10)
            ->allowEmpty('iso_alpha2_code');

        $validator
            ->scalar('iso_alpha3_code')
            ->maxLength('iso_alpha3_code', 10)
            ->allowEmpty('iso_alpha3_code');

        $validator
            ->integer('iso_numeric_code')
            ->allowEmpty('iso_numeric_code');

        $validator
            ->scalar('formatted_address')
            ->allowEmpty('formatted_address');

        $validator
            ->scalar('meta_title')
            ->maxLength('meta_title', 255)
            ->allowEmpty('meta_title');

        $validator
            ->scalar('meta_keyword')
            ->maxLength('meta_keyword', 300)
            ->allowEmpty('meta_keyword');

        $validator
            ->scalar('meta_description')
            ->allowEmpty('meta_description');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentLocations'));

        return $rules;
    }
}
