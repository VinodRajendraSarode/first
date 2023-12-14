<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class MessagesTable extends Table
{
   
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('messages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Footprint.Footprint');
        $this->addBehavior('Neptune.DateFormat', [
			'fields' => ['message_date', 'from_date', 'to_date']
		]);

        $this->belongsTo('Users', [
            'foreignKey' => 'sender_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'receiver_id',
        ]);
    }

 
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

      

     
      

      

        return $validator;
    }

  
  
}
