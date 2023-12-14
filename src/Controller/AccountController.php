<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Text;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Mailer\Email;


/**
 * Account Controller
 *
 *
 * @method \App\Model\Entity\Account[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccountController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['login', 'logout','register','home','changePassword','forgot']);
    }

    public function login() {
        $this->viewBuilder()->setLayout('account');

       if ($this->request->is('post')) {
			$user = $this->Auth->identify();

			if ($user) {
                $this->Auth->setUser($user);
               
                return $this->redirect([
                    'controller' => 'Listings',
                    'action' => 'index',
                  ]);
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function oauth() {
        if ($this->request->is('post')) {
        }
    }


	public function logout() {
		$session = $this->getRequest()->getSession();
		$session->destroy();
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());

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
                    $User->save($user);

                    $reset_token_link = Router::url(['controller' => 'Account', 'action' => 'resetPassword'], true) . '/' . $user->email . '/' . $user->activation_key;
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
                return $this->redirect(['controller'=>'Account','action'=>'login']);
            } else {
                $user->password = "";
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
	}

}
