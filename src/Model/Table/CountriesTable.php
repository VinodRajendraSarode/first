<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class CountriesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('countries');
        $this->setDisplayField('country');
        $this->setPrimaryKey('id');
        $this->addBehavior('Muffin/Footprint.Footprint');
		$this->addBehavior('Search.Search');
        $this->addBehavior('Timestamp');
     /*   $this->addBehavior('Seipkon.DateFormat', [
			'fields' => ['joining_date','leaving_date']
		]);*/

        $this->hasMany('Listings', [
            'foreignKey' => 'country_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
    
        $this->hasMany('States', [
            'foreignKey' => 'country_id'
        ]);
        
        $this->hasMany('Cities', [
            'foreignKey' => 'country_id'
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
                'field' => ['country']
            ]
        );
        return $searchManager;
    }    
	
}
