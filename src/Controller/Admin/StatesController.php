<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class StatesController extends AppController
{
	public function initialize() {	
		parent::initialize();
		 $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
	}
	
	public function index()
	{
		$this->set('title_for_layout', 'States');
		$query = $this->States
        ->find('search', ['search' => $this->request->getQueryParams()]);
        //->where(['Rooms.hospital_id' =>$this->Auth->user('team.hospital_id')]);
		$this->paginate = ['contain'=>['Countries'],'order'=>['id'=>'DESC']];
		$this->set('states', $this->paginate($query));
        $this->set('_serialize', ['states']);   		
	}
	
	public function edit($id=null)
	{
		
		if(empty($id)) {
			$states=$this->States->newEntity();
			$this->set('title_for_layout', 'States');
		}
		else {
			$states=$this->States->get($id);
			$this->set('title_for_layout', 'States');
			
		}
		if($this->request->is(['patch','post','put'])) {
			
			$this->request->data['depot_id']=$this->Auth->user('team.depot_id');
			$states=$this->States->patchEntity($states,$this->request->getData());	
			if($this->States->save($states)) {
				$this->Flash->success('The States has been saved');
				return $this->redirect(['action'=>'index']);
			}
			else {
				$this->Flash->error('The States could not be saved try again');
			}
		}
		
		$Country = TableRegistry::get('Countries');
		$countries = $Country->find('list');

		$this->set(compact('states','countries'));
	}
	public function delete($id=null) {
		$this->request->allowMethod(['post','delete']);
		$states=$this->States->get($id);
		if($this->States->delete($states)) {
			$this->Flash->success('The States has been deleted');
		}
		else {
			$this->Flash->error('The States could not be deleted try again');
		}
		return $this->redirect(['action'=>'index']);
	}	
	
	
}



