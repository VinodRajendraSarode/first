<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class SubCategoriesController extends AppController
{
	public function initialize() {	
		parent::initialize();
		 $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
	}
	
	public function index(){
		$this->set('title_for_layout', 'Sub Categories');
		$query = $this->SubCategories
        ->find('search', ['search' => $this->request->getQueryParams()]);
        
		$this->paginate = ['contain'=>['Categories'],'order'=>['list_order'=>'DESC']];
		$this->set('subCategories', $this->paginate($query));
        $this->set('_serialize', ['subCategories']);   		
	}
	
	public function edit($id=null){
		$this->set('title_for_layout', 'SubCategories');
		if(empty($id)) {
			$subCategories=$this->SubCategories->newEntity();
			$this->set('title','Add Sub Categories');	
		}else {
			$subCategories=$this->SubCategories->get($id);
			$this->set('title','Edit SubCategories');
			
		}
		if($this->request->is(['patch','post','put'])) {
			$subCategories=$this->SubCategories->patchEntity($subCategories,$this->request->getData());	
			
			if($this->SubCategories->save($subCategories)) {
				
				$this->Flash->success('The SubCategories has been saved');
				return $this->redirect(['action'=>'index']);
			}else {
				$this->Flash->error('The SubCategories could not be saved try again');
			}
		}
		
		$Categories = TableRegistry::get('Categories');
		$categories = $Categories->find('list');
		
		$this->set(compact('subCategories','categories'));
	}
	public function delete($id=null) {
		$this->request->allowMethod(['post','delete']);
		
		$subCategories=$this->SubCategories->get($id);
		if($this->SubCategories->delete($subCategories)) {
			$this->Flash->success('The SubCategories has been deleted');
		}else {
			$this->Flash->error('The SubCategories could not be deleted try again');
		}
		return $this->redirect(['action'=>'index']);
	}	

	
}



