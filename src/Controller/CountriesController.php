<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class CountriesController extends AppController
{
	public function initialize() {	
		parent::initialize();
		$this->Auth->allow(['index', 'edit','delete', 'getCountry']);
	}
	
	public function index(){
		$this->set('title_for_layout', 'Country');
		$query = $this->Countries
        ->find('search', ['search' => $this->request->getQueryParams()]);
        
		$this->paginate = ['order'=>['list_order'=>'DESC']];
		$this->set('countries', $this->paginate($query));
        $this->set('_serialize', ['countries']);   		
	}


	public function edit($id=null)
	{
		$this->set('title_for_layout', 'Country');
		if(empty($id)) {
			$countries=$this->Countries->newEntity();
			$this->set('title','Add Countries');	
		}
		else {
			$countries=$this->Countries->get($id);
			$this->set('title','Edit Countries');
			
		}
		if($this->request->is(['patch','post','put'])) {
			
			$this->request->data['depot_id']=$this->Auth->user('team.depot_id');
			$countries=$this->Countries->patchEntity($countries,$this->request->getData());	
			if($this->Countries->save($countries)) {
				$this->Flash->success('The Countries has been saved');
				return $this->redirect(['action'=>'index']);
			}
			else {
				$this->Flash->error('The Countries could not be saved try again');
			}
		}
		$this->set(compact('countries'));
	}
	public function delete($id=null) {
		$this->request->allowMethod(['post','delete']);
		$countries=$this->Countries->get($id);
		if($this->Countries->delete($countries)) {
			$this->Flash->success('The Countries has been deleted');
		}
		else {
			$this->Flash->error('The Countries could not be deleted try again');
		}
		return $this->redirect(['action'=>'index']);
	}	


	
}



