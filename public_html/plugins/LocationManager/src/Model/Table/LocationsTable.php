<?php
namespace LocationManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Cache\Cache;
/**
 * Locations Model
 *
 * @property \LocationManager\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $ParentLocations
 * @property \LocationManager\Model\Table\LocationsTable|\Cake\ORM\Association\HasMany $ChildLocations
 *
 * @method \LocationManager\Model\Entity\Location get($primaryKey, $options = [])
 * @method \LocationManager\Model\Entity\Location newEntity($data = null, array $options = [])
 * @method \LocationManager\Model\Entity\Location[] newEntities(array $data, array $options = [])
 * @method \LocationManager\Model\Entity\Location|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \LocationManager\Model\Entity\Location patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \LocationManager\Model\Entity\Location[] patchEntities($entities, array $data, array $options = [])
 * @method \LocationManager\Model\Entity\Location findOrCreate($search, callable $callback = null, $options = [])
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
            'className' => 'LocationManager.Locations',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildLocations', [
            'className' => 'LocationManager.Locations',
            'foreignKey' => 'parent_id'
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
    
    /**
     * getParentLocationsList method
     *
     * @param string $id The record id to get parent records
     * @param type $options Options Array
     * @return array key value pair of parent records
     */
    public function getParentLocationsList($id = null) {
        $records = [];
        if (!empty($id)) {
            $parents = $this->find('path', ['for' => $id])
                    ->select(['id', 'title'])
                    //->where(['id != ' => $id])
                    ->toArray();
            
            if (!empty($parents)) {
                foreach ($parents as $parent) {
                    $records[$parent->id] = $parent->title;
                }
            }
        }
        return $records;
    }
    
   public function afterSave(Event $event, EntityInterface $entity)
    {
        if (!$entity->isNew()) {
            Cache::clear(false);
        } 
    }
    
    public function findFilter(Query $query, array $options)
    {
        if (isset($options['keyword']) && !empty($options['keyword'])) {
            $query->where(function ($exp, $q) use($options) {
                return $exp->or_([
                        'Locations.title LIKE' => '%' . trim($options['keyword']) . '%',
                        'Locations.latitude LIKE' => '%' . trim($options['keyword']) . '%',
                        'Locations.longitude LIKE' => '%' . trim($options['keyword']) . '%',
                    ]);
            });
        }
        
        if (isset($options['status']) && $options['status'] != "") {
            $query->where(['Locations.status' => $options['status']]);
        }
        if (isset($options['parent_id']) && $options['parent_id'] != "") {
            $childrens = $this->find('children', ['for' => $options['parent_id']])->find('list',['keyField' => 'id', 'valueField' => 'id'])->toArray();
            $childrens[] = $options['parent_id'];
             $query->where(function ($exp, $q) use($childrens) {
                return $exp->in('Locations.id', $childrens);
            });
        }
        
        return $query;
    }
    
    public function findActive(Query $query)
    {
        return $query->where(['Locations.status' => 1]);
    }
    
}
