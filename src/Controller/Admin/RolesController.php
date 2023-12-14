<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class RolesController extends AppController
{
	public function initialize() {	
		parent::initialize();
		 $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
	}
	
	public function index()	{
		$this->set('title_for_layout', 'Roles');
     
		$query = $this->Roles
		
        ->find('search', ['search' => $this->request->getQueryParams()]);
        $this->paginate = ['order'=>['id'=>'DESC']];
        
		$this->set('roles', $this->paginate($query));
        $this->set('_serialize', ['roles']);   		
	}

	public function edit($id=null) {
		if(empty($id)) {
			$role=$this->Roles->newEntity();
			$this->set('title_for_layout','Add Role');	
		
		} else {
			$role=$this->Roles->get($id);
			$this->set('title_for_layout','Edit Role');			
		}

		if($this->request->is(['patch','post','put'])) {						
			$role = $this->Roles->patchEntity($role, $this->request->getData());
			
			if($this->Roles->save($role)) {
				$this->Flash->success('The Role has been saved');
				return $this->redirect(['action'=>'index']);
			}
		}
		$this->set(compact('role'));
	}

	public function delete($id=null) {
		$this->request->allowMethod(['post','delete']);
		$roles=$this->Roles->get($id);
		if($this->Roles->delete($roles)) {
			$this->Flash->success('The Roles has been deleted');
		} else {
			$this->Flash->error('The Roles could not be deleted try again');
		}
		return $this->redirect(['action'=>'index']);
	}	
}



