<?php
namespace BusinessDirectoryManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ListingCatalogs Model
 *
 * @property \BusinessDirectoryManager\Model\Table\ListingsTable|\Cake\ORM\Association\BelongsTo $Listings
 *
 * @method \BusinessDirectoryManager\Model\Entity\ListingCatalog get($primaryKey, $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\ListingCatalog newEntity($data = null, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\ListingCatalog[] newEntities(array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\ListingCatalog|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\ListingCatalog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\ListingCatalog[] patchEntities($entities, array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\ListingCatalog findOrCreate($search, callable $callback = null, $options = [])
 */
class ListingCatalogsTable extends Table
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

        $this->setTable('listing_catalogs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'BusinessDirectoryManager.Listings'
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
            ->scalar('images')
            ->maxLength('images', 255)
            ->allowEmpty('images');

        $validator
            ->scalar('caption')
            ->maxLength('caption', 255)
            ->allowEmpty('caption');

        $validator
            ->integer('sort_order')
            ->requirePresence('sort_order', 'create')
            ->notEmpty('sort_order');

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
        $rules->add($rules->existsIn(['listing_id'], 'Listings'));

        return $rules;
    }
}
