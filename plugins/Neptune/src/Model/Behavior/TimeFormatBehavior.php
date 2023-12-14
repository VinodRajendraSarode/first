<?php
namespace Neptune\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\I18n\Time;

class TimeFormatBehavior extends Behavior
{

	public function beforeSave(Event $event,  EntityInterface $entity)
    {
		$fields = $this->config()['fields'];	
		foreach($fields as $field) {
			if(!empty($entity[$field]) && is_string($entity[$field])) {				
				$entity[$field] = Time::createFromFormat("h:i a", $entity[$field]);
			}
		}
	}
}
