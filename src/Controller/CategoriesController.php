<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class CategoriesController extends AppController
{
	public function initialize() {	
		parent::initialize();
		$this->Auth->allow(['index', 'edit','delete', 'getCategory']);
	}
	
	public function index(){
		$this->set('title_for_layout', 'Categories');
		$query = $this->Categories
        ->find('search', ['search' => $this->request->getQueryParams()]);
        
		$this->paginate = ['contain'=>['Classifications'],'order'=>['list_order'=>'DESC']];
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
		
		$Classification = TableRegistry::get('Classifications');
		$classifications = $Classification->find('list');
		
		$this->set(compact('classifications','categories'));
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
	
	public function getCategory($id) {

		$SubCategories = TableRegistry::get('SubCategories');
		$subCategories=$SubCategories->find('list')->where(['category_id'=>$id]);
		$this->set('subCategories', $subCategories);
		$this->set('_serialize', ['subCategories']);
	}	

	
}



