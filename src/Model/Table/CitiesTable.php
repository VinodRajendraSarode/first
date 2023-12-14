<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class CitiesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('cities');
        $this->setDisplayField('city');
        $this->setPrimaryKey('id');
        $this->addBehavior('Muffin/Footprint.Footprint');
		$this->addBehavior('Search.Search');
        $this->addBehavior('Timestamp');
        /*$this->addBehavior('Seipkon.DateFormat', [
			'fields' => ['joining_date','leaving_date']
		]);*/

		/*$this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
        ]);*/
        
		
        
		$this->belongsTo('States', [
            'foreignKey' => 'state_id'
        ]);
        
		$this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
        ]);
        
        $this->hasMany('Listings', [
            'foreignKey' => 'city_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

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
                'field' => ['city']
            ]
        );
        return $searchManager;
    }    
	
}
