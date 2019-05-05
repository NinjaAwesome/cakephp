<?php
namespace CollabedManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CollabLikes Model
 *
 * @property \CollabedManager\Model\Table\CollabsTable|\Cake\ORM\Association\BelongsTo $Collabs
 *
 * @method \CollabedManager\Model\Entity\CollabLike get($primaryKey, $options = [])
 * @method \CollabedManager\Model\Entity\CollabLike newEntity($data = null, array $options = [])
 * @method \CollabedManager\Model\Entity\CollabLike[] newEntities(array $data, array $options = [])
 * @method \CollabedManager\Model\Entity\CollabLike|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CollabedManager\Model\Entity\CollabLike|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CollabedManager\Model\Entity\CollabLike patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CollabedManager\Model\Entity\CollabLike[] patchEntities($entities, array $data, array $options = [])
 * @method \CollabedManager\Model\Entity\CollabLike findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArtistsTable extends Table
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

        $this->setTable('artists');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

    }


}
