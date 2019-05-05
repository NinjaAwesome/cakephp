<?php
namespace BusinessDirectoryManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Interviews Model
 *
 * @property \BusinessDirectoryManager\Model\Table\JobSeekersTable|\Cake\ORM\Association\BelongsTo $JobSeekers
 *
 * @method \BusinessDirectoryManager\Model\Entity\Interview get($primaryKey, $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Interview newEntity($data = null, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Interview[] newEntities(array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Interview|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Interview patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Interview[] patchEntities($entities, array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\Interview findOrCreate($search, callable $callback = null, $options = [])
 */
class InterviewsTable extends Table
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

        $this->setTable('interviews');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('JobSeekers', [
            'foreignKey' => 'job_seeker_id',
            'joinType' => 'INNER',
            'className' => 'BusinessDirectoryManager.JobSeekers'
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
                ->scalar('interview_date')
                ->requirePresence('interview_date', 'create','Date of job end is required field.')
                ->notEmpty('interview_date','Date of job end is required field.');
    
            $validator
                ->scalar('interview_time_from')
                ->maxLength('interview_time_from', 250)
                ->requirePresence('interview_time_from', 'create')
                ->notEmpty('interview_time_from');
    
            $validator
                ->scalar('interview_time_to')
                ->maxLength('interview_time_to', 250)
                ->requirePresence('interview_time_to', 'create')
                ->notEmpty('interview_time_to');
            
            $validator
                ->scalar('interviewer_name')
                ->maxLength('interviewer_name', 250)
                ->requirePresence('interviewer_name', 'create')
                ->notEmpty('interviewer_name','interviewer name can not be empty');
    
            $validator
                ->scalar('status')
                ->notEmpty('status');
    
    
            $validator
                ->scalar('comments')
                ->maxLength('comments', 250)
                ->requirePresence('comments', 'create')
                ->notEmpty('comments');
    
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
        $rules->add($rules->existsIn(['job_seeker_id'], 'JobSeekers'));

        return $rules;
    }
    
     public function findFilter(Query $query, array $options)
    {  
        if (isset($options['keyword']) && !empty($options['keyword'])) {
            $query->where(function ($exp, $q) use($options) {
                return $exp->or_([
                        'Interviews.interviewer_name LIKE' => '%' . trim($options['keyword']) . '%',
                        'Interviews.comments LIKE' => '%' . trim($options['keyword']) . '%',       
                                             
                    ]);
            });
        }
        
        if (isset($options['status']) && $options['status'] != "") {
            $query->where(['Interviews.status' => $options['status']]);
        }
        
        if (isset($options['interview_date']) && $options['interview_date'] != "") {
            $query->where(['Interviews.interview_date' => $options['interview_date']]);
        }
      
        return $query;
    }
}
