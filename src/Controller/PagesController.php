<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['view', 'index']);
    }

    public function view($id=1) {
        $page = $this->Pages->get($id, ['contain'=>'Sections']);
        $this->viewBuilder()->setLayout('WebUI.'.$page->layout);
        $all = $this->Pages->Sections->find('all');      
        $first = $this->Pages->Sections->find()->where(['section'=>'footer-3'])->first();      
        $this->set('page', $page);
        $this->set('all', $all);
        $this->set('first', $first);
        $this->set('title', $page->page_title);
        $this->set('keywords', $page->keywords);
        $this->set('description', $page->description);
        $this->set('meta', $page->meta_tags);
        $this->set('_serialize', ['page']);       
    }

    public function index() {
        
        $this->set('title', "Good morning");
        $Packages = TableRegistry::get('Packages');			
		$packages = $Packages->find('all');
			//->where(['Packages.id' =>$this->Auth->user('id')]);	
		$this->set(compact('packages'));
        $this->render('index');
        
    }

}
