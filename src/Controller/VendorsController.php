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

class VendorsController extends AppController
{

	public function initialize() {
		parent::initialize();
		$this->Auth->allow(['login','logout','register','createPassword','forgot','resetPassword','changePassword']);
    }

    public function login() {
        $this->viewBuilder()->setLayout('account');

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['controller'=>'Listings','action'=>'myListings']);
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function logout() {

        $session = $this->getRequest()->getSession();
        $session->destroy();

        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    public function register($packageId = null) {

        $this->viewBuilder()->setLayout('account');
        $Users = TableRegistry::get('Users');
		$Users->hasOne('Vendors', ['foreignKey' => 'id']);
        $Users->hasOne('Subscriptions', ['foreignKey' => 'id']);

        if(empty($id)) {
            $users = $Users->newEntity();
            $this->set(compact('users'));
 		}

        if ($this->request->is(['patch', 'post', 'put'])) {

            $Packages = TableRegistry::get('Packages');
            $packages = $Packages->get($this->request->data['vendor']['package_id']);

            $this->request->data['active'] = false;
            $this->request->data['subscription']['package_id'] = $this->request->data['vendor']['package_id'];
            $this->request->data['subscription']['registration_date'] = date("Y-m-d");
            $this->request->data['subscription']['expiry_date'] = date("Y-m-d",strtotime("+".$packages['period']." month"));
            $this->request->data['subscription']['no_of_listings'] = $packages['no_of_listings'];
            $this->request->data['subscription']['active'] = $packages['active'];
            $this->request->data['roles']['_ids'][] = 2;

            if ($this->Vendors->save2($this->request->getData(), $users)) {
                $this->viewBuilder()->layout('account');
                if (!empty($users))  {
                    $User = TableRegistry::get('Users');
                    $user = $User->find('all',['conditions'=>['Users.email'=>$users->email]])->first();
                if (!empty($user)) {
                        $user->activation_key = Security::hash('xyz914@', 'sha1', true);
                        $User->save($user);
                        $reset_token_link = Router::url(['controller' => 'Vendors', 'action' => 'createPassword'], true) . '/' . $user->email . '/' . $user->activation_key;
                        $email = new Email();
                        $email
                            ->template('Welcome', 'default')
                            ->subject('Create Password')
                            ->emailFormat('html')
                            ->to($user->email)
                            ->viewVars(compact('user','reset_token_link'))
                            ->send();

                            $this->Flash->success('Please click on create password link, sent in your email address to create password.');
                            return $this->redirect(['controller'=>'Vendors','action' => 'login']);

                    } else {
                        $this->Flash->error('Sorry! Unable to find your email.');
                    }
                }
            }
        } else {
            $this->request->data['vendor']['package_id'] = $packageId;
        }
        $this->set(compact('users'));
    }

    public function createPassword($email, $activationKey) {
        $this->set('title_for_layout', 'Create Password');
        $this->viewBuilder()->layout('account');
        $User = TableRegistry::get('Users');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $User->get($this->request->data['id']);
            $user['active'] = true;
            $user = $User->patchEntity($user, $this->request->getData());
            if ($User->save($user)) {
                $this->Flash->success(__('The Password has been create.'));
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('The Password could not be create. Please, try again.'));
            }
        } else {
            $user = $User->find()->where([
                'email'=>$email,
                'activation_key'=>$activationKey
            ])->first();

            if(!$user) {
			    $this->Flash->error('Unable to find User. Please try again');
                return $this->redirect(['controller'=>'Vendors','action'=>'login']);
            } else {
                $user->password = "";
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
	}

	public function forgot() {

		$this->viewBuilder()->layout('account');
		if ($this->request->is('post')) {
        	if (!empty($this->request->data))  {
                $email = $this->request->data['email'];

                $User = TableRegistry::get('Users');
				$user = $User->find('all',['conditions'=>['Users.email'=>$email]])->first();

                if (!empty($user)) {
                    $user->activation_key = Security::hash('xyz914@', 'sha1', true);

                    $reset_token_link = Router::url(['controller' => 'Vendors', 'action' => 'resetPassword'], true) . '/' . $user->email . '/' . $user->activation_key;
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
                return $this->redirect(['action' => 'login']);
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
                return $this->redirect(['controller'=>'Vendors','action'=>'login']);
            } else {
                $user->password = "";
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
	}

    public function changePassword() {
		$this->viewBuilder()->layout('account');
		$this->set('title_for_layout', 'Change Password');
        $User = TableRegistry::get('Users');
        $user = $User->get($this->Auth->user('id'));
        if (!empty($this->request->data)) {
            $user->force_change_password = false;
            $user = $User->patchEntity($user, $this->request->getData());
            if ($User->save($user)) {
			    $this->Flash->success('The password is successfully changed');
                return $this->redirect(['controller'=>'Vendors','action'=>'logout']);
            } else {
                $this->Flash->error('There was an error during the save!');
            }
        }
		$this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

}
