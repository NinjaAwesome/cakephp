<?php namespace UserManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use ArrayObject;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use Cake\Mailer\MailerAwareTrait;
use Cake\Filesystem\File;

/**
 * Users Model
 *
 * @property \UserManager\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \UserManager\Model\Table\CountriesTable|\Cake\ORM\Association\BelongsTo $Countries
 * @property \UserManager\Model\Table\UserTokensTable|\Cake\ORM\Association\HasMany $UserTokens
 * @property \UserManager\Model\Table\VenuesTable|\Cake\ORM\Association\HasMany $Venues
 * @property \UserManager\Model\Table\AccountTypesTable|\Cake\ORM\Association\BelongsToMany $AccountTypes
 *
 * @method \UserManager\Model\Entity\User get($primaryKey, $options = [])
 * @method \UserManager\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \UserManager\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \UserManager\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \UserManager\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \UserManager\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

    use MailerAwareTrait;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public $_dir;

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->_dir = 'img' . DS . 'uploads' . DS . 'users' . DS . 'photos' . DS;
        $this->setTable('users');
        $this->setDisplayField('display_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');


        $this->hasMany('UserTokens', [
            'foreignKey' => 'user_id',
            'className' => 'UserManager.UserTokens'
        ]);
        $this->hasMany('Venues', [
            'foreignKey' => 'user_id',
            'className' => 'UserManager.Venues'
        ]);
        $this->belongsToMany('AccountTypes', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'account_type_id',
            'joinTable' => 'users_account_types',
            'className' => 'UserManager.AccountTypes'
        ]);

        $this->addBehavior('Upload', [
            'fields' => [
                'profile_photo' => [
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
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 100)
            ->requirePresence('first_name', 'create', 'First Name is required field.')
            ->notEmpty('first_name', 'First Name is required field.');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
            ->requirePresence('last_name', 'create', 'Last Name is required field.')
            ->notEmpty('last_name', 'Last Name is required field.');


        $validator
            ->date('dob')
            ->allowEmpty('dob');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 20)
            ->allowEmpty('mobile');

        $validator
            ->email('email')
            ->requirePresence('email', 'create', 'Email is required field.')
            ->notEmpty('email', 'Email is required field.')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }

    public function validationResetpassword()
    {
        $obj = new \App\Model\Validation\PasswordValidator;
        return $obj->validations;
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
        $rules->add($rules->isUnique(['email']));
        $rules->add(function ($entity, $options) use($rules) {
            if (isset($entity->account_types)) {
                $rule = $rules->validCount('account_types', 1, '>=', 'You must have at least 1 role');

                return $rule($entity, $options);
            }
            return TRUE;
        },'validCount');
        return $rules;
    }

    public function findFilter(Query $query, array $options)
    {
        if (isset($options['keyword']) && !empty($options['keyword'])) {
            $query->where(function ($exp, $q) use($options) {
                $conc = $q->func()->concat(['Users.first_name' => 'identifier', ' ', 'Users.last_name' => 'identifier']);
                return $exp->or_([
                        'Users.first_name LIKE' => '%' . trim($options['keyword']) . '%',
                        'Users.last_name LIKE' => '%' . trim($options['keyword']) . '%',
                        'Users.email LIKE' => '%' . trim($options['keyword']) . '%',
                    ])->like($conc, '%' . trim($options['keyword']) . '%');
            });
        }
        
        if (isset($options['status']) && $options['status'] != "") {
            $query->where(['Users.status' => $options['status']]);
        }
        if (isset($options['is_verified']) && $options['is_verified'] != "") {
            $query->where(['Users.is_verified' => $options['is_verified']]);
        }
        if (isset($options['account_type_id']) && $options['account_type_id'] != "") {
            $query->innerJoinWith('AccountTypes', function($q) use($options) {
                return $q->where(['AccountTypes.id' => $options['account_type_id']]);
            });
        }
        return $query;
    }

    public function findWithInDate(Query $query, array $options)
    {
        if ((isset($options['start_date']) && !empty($options['start_date'])) && (isset($options['end_date']) && !empty($options['end_date']))) {
            $query->where(function ($exp) use($options) {
                return $exp->gte("DATE(Users.created)", $options['start_date'])->lte("DATE(Users.created)", $options['end_date']);
            });
        }
        if ((isset($options['start_date']) && !empty($options['start_date'])) && (empty($options['end_date']))) {
            $query->where(function ($exp) use($options) {
                return $exp->eq("DATE(Users.created)", $options['start_date']);
            });
        }
        return $query;
    }
    
    public function findActive(Query $query)
    {
        $query->where(['Users.status' => 1, 'Users.is_verified' => 1]);
        return $query;
    }

   
    public function beforeMarshal(Event $event, ArrayObject $data)
    {
        $trim_ar = ['first_name', 'last_name',  'email', 'mobile'];
        foreach ($data as $key => $value) {
            if (in_array($key, $trim_ar)) {
                $data[$key] = trim($value);
            }
        };
    }

    public function beforeSave(Event $event, EntityInterface $entity)
    {
        if (!$entity->isNew()) {
            if ($entity->get('email') != $entity->getOriginal('email')) {
                $entity->set("is_verified", 0);
            }
        }
    }

    public function afterSave(Event $event, EntityInterface $entity)
    {
        if ($entity->isNew()) {
                 $this->getMailer('Manu')->send('welcome', [$entity]);
        } else {
            if ($entity->get('email') != $entity->getOriginal('email')) {
                $this->getMailer('Manu')->send('welcome', [$entity]);
            }
        }
    }
}
