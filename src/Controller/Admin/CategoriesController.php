<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class CategoriesController extends AppController
{
	public function initialize() {	
		parent::initialize();
		 $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
	}
	
	public function index(){
		$this->set('title_for_layout', 'Categories');
		$query = $this->Categories
        ->find('search', ['search' => $this->request->getQueryParams()]);
        
		$this->paginate = ['order'=>['list_order'=>'DESC']];
		$this->set('categories', $this->paginate($query));
        $this->set('_serialize', ['categories']);   		
	}
	
	public function edit($id=null){
		$this->set('title_for_layout', 'Categories');
		if(empty($id)) {
			$categories=$this->Categories->newEntity();
			$this->set('title','Add Categories');	
		}else {
			$categories=$this->Categories->get($id);
			$this->set('title','Edit Categories');
			
		}
		if($this->request->is(['patch','post','put'])) {
			$categories=$this->Categories->patchEntity($categories,$this->request->getData());	
			
			if($this->Categories->save($categories)) {
				
				$this->Flash->success('The Categories has been saved');
				return $this->redirect(['action'=>'index']);
			}else {
				$this->Flash->error('The Categories could not be saved try again');
			}
		}
		
		
		
		$this->set(compact('categories'));
	}

	public function delete($id=null) {
		$this->request->allowMethod(['post','delete']);
		
		$categories=$this->Categories->get($id);
		if($this->Categories->delete($categories)) {
			$this->Flash->success('The Categories has been deleted');
		}else {
			$this->Flash->error('The Categories could not be deleted try again');
		}
		return $this->redirect(['action'=>'index']);
	}	
	
	public function getCategory($id=null) {
		
		$Category = TableRegistry::get('Categories');
		$categories=$Category->get($id,['contain' => ['SubCategories']]);
		$this->set('categories', $categories);
		$this->set('_serialize', ['categories']);
	}
}



