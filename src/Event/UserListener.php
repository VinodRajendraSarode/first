<?php
namespace App\Event;

use Cake\Log\Log;
use Cake\Event\EventListenerInterface;

class UserListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Model.User.afterUserCreate' => 'userCreate',
        );
    }

    public function userCreate($event,  $entity, $options) {
         Log::write(
            'info',
            'A new post was published with id: ' . $event->data['id']
        );
    }
}
