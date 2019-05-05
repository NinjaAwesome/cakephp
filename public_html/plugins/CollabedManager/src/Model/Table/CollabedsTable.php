<?php
namespace CollabedManager\Model\Table;

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
 * Collabeds Model
 *
 * @property \CollabedManager\Model\Table\BannersTable|\Cake\ORM\Association\BelongsTo $Banners
 *
 * @method \CollabedManager\Model\Entity\Collabed get($primaryKey, $options = [])
 * @method \CollabedManager\Model\Entity\Collabed newEntity($data = null, array $options = [])
 * @method \CollabedManager\Model\Entity\Collabed[] newEntities(array $data, array $options = [])
 * @method \CollabedManager\Model\Entity\Collabed|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CollabedManager\Model\Entity\Collabed|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CollabedManager\Model\Entity\Collabed patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CollabedManager\Model\Entity\Collabed[] patchEntities($entities, array $data, array $options = [])
 * @method \CollabedManager\Model\Entity\Collabed findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CollabedsTable extends Table
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
        $this->_dir = 'img' . DS . 'uploads' . DS . 'collabeds' . DS ;
        $this->setTable('collabeds');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Artistsone', [
            'foreignKey' => 'artist_1',
            //'propertyName' => 'artistsone',
            'className' => 'CollabedManager.Artists'
        ]);
        $this->belongsTo('Artiststwo', [
            'foreignKey' => 'artist_2',
            //'propertyName' => 'artiststwo',
            'className' => 'CollabedManager.Artists'
        ]);
        $this->belongsTo('Banners', [
            'foreignKey' => 'banner_id',
            'className' => 'CollabedManager.Banners'
        ]);

        $this->belongsTo('UsersSoc', [
            'foreignKey' => 'user_id',
            //'propertyName' => 'artiststwo',
            'className' => 'CollabedManager.UsersSoc'
        ]);

        $this->hasMany('CollabedLikes', [
            'foreignKey' => 'collabed_id',
            'dependent' => true,
            'className' => 'CollabedManager.CollabedLikes'
        ]);
        
        $this->addBehavior('Upload', [
            'fields' => [
                    'image' => ['path' => $this->_dir . ':custom_name'],
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
            ->integer('artist_1')
            ->requirePresence('artist_1', 'create')
            ->notEmpty('artist_1');

        $validator
            ->integer('artist_2')
            ->requirePresence('artist_2', 'create')
            ->notEmpty('artist_2');
        
        $validator
            ->integer('banner_id')
            ->requirePresence('banner_id', 'create')
            ->notEmpty('banner_id');

//        $validator
//                ->requirePresence('image_file', 'create')
//                ->notEmpty('image_file')
//                ->add('image_file', [
//                    'fileSize'       => [
//                        'rule'    => ['fileSize', '<=', '5mb'],
//                        'last'    => true,
//                        'message' => __('Wrong file size. File size must be below 5 mb.')
//                    ],
//                    'validExtension' => [
//                        'rule'    => ['extension', ['png']], // default  ['gif', 'jpeg', 'png', 'jpg']
//                        'message' => __('These files extension are allowed: .png')
//                    ]
//        ]);

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');


        return $validator;
    }
    
    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationUpdate(Validator $validator)
    {
        $validator
                ->requirePresence('image_file', 'update')
                ->allowEmpty('image_file')
                ->add('image_file', [
                    'fileSize'       => [
                        'rule'    => ['fileSize', '<=', '5mb'],
                        'last'    => true,
                        'message' => __('Wrong file size. File size must be below 5 mb.')
                    ],
                    'validExtension' => [
                        'rule'    => ['extension', ['png']], // default  ['gif', 'jpeg', 'png', 'jpg']
                        'message' => __('These files extension are allowed: .png')
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
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['banner_id'], 'Banners'));

        return $rules;
    }
    
    
    
    public function findFilter(Query $query, array $options)
    {
        
        if (isset($options['search_keyword']) && !empty($options['search_keyword'])) {
            $query->where(['OR' => ['Artistsone.name LIKE' => '%' . trim($options['search_keyword']) . '%','Artiststwo.name LIKE' => '%' . trim($options['search_keyword']) . '%']]);            
        }

        return $query;
    }
    
    public function findFilterAdmin(Query $query, array $options)
    {
        
        if (isset($options['artists']) && $options['artists'] != "") {
            $query->where(['Artistsone.id' => $options['artists']]);
            $query->orWhere(['Artiststwo.id' => $options['artists']]);
        }
        //dump($query);die;
        if (isset($options['status']) && $options['status'] != "") {
            $query->where(['Collabeds.status' => $options['status']]);
        }
        
        return $query;
    }
    
    public function findWithInDate(Query $query, array $options)
    {
        if ((isset($options['start_date']) && !empty($options['start_date'])) && (isset($options['end_date']) && !empty($options['end_date']))) {
            $query->where(function ($exp) use($options) {
                return $exp->gte("DATE(Collabeds.created)", $options['start_date'])->lte("DATE(Collabeds.created)", $options['end_date']);
            });
        }
        if ((isset($options['start_date']) && !empty($options['start_date'])) && (empty($options['end_date']))) {
            $query->where(function ($exp) use($options) {
                return $exp->eq("DATE(Collabeds.created)", $options['start_date']);
            });
        }
        return $query;
    }
    public function findActive(Query $query)
    {
        $query->where(['Collabeds.status' => 1]);
        return $query;
    }
    
    public function findArtistActive(Query $query)
    {
        //$query->where(['Collabeds.status' => 1]);
        $query->matching('Artistsone', function ($q) {
            return $q->where(['Artistsone.status' => 1]);
        });
        $query->matching('Artiststwo', function ($q) {
            return $q->where(['Artiststwo.status' => 1]);
        });
        return $query;
    }
    
    public function deleteImage($image = '', $record = null)
    {
        if (!empty($image->image)) {
            $file = new File($this->_dir . $image->image, false);
            if ($file->exists()) {
                $file->delete();
            }
        }
        
        if (!empty($record)) {    
            $record->image = '';
            return $this->save($record);
        }
        
        return true;
    }
}
