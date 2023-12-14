<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class SectionsController extends AppController
{
	public function initialize() {	
		parent::initialize();
		 $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
	}
	
	public function index()
	{
		$this->set('title_for_layout', 'Sections');
		$query = $this->Sections
        ->find('search', ['search' => $this->request->getQueryParams()])
        ->where(['Sections.page_id IS NULL']);
        
		$this->paginate = ['order'=>['id'=>'DESC']];
		$this->set('sections', $this->paginate($query));
        $this->set('_serialize', ['sections']);   		
	}
	
	public function edit($id=null,$pageId=null)
	{
		if(empty($id)) {
			$sections=$this->Sections->newEntity();
			$this->set('title_for_layout', 'Add Sections');
		}
		else {
			$sections=$this->Sections->get($id);
			$this->set('title_for_layout', 'Edit Sections');
		}
		if($this->request->is(['patch','post','put'])) {
			
			$this->request->data['page_id']=$pageId;
			$sections=$this->Sections->patchEntity($sections,$this->request->getData());	
			if($this->Sections->save($sections)) {
				$this->Flash->success('The Section has been saved');
				return $this->redirect(['controller'=>'Sections','action'=>'index']);
			}
			else {
				$this->Flash->error('The Section could not be saved try again');
			}
		}
		
		$page = TableRegistry::get('Pages');
		$pageLists = $page->find('list');
		
		$this->set(compact('sections','pageLists'));
	}
	public function delete($id=null) {
		
		//$this->request->allowMethod(['post','delete']);
		$sections=$this->Sections->get($id);
		if($this->Sections->delete($sections)) {
			$this->Flash->success('The Section has been deleted');
		}
		else {
			$this->Flash->error('The Section could not be deleted try again');
		}
		return $this->redirect(['controller'=>'Pages','action'=>'index']);
	}	
}



