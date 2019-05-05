<?php
namespace ArtistManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ArtistsGroups Model
 *
 * @property \ArtistManager\Model\Table\ArtistsTable|\Cake\ORM\Association\BelongsTo $Artists
 * @property \ArtistManager\Model\Table\GroupsTable|\Cake\ORM\Association\BelongsTo $Groups
 *
 * @method \ArtistManager\Model\Entity\ArtistsGroup get($primaryKey, $options = [])
 * @method \ArtistManager\Model\Entity\ArtistsGroup newEntity($data = null, array $options = [])
 * @method \ArtistManager\Model\Entity\ArtistsGroup[] newEntities(array $data, array $options = [])
 * @method \ArtistManager\Model\Entity\ArtistsGroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ArtistManager\Model\Entity\ArtistsGroup|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ArtistManager\Model\Entity\ArtistsGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ArtistManager\Model\Entity\ArtistsGroup[] patchEntities($entities, array $data, array $options = [])
 * @method \ArtistManager\Model\Entity\ArtistsGroup findOrCreate($search, callable $callback = null, $options = [])
 */
class ArtistsGroupsTable extends Table
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

        $this->setTable('artists_groups');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
            'joinType' => 'INNER',
            'className' => 'ArtistManager.Artists'
        ]);
        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER',
            'className' => 'ArtistManager.Groups'
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
        $rules->add($rules->existsIn(['artist_id'], 'Artists'));
        $rules->add($rules->existsIn(['group_id'], 'Groups'));

        return $rules;
    }
}
