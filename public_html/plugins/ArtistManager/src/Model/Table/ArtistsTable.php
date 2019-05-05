<?php
namespace ArtistManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Artists Model
 *
 * @property \ArtistManager\Model\Table\GroupsTable|\Cake\ORM\Association\BelongsToMany $Groups
 *
 * @method \ArtistManager\Model\Entity\Artist get($primaryKey, $options = [])
 * @method \ArtistManager\Model\Entity\Artist newEntity($data = null, array $options = [])
 * @method \ArtistManager\Model\Entity\Artist[] newEntities(array $data, array $options = [])
 * @method \ArtistManager\Model\Entity\Artist|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ArtistManager\Model\Entity\Artist|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ArtistManager\Model\Entity\Artist patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ArtistManager\Model\Entity\Artist[] patchEntities($entities, array $data, array $options = [])
 * @method \ArtistManager\Model\Entity\Artist findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArtistsTable extends Table
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

        $this->setTable('artists');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

//        $this->belongsToMany('Groups', [
//            'foreignKey' => 'artist_id',
//            'targetForeignKey' => 'group_id',
//            'joinTable' => 'artists_groups',
//            'className' => 'ArtistManager.Groups'
//        ]);
        $this->hasMany('Groups', [
            'foreignKey' => 'artist_id',
            'joinType' => 'LEFT',
            'className' => 'ArtistManager.Groups'
            
        ]);
        $this->hasMany('Collabeds', [
            'foreignKey' => 'artist_1',
            'className' => 'ArtistManager.Collabeds'
        ]);
        $this->hasMany('Collabeds', [
            'foreignKey' => 'artist_2',
            'className' => 'ArtistManager.Collabeds'
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Name already exist.']);

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
    
    public function findFilter(Query $query, array $options)
    {
        
        if (isset($options['search_keyword']) && !empty($options['search_keyword'])) {
            $query->where(['Artists.name LIKE' => '%' . trim($options['search_keyword']) . '%',]);
        }
        //dump($query);die;
        if (isset($options['status']) && $options['status'] != "") {
            $query->where(['Artists.status' => $options['status']]);
        }
        return $query;
    }
    public function findWithInDate(Query $query, array $options)
    {
        if ((isset($options['start_date']) && !empty($options['start_date'])) && (isset($options['end_date']) && !empty($options['end_date']))) {
            $query->where(function ($exp) use($options) {
                return $exp->gte("DATE(Artists.created)", $options['start_date'])->lte("DATE(Artists.created)", $options['end_date']);
            });
        }
        if ((isset($options['start_date']) && !empty($options['start_date'])) && (empty($options['end_date']))) {
            $query->where(function ($exp) use($options) {
                return $exp->eq("DATE(Artists.created)", $options['start_date']);
            });
        }
        return $query;
    }
    public function findActive(Query $query)
    {
        $query->where(['Artists.status' => 1]);
        return $query;
    }
}
