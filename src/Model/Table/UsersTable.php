<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use League\OAuth2\Client\Provider\AbstractProvider;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Search');

        $this->belongsToMany('Roles');


        $this->hasMany('Listings', [
            'foreignKey' => 'user_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        $this->hasOne('Subscriptions', [
            'foreignKey' => 'id'
        ]);


        $this->hasOne('ActiveSubscription', [
            'className' => 'Subscriptions',
            'foreignKey' => 'id',
            'conditions' => ['ActiveSubscription.active'=>true]
        ]);
    }

    /**
     * @return \Search\Manager
     */
    public function searchManager()
    {
        $searchManager = $this->behaviors()->Search->searchManager();

        $searchManager
            ->add('search', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['name', 'email', 'mobile_1']
            ])
            ->add('foo', 'Search.Callback', [
                'callback' => function ($query, $args, $filter) {
                }
            ]
        );
        return $searchManager;
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */

    public function validationDefault(Validator $validator)
    {
        /*$validator
			->requirePresence('name')
            ->notEmpty('name', 'This field is compulsory');
        */

        $validator
            ->notEmpty('email', 'Please fill this Email')
            ->add('email', 'validFormat', [
                    'rule' => 'email',
                    'message' => 'E-mail must be valid'
            ]);
        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 10)
            ->regex('mobile', '/^([1-9]){1}([0-9]){9}?$/', 'Please Enter valid Mobile Number');

        $validator
            //->requirePresence('password')
            ->notEmpty('password', 'Please enter Password')
			->add('password', ['checkPassword' => [
				'rule' => 'checkPassword',
				'provider'=>'table',
				'message' => 'Passwords do not match. Please, try again.',
			]]
		);

        return $validator;
    }

    public function checkPassword($check, array $context) {
        if(isset($context['data']['verify_password'])) {
            if (isset($context['data']['password'])) {
                if ($check != $context['data']['verify_password']) {
                    return false;
                }
            }
        }
		return true;
	}

    public function save2($data, $user) {

       
    	$val=true;
        $connection = ConnectionManager::get('default');
        $connection->begin();

    	$data['name'] = $data['name'];
        $Users = TableRegistry::get('Users');
        $user = $Users->patchEntity($user, $data, [
            'associated' => ['Roles', 'Subscriptions']
        ]);
        
        $val = $val && $Users->save($user);

        if($val){
			$connection->commit();
		} else {
			$connection->rollback();
        }
		return $val;
	}

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['email'], 'This email is already in use'));
        $rules->add($rules->isUnique(['mobile'], 'This number is already in use'));
        return $rules;
    }

    public function findAuth(\Cake\ORM\Query $query, array $options)
    {

       

        $this->hasOne('Subscriptions', [
            'foreignKey'=>'id'
        ]);

        //$query->where(['Users.active' => 1]);

        $query
            ->where(['Users.active' => 1])
            ->contain(['Roles','Subscriptions']);

        return $query;
    }

    public function createNewUser(Event $event, AbstractProvider $provider, array $data)
    {
        $data['roles']['_ids'][] = 3;
        $entity = $this->newEntity($data);
        $this->save($entity);

        return $entity->toArray(); // user data to be used in session
    }
}
