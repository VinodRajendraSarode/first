<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class ListingsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('listings');
        $this->setDisplayField('listing_title');
        $this->setPrimaryKey('id');
        $this->addBehavior('Muffin/Footprint.Footprint');
		$this->addBehavior('Search.Search');
        $this->addBehavior('Timestamp');

        $this->addBehavior('Tools.Slugged',
            ['label' => 'listing_title', 'unique' => true, 'mode' => 'url', 'overwrite'=>true, 'case'=>'low']
        );

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id'
        ]);

        $this->belongsTo('SubCategories', [
            'foreignKey' => 'sub_category_id'
        ]);

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
        ]);

        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id'
        ]);

        $this->belongsTo('States', [
            'foreignKey' => 'state_id'
        ]);

        $this->hasMany('Favourites', [
            'foreignKey' => 'listing_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        $this->addBehavior('Proffer.Proffer', [
            'banner' => [
                'dir' => 'banner_dir',
                'thumbnailSizes' => [
                    'proper' => [
                        'w' => 640,
                        'h' => 480,
                        'crop' => true,
                        'jpeg_quality' => 90
                    ],
                ],
            ],
            'image' => [
                'dir' => 'image_dir',
                'thumbnailSizes' => [
                    'proper' => [
                        'w' => 640,
                        'h' => 480,
                        'crop' => true,
                        'jpeg_quality' => 90
                    ],
                ],
            ],
            'image_1' => [
                'dir' => 'image_1_dir',
                'thumbnailSizes' => [
                    'proper' => [
                        'w' => 640,
                        'h' => 480,
                        'crop' => true,
                        'jpeg_quality' => 90
                    ],
                ],
            ],
            'image_2' => [
                'dir' => 'image_2_dir',
                'thumbnailSizes' => [
                    'proper' => [
                        'w' => 640,
                        'h' => 480,
                        'crop' => true,
                        'jpeg_quality' => 90
                    ],
                ],
            ],
            'image_3' => [
                'dir' => 'image_3_dir',
                'thumbnailSizes' => [
                    'proper' => [
                        'w' => 640,
                        'h' => 480,
                        'crop' => true,
                        'jpeg_quality' => 100
                    ]
                ],
            ],
            'image_4' => [
                'dir' => 'image_4_dir',
                'thumbnailSizes' => [
                    'proper' => [
                        'w' => 640,
                        'h' => 480,
                        'crop' => true,
                        'jpeg_quality' => 100
                    ],
                    'portrait' => [
                        'w' => 200,
                        'h' => 350,
                        'crop' => true,
                        'jpeg_quality' => 100
                    ]

                ],
            ],
        ]);

        $this->hasMany('Comments', [
            'foreignKey' => 'listing_id',
            'sort' => ['Comments.id'=>'DESC'],
        ]);

        /*$this->addBehavior('Seipkon.DateFormat', [
			'fields' => ['joining_date','leaving_date']
		]);*/

		/*$this->hasMany('Accessories', [
			'foreignKey' => 'accessory_categories_id',
			'joinType' => 'INNER'
		]);*/

	}

	public function validationDefault(Validator $validator) {
        $validator
            ->maxLength('listing_title', 70)
            ->notEmptyString('listing_title', 'You need to provide a title');

        $validator
            ->requirePresence('banner', 'create')
            ->allowEmpty('banner', 'update')
            ->add('banner', [
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
                ],

            ]);

        $validator
            ->allowEmpty('image', 'update')
            ->add('image', [
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

        $validator
            ->allowEmpty('image_1', 'update')
            ->add('image_1', [
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

        $validator
            ->allowEmpty('image_2', 'update')
            ->add('image_2', [
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
        $validator
            ->allowEmpty('image_3', 'update')
            ->add('image_3', [
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
        $validator
            ->allowEmpty('image_4', 'update')
            ->add('image_4', [
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


        $validator
            ->notEmpty('address');

        $validator
            ->notEmpty('category_id');

        $validator
            ->notEmpty('city_id');

        $validator
            ->notEmpty('state_id');

        $validator
            ->notEmpty('country_id');

        $validator
            ->notEmpty('hourly_rate');

        $validator
            ->regex('google_location', '/^<iframe src="https:.*$/', 'Please Enter valid Location link');


        $validator
            ->notEmpty('email')
            ->add('email', 'validFormat', [
                'rule' => 'email',
                'message' => 'E-mail must be valid'
            ]);

        $validator
            ->scalar('mobile')
            ->notEmpty('mobile')
            ->maxLength('mobile', 10)
            ->regex('mobile', '/^([1-9]){1}([0-9]){9}?$/', 'Please Enter valide Mobile Number');

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
                'field' => ['email', 'listing_title', 'address', 'Categories.category']
            ]
        );
        return $searchManager;
    }

}
