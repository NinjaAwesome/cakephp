<?php
namespace BusinessDirectoryManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Filesystem\File;

/**
 * JobSeekers Model
 *
 * @property \BusinessDirectoryManager\Model\Table\JobsTable|\Cake\ORM\Association\BelongsTo $Jobs
 *
 * @method \BusinessDirectoryManager\Model\Entity\JobSeeker get($primaryKey, $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\JobSeeker newEntity($data = null, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\JobSeeker[] newEntities(array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\JobSeeker|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\JobSeeker patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\JobSeeker[] patchEntities($entities, array $data, array $options = [])
 * @method \BusinessDirectoryManager\Model\Entity\JobSeeker findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class JobSeekersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        $this->_dir = 'uploads' . DS;

        $this->setTable('job_seekers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Jobs', [
            'foreignKey' => 'job_id',
            'joinType' => 'INNER',
            'className' => 'BusinessDirectoryManager.Jobs'
        ]);

        $this->addBehavior('Upload', [
            'fields' => [
                'attachment' => [
                    'path' => $this->_dir . ':name'
                ]
            ]
                ]
        );
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create','update');

        $validator
                ->scalar('first_name')
                ->maxLength('first_name', 100)
                ->requirePresence('first_name', 'create','update')
                ->notEmpty('first_name', 'Please enter the first name');

        $validator
                ->scalar('last_name')
                ->maxLength('last_name', 50)
                ->requirePresence('last_name', 'create','update')
                ->notEmpty('last_name', 'Please enter the Last name');

        $validator
                ->email('email')
                ->requirePresence('email', 'create','update')
                ->notEmpty('email', 'Please enter the email');

        $validator
                ->scalar('mobile')
                ->maxLength('mobile', 16)
                ->requirePresence('mobile', 'create','update')
                ->notEmpty('mobile', 'Please enter the mobile');

        $validator
                ->scalar('message')
                ->maxLength('message', 255)
                ->requirePresence('message', 'create','update')
                ->notEmpty('message', 'Message can\'t be blank');


        $validator
                ->notEmpty('attachment_file')
                ->add('attachment_file', [
                    'validExtension' => [
                        'rule' => ['extension', ['pdf', 'png']],
                        'message' => __('These files extension are allowed:.pdf or png only')
                    ]
        ]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['job_id'], 'Jobs'));
        return $rules;
    }

    public function findFilter(Query $query, array $options) {
        if (isset($options['keyword']) && !empty($options['keyword'])) {
            $query->where(function ($exp, $q) use($options) {
                $conc = $q->func()->concat(['JobSeekers.first_name' => 'identifier', ' ', 'JobSeekers.last_name' => 'identifier']);
                return $exp->or_([
                            'JobSeekers.first_name LIKE' => '%' . trim($options['keyword']) . '%',
                            'JobSeekers.last_name LIKE' => '%' . trim($options['keyword']) . '%',
                            'JobSeekers.mobile ' => $options['keyword'],
                        ])->like($conc, '%' . trim($options['keyword']) . '%');
            });
        }

        if (isset($options['email']) && $options['email'] != "") {
            $query->where(['JobSeekers.email' => $options['email']]);
        }

        if (isset($options['created']) && $options['created'] != "") {
            $query->where(['JobSeekers.created' => $options['created']]);
        }
        return $query;
    }

}
