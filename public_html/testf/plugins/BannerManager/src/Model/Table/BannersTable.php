<?php
namespace BannerManager\Model\Table;

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
 * Banners Model
 *
 * @property |\Cake\ORM\Association\HasMany $BannerImages
 * @property |\Cake\ORM\Association\HasMany $Collabeds
 *
 * @method \BannerManager\Model\Entity\Banner get($primaryKey, $options = [])
 * @method \BannerManager\Model\Entity\Banner newEntity($data = null, array $options = [])
 * @method \BannerManager\Model\Entity\Banner[] newEntities(array $data, array $options = [])
 * @method \BannerManager\Model\Entity\Banner|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BannerManager\Model\Entity\Banner|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BannerManager\Model\Entity\Banner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \BannerManager\Model\Entity\Banner[] patchEntities($entities, array $data, array $options = [])
 * @method \BannerManager\Model\Entity\Banner findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BannersTable extends Table
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
        $this->_dir = 'img' . DS . 'uploads' . DS . 'banners' . DS ;
        $this->_dirshow = 'uploads' . DS . 'banners' . DS ;
        
        $this->setTable('banners');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('BannerImages', [
            'foreignKey' => 'banner_id',
            'className' => 'BannerManager.BannerImages'
        ]);
        $this->hasMany('Collabeds', [
            'foreignKey' => 'banner_id',
            'className' => 'BannerManager.Collabeds'
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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
                ->requirePresence('image_file', 'create')
                ->notEmpty('image_file')
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
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationUpdate(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 32)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');
        
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
     * This default function is a 'finder' to use for call by default banner those define in setting
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @return \Cake\ORM\Query
     */
    public function findDefault(Query $query)
    {
        if(Configure::read('Setting.DEFAULT_BANNER')){
            $conditions['Banners.id'] = trim(Configure::read('Setting.DEFAULT_BANNER'));
        }
        $conditions['Banners.status'] = 1;
        $query->where($conditions);
        $query->contain(['BannerImages' => function($q){
            return $q->order(['BannerImages.sort_order' => 'ASC']);
        }]);
      
        return $query;
    }
    
    public function findActive(Query $query)
    {
        $query->where(['Banners.status' => 1]);
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
