<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class CommentsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('comments');
        $this->addBehavior('Timestamp');

		$this->belongsTo('Users');

        $this->belongsTo('Listings')
            ->setForeignKey('listing_id');          
    }
}
