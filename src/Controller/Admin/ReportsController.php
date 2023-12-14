<?php
namespace App\Controller\Admin;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Utility\Hash;

class ReportsController extends AppController {

	public function SubscriptionReport() {	
	
		$this->set('title_for_layout', 'Subscription Report');

		$Users = TableRegistry::get('users');
		$users = $Users->find('list');
	
		$Packages = TableRegistry::get('Packages');
		$packages = $Packages->find('list');

		$this->set(compact('packages','users'));
		

		if ($this->request->is(['patch', 'post', 'put'])) {
			
			$conditions = [];
			if(!empty($this->request->data['from'])) {
				$fromDate=explode('/',$this->request->data['from']);
				$fromDate=$fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
				$conditions['Subscriptions.expiry_date >=']=$fromDate ;
				$fDate=$this->request->data['from'];
				$this->set(compact('fDate'));
			}
			if(!empty($this->request->data['to'])) {
				$toDate=explode('/',$this->request->data['to']);
				$toDate=$toDate[2].'-'.$toDate[1].'-'.$toDate[0];
				$conditions['Subscriptions.expiry_date <='] = $toDate;
				$tDate=$this->request->data['to'];
				$this->set(compact('tDate'));
			}

			if(!empty($this->request->data['user_id'])) {
				$conditions['Subscriptions.user_id ='] = $this->request->data['user_id'];
			}

			if(!empty($this->request->data['package_id'])) {
				$conditions['Subscriptions.package_id ='] = $this->request->data['package_id'];
			}
			
		
			

			$Subscription = TableRegistry::get('Subscriptions');
			$subscriptions = $Subscription->find('all',[
				'conditions' => $conditions,
				'contain'=>['Packages','Users'=>['Listings']]				
			]); 

			// debug($subscriptions->toArray()); exit;
			

			$this->set(compact('subscriptions'));

			$this->viewBuilder()->setLayout('pdf');
			$html = $this->render('subscription_report_pdf');	
		}
	}	
}
