<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

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
class VendorsTable extends Table
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

        $this->setTable('vendors');
        $this->setDisplayField('vendor');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Footprint.Footprint');
        $this->addBehavior('Search.Search');

        //$this->belongsToMany('Roles');

        $this->hasOne('Users', [
            'foreignKey' => 'id'
        ]);


        $this->hasOne('ActiveSubscription', [
            'className' => 'Subscriptions',
            'foreignKey' => 'vendor_id',
            'conditions' => ['ActiveSubscription.active'=>true]
        ]);

        $this->hasMany('Listings', [
            'foreignKey' => 'vendor_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
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
                'field' => ['vendor']
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

    public function validationDefault(Validator $validator) {
        $validator
			->requirePresence('vendor')
            ->notEmpty('vendor', 'This field is compulsory');
        $validator
            ->allowEmptyString('referred_by')
            ->add('referred_by', 'validFormat', [
                'rule' => 'email',
                'message' => 'E-mail must be valid'
            ]);

        return $validator;
    }

    public function save2($data, $user) {
    	$val=true;
        $connection = ConnectionManager::get('default');
        $connection->begin();

    	$data['name'] = $data['vendor']['vendor'];
        //$Users = TableRegistry::get('Users');
        $user = $this->Users->patchEntity($user, $data, [
            'associated' => ['Roles','Vendors','Subscriptions']
        ]);

        $val = $val && $this->Users->save($user);
        if(!empty($user['vendor']['id'])){
            $Subscriptions = TableRegistry::get('Subscriptions');
            $subscriptions = $Subscriptions->get($user['vendor']['id']);
            $subscriptions['vendor_id'] = $user['vendor']['id'];
            $val = $val && $Subscriptions->save($subscriptions);
        }

        if($val){
			$connection->commit();
		} else {
			$connection->rollback();
        }
		return $val;
	}
}
