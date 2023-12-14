<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class FavouritesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('favourites');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Muffin/Footprint.Footprint');
		$this->addBehavior('Search.Search');
        $this->addBehavior('Timestamp');
        
		$this->belongsTo('Listings', [
            'foreignKey' => 'listing_id'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
    }


}
