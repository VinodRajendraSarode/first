<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class CitiesController extends AppController
{
	public function initialize() {	
		parent::initialize();
		 $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
	}
	
	public function index()
	{
		$this->set('title_for_layout', 'Cities');
		$query = $this->Cities
        ->find('search', ['search' => $this->request->getQueryParams()]);
        //->where(['Rooms.hospital_id' =>$this->Auth->user('team.hospital_id')]);
		$this->paginate = ['contain'=>['Countries','States'],'order'=>['id'=>'DESC']];
		$this->set('cities', $this->paginate($query));
        $this->set('_serialize', ['cities']);   		
	}
	
	public function edit($id=null)
	{
		$this->set('title_for_layout', 'Cities');
		if(empty($id)) {
			$cities=$this->Cities->newEntity();
			$this->set('title','Add Cities');	
		}
		else {
			$cities=$this->Cities->get($id,['contain'=>['States','Countries']]);
			$this->set('title','Edit Cities');
			
		}
		if($this->request->is(['patch','post','put'])) {
			
			$cities=$this->Cities->patchEntity($cities,$this->request->getData());	
			if($this->Cities->save($cities)) {
				$this->Flash->success('The Cities has been saved');
				return $this->redirect(['action'=>'index']);
			}
			else {
				$this->Flash->error('The Cities could not be saved try again');
			}
		}
		
		$Country = TableRegistry::get('Countries');
		$countries = $Country->find('list');
		
		$this->set(compact('cities','countries'));
	}
	public function delete($id=null) {
		$this->request->allowMethod(['post','delete']);
		$cities=$this->Cities->get($id);
		if($this->Cities->delete($cities)) {
			$this->Flash->success('The Cities has been deleted');
		}
		else {
			$this->Flash->error('The Cities could not be deleted try again');
		}
		return $this->redirect(['action'=>'index']);
	}	
	public function getCities($id=null) {

		$City = TableRegistry::get('Cities');
		$cities = $City->find('list',['conditions'=>['Cities.state_id'=>$id]]);
	
		$this->set('cities', $cities);
		$this->set('_serialize', ['cities']);
	}
}



