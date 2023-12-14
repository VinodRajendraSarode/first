<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class SubCategoriesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('sub_categories');
        $this->setDisplayField('sub_category');
        $this->setPrimaryKey('id');
        $this->addBehavior('Muffin/Footprint.Footprint');
		$this->addBehavior('Search.Search');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Tools.Slugged',
        ['label' => 'sub_category', 'unique' => true, 'mode' => 'url', 'overwrite'=>true, 'case'=>'low']
        ); 

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id'
        ]);

        $this->hasMany('Listings', [
            'foreignKey' => 'sub_category_id',
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
			->requirePresence('sub_category')
            ->notEmpty('sub_category', 'Please enter SubCategories')
            ->add('sub_category', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'sub_category is already used'
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
                'field' => ['sub_category']
            ]
        );
        return $searchManager;
    }    
	
}
