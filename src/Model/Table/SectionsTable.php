<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;


class SectionsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

		$this->addBehavior('Muffin/Footprint.Footprint');

        $this->setTable('sections');
        $this->setDisplayField('contents');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Search');
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
                'field' => ['section']
            ]
        );
        return $searchManager;
    }    
}
