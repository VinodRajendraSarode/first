<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class CategoriesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('categories');
        $this->setDisplayField('category');
        $this->setPrimaryKey('id');
        $this->addBehavior('Muffin/Footprint.Footprint');
		$this->addBehavior('Search.Search');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Tools.Slugged',
            ['label' => 'category', 'unique' => true, 'mode' => 'url', 'overwrite'=>true, 'case'=>'low']
        );
        

        $this->hasMany('SubCategories', [
            'foreignKey' => 'category_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);


        $this->addBehavior('Proffer.Proffer', [
            'photo' => [
                'dir' => 'photo_dir',
                'thumbnailSizes' => [
                    'proper' => [
                        'w' => 630,
                        'h' => 420,
                        'fit' => true,
                        'jpeg_quality' => 100
                    ]
                ],
            ],
        ]);


     /*   $this->addBehavior('Seipkon.DateFormat', [
			'fields' => ['joining_date','leaving_date']
		]);*/
		
		/*$this->hasMany('Accessories', [
			'foreignKey' => 'accessory_categories_id',
			'joinType' => 'INNER'
		]);*/
		
	}

	public function validationDefault(Validator $validator) {
        $validator
			->requirePresence('category')
            ->notEmpty('category', 'Please enter Categories')
            ->add('category', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'Category is already used'
         ]);
         $validator
         ->requirePresence('photo', 'create')
         ->allowEmpty('photo', 'update')
         ->add('photo', [
             'validExtension' => [
                 'rule' => ['extension',['gif','png','jpg','jpeg']],
                 'message' => 'Upload only jpeg Image'
             ],
             'mimeType' => [
                 'rule' => array('mimeType', array('image/gif', 'image/png', 'image/jpg', 'image/jpeg')),
                 'message' => 'Please only upload images (gif, png, jpg).',
                 'allowEmpty' => TRUE,
             ],
             'fileSize'=> [
                 'rule'=>['fileSize', '<=', '1MB'],
                 'message' => 'File Size should be less than 1 MB'
             ]
         ]);

            
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
                'field' => ['category']
            ]
        );
        return $searchManager;
    }    
	
}
