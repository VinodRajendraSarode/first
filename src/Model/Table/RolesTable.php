<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class RolesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
      
        $this->setTable('roles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
		$this->addBehavior('Search.Search');
        $this->addBehavior('Timestamp');
 
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
                'field' => ['name']
            ]
        );
        return $searchManager;
    }    
	
}
