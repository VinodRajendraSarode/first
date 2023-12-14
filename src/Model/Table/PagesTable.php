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


class PagesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

		$this->addBehavior('Muffin/Footprint.Footprint');

        $this->setTable('pages');
        $this->setDisplayField('menu');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Search');
        $this->addBehavior('Tree',['level' => 'level']);
        $this->addBehavior('Tools.Slugged',
            ['label' => 'menu', 'unique' => true, 'mode' => 'url', 'overwrite'=>true, 'case'=>'low']
        ); 

        $this->belongsTo('Parent', [
            'className'=>'Pages',
            'foreignKey' => 'parent_id',
            'dependent' => true,
			'cascadeCallbacks' => true,
        ]);
        
         $this->hasMany('Sections', [
            'foreignKey' => 'page_id',
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
                'field' => ['page_title']
            ]
        );
        return $searchManager;
    }

    public function getTree() {
        return $this->find('threaded', ['fields'=>['id','parent_id','slug']]);
    }
}
