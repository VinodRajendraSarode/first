<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class PackagesController extends AppController
{
	public function initialize() {	
		parent::initialize();
		 $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
	}



	public function index()
	{
		$this->set('title_for_layout', 'Packages');
		$query = $this->Packages
        ->find('search', ['search' => $this->request->getQueryParams()]);
       	$this->paginate = ['order'=>['id'=>'DESC']];
		$this->set('packages', $this->paginate($query));
        $this->set('_serialize', ['packages']);   		
	}
	
	public function edit($id=null)
	{
		$this->set('title_for_layout', 'Packages');
		if(empty($id)) {
			$packages=$this->Packages->newEntity();
			$this->set('title','Add Packages');	
		}
		else {
			$packages=$this->Packages->get($id);
			$this->set('title','Edit Packages');
			
		}
		if($this->request->is(['patch','post','put'])) {
			$data = $this->request->getData();			
			if(!empty($data['no_of_listings'])){
				$data['no_of_listings'] = $data['no_of_listings'] + 1;
			}
			if(!empty($data['period'])){
				$data['period'] = $data['period'] + 1;
			}		
			$packages=$this->Packages->patchEntity($packages, $data);	
			
			if($this->Packages->save($packages)) {
				$this->Flash->success('The Packages has been saved');
				return $this->redirect(['action'=>'index']);
			}
			else {
				$this->Flash->error('The Packages could not be saved try again');
			}
		}
		
		$this->set(compact('packages'));
	}
	public function delete($id=null) {
		$this->request->allowMethod(['post','delete']);
		$packages=$this->Packages->get($id);
		if($this->Packages->delete($packages)) {
			$this->Flash->success('The Packages has been deleted');
		}
		else {
			$this->Flash->error('The Packages could not be deleted try again');
		}
		return $this->redirect(['action'=>'index']);
	}	
}



