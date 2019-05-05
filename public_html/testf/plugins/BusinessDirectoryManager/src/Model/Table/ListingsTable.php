<?php namespace BusinessDirectoryManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Listings Model
 *
 * @property \BusinessDirectoryManager\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \BusinessDirectoryManager\Model\Table\IndustriesTable|\Cake\ORM\Association\BelongsTo $Industries
 * @property \BusinessDirectoryManager\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $Locations
 * @property \BusinessDirectoryManager\Model\Table\ListingCatalogsTable|\Cake\ORM\Association\HasMany $ListingCatalogs
 *
 * @method \BusinessDirectoryManager\Model\Entity\Listing get($primaryKey, $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Listing newEntity($data = null, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Listing[] newEntities(array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Listing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Listing|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Listing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Listing[] patchEntities($entities, array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Listing findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ListingsTable extends Table
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

        $this->setTable('listings');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'BusinessDirectoryManager.Users'
        ]);
        $this->belongsTo('Industries', [
            'foreignKey' => 'industry_id',
            'joinType' => 'INNER',
            'className' => 'BusinessDirectoryManager.Industries'
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'className' => 'BusinessDirectoryManager.Locations'
        ]);
        $this->hasMany('ListingCatalogs', [
            'foreignKey' => 'listing_id',
            'className' => 'BusinessDirectoryManager.ListingCatalogs'
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
            ->requirePresence('industry_id', 'create')
            ->notEmpty('industry_id', 'Please enter Industry');
        $validator
            ->requirePresence('business_name', 'create')
            ->notEmpty('business_name', 'Please enter business name');

        $validator
            ->requirePresence('company_name', 'create')
            ->notEmpty('company_name', 'Please enter company name');

        $validator
            ->scalar('company_mobile_no')
            ->requirePresence('company_mobile_no', 'create')
            ->notEmpty('company_mobile_no', 'Please enter your mobile number here.')
            ->add('company_mobile_no', 'custom', [
                'rule' => array('custom', '/^[0-9+]*$/i'),
                'message' => __('Please enter a valid mobile number')
            ])
            ->add('company_mobile_no', 'lengthBetween', [
                'rule' => ['lengthBetween', 4, 16],
                'message' => 'Mobile Number must contain minimum 4 and maximum 16 characters'
        ]);

        $validator
            ->scalar('company_fax_no')
            ->requirePresence('company_fax_no', 'create')
            ->allowEmpty('company_fax_no', 'Please enter your mobile number here.')
            ->add('company_fax_no', 'custom', [
                'rule' => array('custom', '/^[0-9+]*$/i'),
                'message' => __('Please enter a valid fax mobile number')
            ])
            ->add('company_fax_no', 'lengthBetween', [
                'rule' => ['lengthBetween', 4, 16],
                'message' => ' Fax Mobile Number must contain minimum 4 and maximum 16 characters'
        ]);
        $validator
            ->scalar('company_tollfree_no')
            ->requirePresence('company_tollfree_no', 'create')
            ->allowEmpty('company_tollfree_no', 'Please enter your mobile number here.')
            ->add('company_tollfree_no', 'custom', [
                'rule' => array('custom', '/^[0-9+]*$/i'),
                'message' => __('Please enter a valid toll free  number')
            ])
            ->add('company_tollfree_no', 'lengthBetween', [
                'rule' => ['lengthBetween', 4, 16],
                'message' => 'Toll Free Number must contain minimum 4 and maximum 16 characters'
        ]);

        $validator
            ->requirePresence('company_email', 'create')
            ->allowEmpty('company_email', 'Please enter the company email');

        $validator
            ->requirePresence('company_website', 'create')
            ->allowEmpty('company_website', 'Please enter the company Website')
            ->add('company_website', 'valid', ['rule' => 'url']);

        $validator
            ->requirePresence('contact_person_name', 'create')
            ->notEmpty('contact_person_name', 'Please enter the contact person name');

        $validator
            ->requirePresence('contact_person_designation', 'create')
            ->notEmpty('contact_person_designation', 'Please enter the contact person designation');

        $validator
            ->email('contact_person_email')
            ->requirePresence('contact_person_email', 'create')
            ->notEmpty('contact_person_email', 'Please enter the contact person email');

        $validator
            ->scalar('contact_person_phone')
            ->requirePresence('contact_person_phone', 'create')
            ->notEmpty('contact_person_phone', 'Please enter your mobile number here.')
            ->add('contact_person_phone', 'custom', [
                'rule' => array('custom', '/^[0-9+]*$/i'),
                'message' => __('Please enter a valid contact person phone')
            ])
            ->add('contact_person_phone', 'lengthBetween', [
                'rule' => ['lengthBetween', 4, 16],
                'message' => 'contact person phone Number must contain minimum 4 and maximum 16 characters'
        ]);

        $validator
            ->requirePresence('location_id', 'create')
            ->notEmpty('location_id', 'Please enter Location id');

        $validator
            ->requirePresence('address_line_1', 'create')
            ->notEmpty('address_line_1', 'Please enter address line 1');

        $validator
            ->requirePresence('postcode', 'create')
            ->notEmpty('postcode', 'Please enter postcode');
        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description', 'Please enter description');



        $validator
            ->requirePresence('short_description', 'create')
            ->notEmpty('short_description', 'Please enter short description');

        $validator
            ->requirePresence('meta_title', 'create')
            ->notEmpty('meta_title', 'Please enter meta title');


        $validator
            ->requirePresence('meta_keyword', 'create')
            ->notEmpty('meta_keyword', 'Please enter meta keyword');

        $validator
            ->requirePresence('meta_description', 'create')
            ->notEmpty('meta_description', 'Please enter meta description');






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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['industry_id'], 'Industries'));
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        return $rules;
    }

    public function findFilter(Query $query, array $options)
    {
        if (isset($options['keyword']) && !empty($options['keyword'])) {
            $query->where(function ($exp, $q) use($options) {
                return $exp->or_([
                        'listings.company_name LIKE' => '%' . trim($options['keyword']) . '%',
                        'listings.title LIKE' => '%' . trim($options['keyword']) . '%',
                        'listings.business_name LIKE' => '%' . trim($options['keyword']) . '%',
                ]);
            });
        }

        if (isset($options['status']) && $options['status'] != "") {
            $query->where(['listings.status' => $options['status']]);
        }




        return $query;
    }
}
