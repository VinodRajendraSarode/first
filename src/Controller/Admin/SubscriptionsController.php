<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class SubscriptionsController extends AppController
{
	public function initialize() {	
		parent::initialize();
		 $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
	}
	
	public function index(){
		$this->set('title_for_layout', 'Subscriptions');

		$query = $this->Subscriptions
			->find('search', ['search' => $this->request->getQueryParams()]);

		if(!empty($this->request->getQueryParams()['from_expiry_date']) && !empty($this->request->getQueryParams()['to_expiry_date']) ){
			
			$fromExpiryDate=explode('/',$this->request->getQueryParams()['from_expiry_date']);
			$toExpiryDate=explode('/',$this->request->getQueryParams()['to_expiry_date']);
			$fromDate=str_replace(' ', '', $fromExpiryDate[2].'-'.$fromExpiryDate[1].'-'.$fromExpiryDate[0]);
			$toDate=str_replace(' ', '',$toExpiryDate[2].'-'.$toExpiryDate[1].'-'.$toExpiryDate[0]);

			$query = $this->Subscriptions
			->find('search', ['search' => $this->request->getQueryParams()])
			->where(['Subscriptions.expiry_date >=' => $fromDate,'Subscriptions.expiry_date <=' =>$toDate]);
		}
		
		$this->paginate = ['contain'=>['Packages','Users'],'order'=>['id'=>'DESC']];

		$this->set('subscriptions', $this->paginate($query));
        $this->set('_serialize', ['subscriptions']);   		
		$this->render('index');
	}

	public function activate($id){
	
		$subscriptions = $this->Subscriptions->get($id);
		$subscriptions->active = true;
		if($this->Subscriptions->save($subscriptions)) {
			$this->Flash->success('The Subscriptions has been Activate');
			return $this->redirect(['action'=>'index']);
		}else {
			$this->Flash->error('The Subscriptions could not be Activate try again');
		}
	}

	public function deactivate($id){
	
		$subscriptions = $this->Subscriptions->get($id);
		$subscriptions->active = false;
		if($this->Subscriptions->save($subscriptions)) {
			$this->Flash->success('The Subscriptions has been Deactivate');
			return $this->redirect(['action'=>'index']);
		}else {
			$this->Flash->error('The Subscriptions could not be Deactivate try again');
		}
	}

}



