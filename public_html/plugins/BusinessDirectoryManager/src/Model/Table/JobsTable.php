<?php
namespace BusinessDirectoryManager\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Jobs Model
 *
 * @property \BusinessDirectoryManager\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \BusinessDirectoryManager\Model\Table\ListingsTable|\Cake\ORM\Association\BelongsTo $Listings
 * @property \BusinessDirectoryManager\Model\Table\JobSeekersTable|\Cake\ORM\Association\HasMany $JobSeekers
 * @property \BusinessDirectoryManager\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsToMany $Locations
 *
 * @method \BusinessDirectoryManager\Model\Entity\Job get($primaryKey, $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Job newEntity($data = null, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Job[] newEntities(array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Job|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Job patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Job[] patchEntities($entities, array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Job findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class JobsTable extends Table
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

        $this->setTable('jobs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
     

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'BusinessDirectoryManager.Users'
        ]);
        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'BusinessDirectoryManager.Listings'
        ]);
        $this->hasMany('JobSeekers', [
            'foreignKey' => 'job_id',
            'className' => 'BusinessDirectoryManager.JobSeekers'
        ]);
        $this->belongsToMany('Locations', [
            'foreignKey' => 'job_id',
            'targetForeignKey' => 'location_id',
            'joinTable' => 'jobs_locations',
            'className' => 'BusinessDirectoryManager.Locations'
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
            ->requirePresence('job_title')
            ->notEmpty('job_title', 'Please enter the Job Title');
           

        $validator
            ->requirePresence('designation')
            ->notEmpty('designation', 'Please Enter the Job designation');
            
 
        $validator
            ->requirePresence('vacancy')
            ->notEmpty('vacancy', 'Please Enter the Vacancy')
            ->add('vacancy', [
            'length' => [
                'rule' => ['minLength', 1],
                'message' => 'Vacancy need to be at least 1 characters ']]);
        
       

        $validator
            ->requirePresence('user_id')
            ->notEmpty('user_id', 'Please enter user field')
            ->add('user_id', [
            'length' => [
                'rule' => ['minLength', 1],
                'message' => 'User must be select']]);
        $validator
            ->requirePresence('listing_id')
            ->notEmpty('listing_id', 'Please enter the listing id')
            ->add('listing_id', [
            'length' => [
                'rule' => ['minLength', 1],
                'message' => 'Listing must be select']]);

          
         $validator
            ->requirePresence('experience')
            ->notEmpty('experience', 'Please enter Experience');

        $validator
            ->requirePresence('qualification')
            ->notEmpty('qualification', 'Qualification is required field');
        
        
        $validator
            ->requirePresence('salary_min')
            ->notEmpty('salary_min', 'Minimum salary is required')
            ->add('salary_min', [
            'length' => [
                'rule' => ['minLength',3],
                'message' => 'Please Enter the minimum salary']]);
        
        $validator
            ->requirePresence('salary_max')
            ->notEmpty('salary_max', 'Please enter the maximum salary');
       
        $validator
            ->scalar('job_end')
            ->requirePresence('job_end', 'create','Please Enter the Date of job end.')
            ->notEmpty('job_end','.');      

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status','Please select the status');

        $validator
            ->scalar('job_time')
            ->maxLength('job_time', 250)
            ->requirePresence('job_time', 'create')
            ->notEmpty('job_time','Please select the Jobtime');
        
        $validator
            ->scalar('job_type')
            ->maxLength('job_type', 250)
            ->requirePresence('job_type', 'create')
            ->notEmpty('job_type','Please select the Jobtype ');
        $validator
            ->scalar('job_for')
            ->maxLength('job_for', 250)
            ->requirePresence('job_for', 'create')
            ->notEmpty('job_for','Please select job gender');

          
        $validator
            ->boolean('is_featured')
            ->requirePresence('is_featured', 'create')
            ->notEmpty('is_featured','Please select the is_featured');

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
        $rules->add($rules->existsIn(['listing_id'], 'Listings'));
        
        return $rules;
    }
    
    public function findFilter(Query $query, array $options)
    { 
        if (isset($options['keyword']) && !empty($options['keyword'])) 
         {
            $query->where(function ($exp, $q) use($options) {
                return $exp->or_([
                        'Jobs.designation LIKE' => '%' . trim($options['keyword']) . '%',
                        'Jobs.vacancy ' => $options['keyword'],
                        'Jobs.job_title LIKE' => '%' . trim($options['keyword']) . '%',
                        'Jobs.experience LIKE' => '%' . trim($options['keyword']) . '%',
                        'Jobs.qualification LIKE' => '%' . trim($options['keyword']) . '%',
                        'Jobs.salary_min ' => $options['keyword'],
                         'Jobs.salary_max ' => $options['keyword'],                       
                    ]);
            });
        }
        
        if (isset($options['status']) && $options['status'] != "") {
            $query->where(['Jobs.status' => $options['status']]);
        }
        if (isset($options['is_featured']) && $options['is_featured'] != "") {
            $query->where(['Jobs.is_featured' => $options['is_featured']]);
        }
        if (isset($options['job_end']) && $options['job_end'] != "") {
            $query->where(['Jobs.job_end' => $options['job_end']]);
        }
        
        if (isset($options['location']) && $options['location'] != "") {
            $query->matching('Locations', function($q) use($options) {return $q->where(['Locations.id IN'=> $options['location']]);});
        }
        return $query;
    }
}
