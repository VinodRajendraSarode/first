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
namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\I18n\Number;
use Muffin\Footprint\Auth\FootprintAwareTrait;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    use FootprintAwareTrait;
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        //parent::initializ();
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');

        $this->loadComponent('TinyAuth.Auth', [
            'authenticate' => [
                'Tools.MultiColumn' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ],
                    'columns' => ['email'],
                    'finder' => 'auth'
                ],
            ],
            'authorize' => ['TinyAuth.Tiny' => [
                'authorizeByPrefix' => [
                    'admin' => ['admin'],
                ]
            ]],
            'loginAction' => [
                'controller' => 'Account',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'plugin' => false,
                'controller' => 'Dashboard',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Account',
                'action' => 'login'
            ],
            'flash' => [
                'element' => 'error',
                //'key' => 'auth'
            ],
            'unauthorizedRedirect' => true,
            'authError' => 'You are not authorized.',
            'checkAuthIn'=> 'Controller.initialize',
        ]);

        $this->loadComponent('TinyAuth.AuthUser');
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
    }

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->setTheme('Neptune');
    }
}
