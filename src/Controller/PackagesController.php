<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\Utility\Hash;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\Mailer\Email;

class PackagesController extends AppController
{

	public function initialize() {	
		parent::initialize();
		$this->Auth->allow(['buy']);
    }
    
    public function buy(){
		$this->viewBuilder()->setLayout('package');
		$this->set('title_for_layout', 'Packages');
        $Packages = TableRegistry::get('Packages');			
		$packages = $Packages->find('all')
			->find('search', ['search' => $this->request->getQueryParams()]);
			//->where(['Packages.id' =>$this->Auth->user('id')]);	
		$this->set(compact('packages'));
	}


}
