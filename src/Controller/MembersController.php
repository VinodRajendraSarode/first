<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\Utility\Hash;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\Mailer\Email;

class MembersController extends AppController
{

	public function initialize() {
		parent::initialize();
		$this->Auth->allow(['register','resetPassword','forgot','logout','login', 'buy']);
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('account');
        if ($this->request->is('post')) {
			$user = $this->Auth->identify();

			if ($user) {
                $this->Auth->setUser($user);

                $origin = $this->request->getData('origin');

               

                if(empty($origin)){
                    return $this->redirect($this->referer());
                } else  if($origin == 'https://listly.sanmishatech.com/account/login'){
                    return $this->redirect([
                        'controller' => 'Listings',
                        'action' => 'index',
                      ]);
                }  else  if($origin == 'https://listly.sanmishatech.com/members/login/'){
                    return $this->redirect([
                        'controller' => 'Listings',
                        'action' => 'index',
                      ]);
                } else  if($origin == 'https://listly.sanmishatech.com/members/login'){
                    return $this->redirect([
                        'controller' => 'Listings',
                        'action' => 'index',
                      ]);
                }


                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Listings',
                    'action' => 'index',
                  ]);

                $this->response = $this->response->withLocation($origin);
                return $this->redirect($redirect);
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function logout()
    {
        $session = $this->getRequest()->getSession();
        $session->destroy();
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
	}

    public function register()
    {
        $this->viewBuilder()->setLayout('account');
        $Users = TableRegistry::get('Users');
        $Users->hasOne('Subscriptions', ['foreignKey' => 'id']);

        
        $users = $Users->newEntity();
 		
        if ($this->request->is(['patch', 'post', 'put'])) {            
            $Packages = TableRegistry::get('Packages');
            $packages = $Packages->get(1);

            $this->request->data['password'] = 'abcd123';

            $this->request->data['active'] = false;
            $this->request->data['subscription']['package_id'] = 1;           
            $this->request->data['subscription']['registration_date'] = date("Y-m-d");
            $this->request->data['subscription']['expiry_date'] = date("Y-m-d",strtotime("+".$packages['period']." month"));
            $this->request->data['subscription']['no_of_listings'] = $packages['no_of_listings'];
            $this->request->data['subscription']['active'] = $packages['active'];
            $this->request->data['roles']['_ids'][] = 2;

            if ($Users->save2($this->request->getData(), $users)) {

                $this->viewBuilder()->layout('account');
                if (!empty($users))  {

                    $User = TableRegistry::get('Users');
                    $user = $User->find('all',['conditions'=>['Users.email'=>$users->email]])->first();

                if (!empty($user)) {
                        $user->activation_key = Security::hash('xyz914@', 'sha1', true);
                        $User->save($user);
                        $reset_token_link = Router::url(['controller' => 'Members', 'action' => 'resetPassword'], true) . '/' . $user->email . '/' . $user->activation_key;
                        $email = new Email();
                        $email
                            ->template('Welcome', 'default')
                            ->subject('Create Password')
                            ->emailFormat('html')
                            ->to($user->email)
                            ->viewVars(compact('user','reset_token_link'))
                            ->send();

                            $this->Flash->success('Please click on create password link, sent in your email address to create password.');
                            return $this->redirect(['action' => 'login']);

                    } else {
                        $this->Flash->error('Sorry! Unable to find your email.');
                    }
                }
            }
        }
        $this->set(compact('users'));
    }



	public function forgot() {
        $this->viewBuilder()->setLayout('account');

		if ($this->request->is('post')) {
    		if (!empty($this->request->data))  {
                $email = $this->request->data['email'];

                $User = TableRegistry::get('Users');
				$user = $User->find('all',['conditions'=>['Users.email'=>$email]])->first();

                if (!empty($user)) {
                    $user->activation_key = Security::hash('xyz914@', 'sha1', true);
                    $User->save($user);

                    $reset_token_link = Router::url(['controller' => 'Members', 'action' => 'resetPassword'], true) . '/' . $user->email . '/' . $user->activation_key;

                    $email = new Email();
                    $email
						->template('forgot', 'default')
						->subject('Reset Password')
						->emailFormat('html')
						->to($user->email)
						->viewVars(compact('user','reset_token_link'))
                        ->send();

					$this->Flash->success('Please click on password reset link, sent in your email address to reset password.');
				} else {
					$this->Flash->error('Sorry! Unable to find your email.');
				}

			}
        }
    }

    public function resetPassword($email, $activationKey) {
        $this->set('title_for_layout', 'Reset Password');
        $this->viewBuilder()->layout('account');
        $User = TableRegistry::get('Users');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $User->get($this->request->data['id']);
            $user = $User->patchEntity($user, $this->request->getData());

            if ($User->save($user)) {
                $this->Flash->success(__('The Password has been reset.'));
                $this->Flash->success(__('Account will be active soon.'));
                return $this->redirect(['controller'=>'Account', 'action' => 'login']);
            } else {
                $this->Flash->error(__('The Password could not be reset. Please, try again.'));
            }
        } else {
            $user = $User->find()->where([
                'email'=>$email,
                'activation_key'=>$activationKey
            ])->first();

            if(!$user) {
			    $this->Flash->error('Unable to find User. Please try again');
                return $this->redirect(['controller'=>'Account','action'=>'login']);
            } else {
                $user->password = "";
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
	}

    
	public function buy($id){		
        $Packages = TableRegistry::get('Packages');	
		$packages = $Packages->get($id);
       
		
        $Subscriptions = TableRegistry::get('Subscriptions');	
		$subscription = $Subscriptions->find('all')->where(['id'=>$this->Auth->user('id')])->first();
       


		if(empty($subscription)){
			$subscription = $Subscriptions->newEntity();
		
		}        
		
		$subscription->id = $this->Auth->user('id'); 
		$subscription->package_id = $id; 
		$subscription->registration_date = date("d/m/Y");
		$subscription->expiry_date = date("d/m/Y",strtotime("+".$packages['period']." month"));
		$subscription->no_of_listings  = $packages['no_of_listings'];
		$subscription->active = false;	

			
        
		if ($Subscriptions->save($subscription)) {  
			$this->Flash->success(__('The Packages  has been added. Wait For Activation'));
			return $this->redirect(['controller'=>'Listings', 'action' => 'myListings']);
		} else {
			$this->Flash->error(__(' Please, try again.'));
			return $this->redirect(['controller'=>'Listings', 'action' => 'myListings']);
		}
		
	}
}
