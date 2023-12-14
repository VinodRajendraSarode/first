<?php
namespace Neptune\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;

class DateFormatBehavior extends Behavior
{

	public function beforeSave(Event $event,  EntityInterface $entity)
    {
		$fields = $this->config()['fields'];
		foreach($fields as $field) {
			if(!empty($entity[$field])) {
				$date = date_create_from_format('d/m/Y', $entity[$field]);
				$entity[$field] = $date->format('Y-m-d');
			}
		}
    }
}
