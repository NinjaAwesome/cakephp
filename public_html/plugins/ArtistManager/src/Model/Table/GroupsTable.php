<?php
namespace ArtistManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Groups Model
 *
 * @property \ArtistManager\Model\Table\ArtistsTable|\Cake\ORM\Association\BelongsToMany $Artists
 *
 * @method \ArtistManager\Model\Entity\Group get($primaryKey, $options = [])
 * @method \ArtistManager\Model\Entity\Group newEntity($data = null, array $options = [])
 * @method \ArtistManager\Model\Entity\Group[] newEntities(array $data, array $options = [])
 * @method \ArtistManager\Model\Entity\Group|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ArtistManager\Model\Entity\Group|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ArtistManager\Model\Entity\Group patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ArtistManager\Model\Entity\Group[] patchEntities($entities, array $data, array $options = [])
 * @method \ArtistManager\Model\Entity\Group findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GroupsTable extends Table
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

        $this->setTable('groups');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

//        $this->belongsToMany('Artists', [
//            'foreignKey' => 'group_id',
//            'targetForeignKey' => 'artist_id',
//            'joinTable' => 'artists_groups',
//            'className' => 'ArtistManager.Artists'
//        ]);
        $this->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
            'joinType' => 'LEFT',
            'className' => 'ArtistManager.Artists'
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
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            //->allowEmpty('name', 'create');
            ->notEmpty('name','Please fill nickname field');

//        $validator
//            ->boolean('status')
//            ->requirePresence('status', 'create')
//            ->notEmpty('status');

        return $validator;
    }
    
    public function findFilter(Query $query, array $options)
    {
        
        if (isset($options['search_keyword']) && !empty($options['search_keyword'])) {
            $query->where(['Groups.name LIKE' => '%' . trim($options['search_keyword']) . '%',]);
            $query->orWhere(['Artists.name LIKE' => '%' . trim($options['search_keyword']) . '%',]);
        }
        if (isset($options['artist']) && $options['artist'] != "") {
            $query->where(['Groups.artist_id' => $options['artist']]);
        }
        return $query;
    }
}
