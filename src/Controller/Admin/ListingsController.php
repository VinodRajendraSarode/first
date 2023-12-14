<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class ListingsController extends AppController
{
	public function initialize() {	
		parent::initialize();
		 $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
	}
	
	public function index(){
		$this->set('title_for_layout', 'Listing');
		$query = $this->Listings
        ->find('search', ['search' => $this->request->getQueryParams()]);
        
		$this->paginate = ['contain'=>['Categories','Cities','Countries','Users'],'order'=>['id'=>'DESC']];
		$this->set('listings', $this->paginate($query));
        $this->set('_serialize', ['listings']);   		
	}
	
	public function edit($id=null){
		$this->set('title_for_layout', 'Listing');
		
		if(empty($id)) {
			$listings=$this->Listings->newEntity();
			$this->set('title','Add Listings');	
		}else {
			$listings=$this->Listings->get($id,['contain'=>['Categories','SubCategories','Cities','Countries','States', 'Users']]);
			$this->set('title','Edit Listings');
		}
			
		if($this->request->is(['patch','post','put'])) {

			$data = $this->request->getData();
			$business = [
				$data['day_1'] => 
					($data['closed_1'] == "No") ? [
						$data['from_1'],
						$data['to_1'] ]
						: "Closed",
				
				$data['day_2'] => 
					($data['closed_2'] == "No") ? [
						$data['from_2'],
						$data['to_2'] ]
						: "Closed",
				
				$data['day_3'] => 
					($data['closed_3'] == "No") ? [
						$data['from_3'],
						$data['to_3'] ]
						: "Closed",
				
				$data['day_4'] => 
					($data['closed_4'] == "No") ? [
						$data['from_4'],
						$data['to_4'] ]
						: "Closed",
				
				$data['day_5'] => 
					($data['closed_5'] == "No") ? [
						$data['from_5'],
						$data['to_5'] ]
						: "Closed",
				
				$data['day_6'] =>
					($data['closed_6'] == "No") ? [
						$data['from_6'],
						$data['to_6'] ]
						: "Closed",

				$data['day_7'] => 
					($data['closed_7'] == "No") ? [
						$data['from_7'],
						$data['to_7'] ]
						: "Closed"
			];

			$data['business_hours'] = json_encode($business);
			
			$searchWidth = "/(width=\")(.*?)(\")/";
			$searchHeight = "/(height=\")(.*?)(\")/";
			$replaceWidth = 'width="100%"';
			$replaceHeight = 'height="400"';

			$location = preg_replace($searchWidth, $replaceWidth, $data['google_location']);
			$location = preg_replace($searchHeight, $replaceHeight, $location);

			$data['google_location'] = $location;



			$listings=$this->Listings->patchEntity($listings, $data);	
			if($this->Listings->save($listings)) {
				$this->Flash->success('The Listings has been saved');
				return $this->redirect(['action'=>'index']);
			}else {
				$this->Flash->error('The Listings could not be saved try again');
			}
		}
		
		$Users = TableRegistry::get('Users');
		$users = $Users->find('list');

		$Categories = TableRegistry::get('Categories');
		$categories = $Categories->find('list');

		$SubCategories = TableRegistry::get('SubCategories');
		$subCategories = $SubCategories->find('list');
		
		$Countries = TableRegistry::get('Countries');
		$countries = $Countries->find('list');
		
		$Cities = TableRegistry::get('Cities');
		$cities = $Cities->find('list');

		$this->set(compact('listings','users','categories','subCategories','countries','cities'));
	}

	public function delete($id=null) {
		$this->request->allowMethod(['post','delete']);
		
		$listings=$this->Listings->get($id);
		if($this->Listings->delete($listings)) {
			$this->Flash->success('The Listing has been deleted');
		}else {
			$this->Flash->error('The Listing could not be deleted try again');
		}
		return $this->redirect(['action'=>'index']);
	}	

	public function activate($id){
	
		$listings=$this->Listings->get($id);
		$listings->active = true;
		if($this->Listings->save($listings)) {
			$this->Flash->success('The Listings has been Activate');
			return $this->redirect(['action'=>'index']);
		}else {
			$this->Flash->error('The Listings could not be Activate try again');
		}
	}

	public function deactivate($id){
	
		$listings=$this->Listings->get($id);
		$listings->active = false;
		if($this->Listings->save($listings)) {
			$this->Flash->success('The Listings has been Deactivate');
			return $this->redirect(['action'=>'index']);
		}else {
			$this->Flash->error('The Listings could not be Deactivate try again');
		}
	}
}



