<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;


class SubscriptionsTable extends Table
{

 
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('subscriptions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Footprint.Footprint');
        $this->addBehavior('Search.Search');
        $this->addBehavior('Neptune.DateFormat', [
			'fields' => ['expiry_date', 'registration_date']
		]);
        
        //$this->belongsToMany('Roles');   

        $this->hasOne('Users', [
            'foreignKey' => 'id'
        ]);
        $this->belongsTo('Packages', [
            'foreignKey' => 'package_id'
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
			//->requirePresence('username')
            ->notEmpty('package_id', 'This field is compulsory');
        
        return $validator;
    } 

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
                'field' => ['Users.name','Packages.package','Subscriptions.expiry_date']
            ]
        );
        return $searchManager;
    }    

}
