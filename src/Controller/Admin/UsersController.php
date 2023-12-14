<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize() {
		parent::initialize();
       
		$this->loadComponent('Search.Prg', [
			'actions' => ['index']
        ]);	 
        
       /*  $this->loadComponent('Auth', [
        'authenticate' => [
            'Form' => [
                'finder' => 'auth'
            ]
        ],
    ]);*/

    }    

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index(){
        $this->set('title_for_layout', 'Users');
		$query = $this->Users
            ->find('search', ['search' => $this->request->getQueryParams()]);
        $this->set('users', $this->paginate($query));
        $this->set('_serialize', ['users']);  
    }
    
    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null){
		if(empty($id)) {
			$user = $this->Users->newEntity();
			$this->set('title_for_layout', 'Add User');
		} else {
			 $user = $this->Users->get($id, [
				'contain' => ['Roles']
            ]);
			$this->set('title_for_layout', 'Edit User');
        }
       
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData(),[
                'associated'=>['Roles']
            ]);

            if ($this->Users->save($user, ['associated'=>['Roles']])) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles=$this->Users->Roles->find('list');
        $this->set(compact('user','roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    } 

    public function activate($id){
	
		$user = $this->Users->get($id);
		$user->active = true;
		if($this->Users->save($user)) {
			$this->Flash->success('The user has been Activate');
			return $this->redirect(['action'=>'index']);
		}else {
			$this->Flash->error('The user could not be Activate try again');
		}
	}

	public function deactivate($id){
	
		$user = $this->Users->get($id);
		$user->active = false;
		if($this->Users->save($user)) {
			$this->Flash->success('The user has been Deactivate');
			return $this->redirect(['action'=>'index']);
		}else {
			$this->Flash->error('The user could not be Deactivate try again');
		}
	}
}
