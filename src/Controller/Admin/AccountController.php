<?php
namespace App\Controller\Admin;

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

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['login', 'register', 'logout', 'resetPassword', 'forgot']);
    }

    public function index(){ 

    }

    public function login() {        


        //debug("Hello");exit;
        $this->viewBuilder()->setLayout('login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['controller'=>'Dashboard','action'=>'index']);
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

    public function register(){
        $this->viewBuilder()->layout('register');
        $Companies = TableRegistry::get('Companies');			
 
        if(empty($id)) {
            $companies = $Companies->newEntity();
        } 

        if ($this->request->is(['patch', 'post', 'put'])) {
 
            $this->request->data['password'] = 'abcd123';
            $this->request->data['payroll_mode'] = true;
            if ($Companies->add($companies, $this->request->getData())) {           
                $this->viewBuilder()->layout('account');
                if (!empty($companies))  {                    
                    $User = TableRegistry::get('Users');
                    $user = $User->find('all',['conditions'=>['Users.email'=>$companies->email]])->first();
                   
                    if (!empty($user)) {
                        $user->activation_key = Security::hash('xyz914@', 'sha1', true);                    
                        $User->save($user);
    
                        $reset_token_link = Router::url(['controller' => 'Account', 'action' => 'resetPassword'], true) . '/' . $user->email . '/' . $user->activation_key;
                        
                        $email = new Email();
                        $email
                            ->template('new_registration', 'default')
                            ->subject('New Registration')
                            ->emailFormat('html')
                            ->to('sanjeev@sanmisha.com')
                            ->viewVars(compact('companies'))
                            ->send();

                        $email = new Email();
                        $email
                            ->template('create_password', 'default')
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
        $this->set(compact('companies','user'));
    }  
    
    public function forgot() {
        $this->set('title_for_layout', 'Forgot Passsword ?');
        $this->viewBuilder()->setLayout('login');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $User = TableRegistry::get('Users');
            $user = $User->find('all',[
                'conditions'=>[
                    'Users.username'=>$data['username'],
                    'Users.mobile'=>$data['mobile']
                ]
            ])->first();
            if (!empty($user)) {
                $user->activation_key = Security::hash('xyz914@', 'sha1', true);                    
                $User->save($user);

                $reset_token_link = Router::url(['controller' => 'Account', 'action' => 'resetPassword'], true) . '/' . $user->username . '/' . $user->activation_key;

                $email = new Email();
                $email
                    ->template('forgot_password', 'default')
                    ->subject('Reset Password')
                    ->emailFormat('html')
                    ->to($user->email)
                    ->viewVars(compact('user','reset_token_link'))
                    ->send();
                
                $this->Flash->success('Please click on Reset password link, sent in your email address to reset password.');
                return $this->redirect(['action' => 'login']);                
            } else {
                $this->Flash->error('Sorry! Unable to find your login details.');
            }
        }
        $this->set(compact('user'));
    }     

    public function resetPassword($username, $activationKey) {
        $this->set('title_for_layout', 'Reset Password');
        $this->viewBuilder()->layout('login');
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
                'username'=>$username,
                'activation_key'=>$activationKey
            ])->first();
            if(!$user) {
			    $this->Flash->error('Unable to find User. Please try again');
                return $this->redirect(['controller'=>'Account','action'=>'login']);                   
            } else {
                $user->password = '';
            }            
        }
         
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
	}

    public function changePassword() {
        $this->set('title_for_layout', 'Change Password');
        $User = TableRegistry::get('Users');
        $user = $User->get($this->Auth->user('id'));
        if (!empty($this->request->data)) {            
            $user = $User->patchEntity($user, $this->request->getData());
            if ($User->save($user)) {
                $email = new Email();
                $email
                    ->template('password_changed', 'default')
                    ->subject('Password changed for My Dominion 2')
                    ->emailFormat('html')
                    ->to($user->email)
                    ->cc('sanjeev@sanmisha.com')
                    ->viewVars(compact('user'))
                    ->send();                
                $this->Flash->success('The password is successfully changed');
                $this->redirect('/dashboard');
            } else {
                //debug($user); exit;
                $this->Flash->error('There was an error during the save!');
            }
        } else {
            $user->password = null;
        }
		$this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
}
