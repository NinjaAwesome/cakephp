<?php

namespace App\Model\Table;

use Cake\ORM\Table;

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
class CommentsTable extends Table
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

        $this->setTable('collabed_comments');

        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('Userssoc', [
            'foreignKey' => 'id',
            'bindingKey' => 'user_id'
        ]);


    }


}
