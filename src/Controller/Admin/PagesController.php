<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class PagesController extends AppController
{
	public function initialize() {	
		parent::initialize();
		 $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
	}
	
	public function index()
	{
		$this->set('title_for_layout', 'Pages ');
		$query = $this->Pages
			->find('search', ['search' => $this->request->getQueryParams()])
			->order(['Pages.lft'=>'ASC'])
			->contain(['Parent']);

		$this->set('pages', $this->paginate($query));
        $this->set('_serialize', ['pages']);   		
	}
	
	public function edit($id=null)
	{
		if(empty($id)) {
			$pages=$this->Pages->newEntity();
			$this->set('title_for_layout', 'Add Pages ');
		} else {
			$pages=$this->Pages->get($id, ['contain'=>'Sections']);
			$this->set('title_for_layout', 'Edit Pages ');
		}
		if($this->request->is(['patch','post','put'])) {
			
			$pages=$this->Pages->patchEntity($pages,$this->request->getData());	
			if($this->Pages->save($pages)) {
				$this->Flash->success('The Pages has been saved');
				return $this->redirect(['action'=>'index']);
			}
			else {
				$this->Flash->error('The Pages could not be saved try again');
			}
		}

		if($pages->isNew()) {
			$parents = $this->Pages->find('treeList', ['spacer'=>'--']);
		} else {
			$parents = $this->Pages->find('treeList', ['spacer'=>'--'])->where(['Pages.id !='=>$id]);
		}
		
		$this->set(compact('pages', 'parents'));
	}

	public function delete($id=null) {
		$this->request->allowMethod(['post','delete']);
		$pages=$this->Pages->get($id);
		if($this->Pages->delete($pages)) {
			$this->Flash->success('The Pages has been deleted');
		}
		else {
			$this->Flash->error('The Pages could not be deleted try again');
		}
		return $this->redirect(['action'=>'index']);
	}	
}



