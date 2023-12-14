<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\Utility\Hash;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\Mailer\Email;

class MembersController extends AppController
{

	public function initialize() {
		parent::initialize();
        $this->loadComponent('Search.Prg', [
			'actions' => ['index']
        ]);
    }

    public function index(){
        $this->set('title_for_layout', 'Members Details');
        $Users = TableRegistry::get('Users');
		$query = $Users
            ->find('search', ['search' => $this->request->getQueryParams()])->contain(['Roles']);
        $this->set('users', $this->paginate($query));
        $this->set('_serialize', ['users']);  
    }

    public function addVendor($id){
        
        $Users = TableRegistry::get('Users');
		$user = $Users->get($id);
		$user->is_vendor = true;
		if($Users->save($user)) {
			$this->Flash->success('The Member changed to Vendor');
			return $this->redirect(['action'=>'index']);
		}else {
			$this->Flash->error('The member could not be change to vendor try again');
		}
	}

	public function removeVendor($id){
	
        $Users = TableRegistry::get('Users');	
		$user = $Users->get($id);
		$user->is_vendor = false;
		if($Users->save($user)) {
			$this->Flash->success('The vendor has been changed to member');
			return $this->redirect(['action'=>'index']);
		}else {
			$this->Flash->error('The vendor could not be change to member');
		}
	}
    
	
}
