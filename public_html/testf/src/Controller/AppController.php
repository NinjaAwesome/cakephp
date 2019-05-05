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

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenDate;
use Cake\Routing\Router;
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
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        FrozenDate::setToStringFormat('yyyy-MM-dd'); // For any mutable Date
        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        
        switch ($this->request->getParam('prefix')) {
            case 'admin':
                $this->loadComponent('Auth', [
                    'authenticate' => [
                        'Form' => [
                            'userModel' => 'AdminUserManager.AdminUsers', // Added This
                            'finder' => 'auth',
                            'fields' => [
                                'username' => 'email',
                                'password' => 'password'
                            ]
                        ]
                    ],
                    'loginAction' => [
                        'controller' => 'admin_users',
                        'action' => 'login',
                        'prefix' => 'admin',
                        "plugin" => 'AdminUserManager'
                    ],
                    'loginRedirect' => [
                        'controller' => 'dashboard',
                        'action' => 'index',
                        'prefix' => 'admin',
                        "plugin" => false
                    ],
                    'logoutRedirect' => [
                        'controller' => 'admin_users',
                        'action' => 'login',
                        'prefix' => 'admin',
                        "plugin" => 'AdminUserManager'
                    ],
                    'authError' => 'Your session is expired',
                    'storage' => [
                        'className' => 'Session',
                        'key' => 'Auth.Admin',
                    ],
                ]);
                $this->Auth->allow(['signup', 'forgot', 'login', 'passwordreset', 'verifyaccount']);
                break;
            case 'api':
                $this->loadComponent('Auth', [
                    'storage' => 'Memory',
                    'authenticate' => [
                        'Form' => [
                            'userModel' => 'UserManager.Users',
                            'fields' => [
                                'username' => 'email',
                                'password' => 'password'
                            ]
                        ],
                        'ADmad/JwtAuth.Jwt' => [
                            'userModel' => 'UserManager.Users',
                            //'finder' => 'auth',
                            'fields' => [
                                'username' => 'id'
                            ],
                            'parameter' => 'token',
                            // Boolean indicating whether the "sub" claim of JWT payload
                            // should be used to query the Users model and get user info.
                            // If set to `false` JWT's payload is directly returned.
                            'queryDatasource' => true,
                        ]
                    ],
                    'unauthorizedRedirect' => false,
                    'checkAuthIn' => 'Controller.initialize',
                    // If you don't have a login action in your application set
                    // 'loginAction' to false to prevent getting a MissingRouteException.
                    'loginAction' => false
                ]);
                break;
            default :

                $this->loadComponent('Auth', [
                    'loginAction' => [
                        'controller' => 'login',
                        'action' => 'index',
                        'prefix' => false
                    ],
                    'loginRedirect' => [
                        'controller' => 'profile',
                        'action' => 'index',
                        'prefix' => false,
                        "plugin" => false
                    ],
                    'logoutRedirect' => [
                        'controller' => 'login',
                        'action' => 'index',
                        'prefix' => false,
                        "plugin" => false
                    ],
                    'authError' => 'Your session is expired',
                    'storage' => [
                        'className' => 'Session',
                        'key' => 'Auth.User',
                    ],
                ]);
                $this->Auth->allow(['login']);
                break;

//                $this->loadComponent('Auth', [
//                    'authenticate' => [
//                        'Form' => [
//                            'userModel' => 'UserManager.Users', // Added This
//                            'fields' => [
//                                'username' => 'email',
//                                'password' => 'password'
//                            ]
//                        ]
//                    ],
//                    'loginAction' => [
//                        'controller' => 'users',
//                        'action' => 'login',
//                        'prefix' => false,
//                        "plugin" => 'UserManager'
//                    ],
//                    'loginRedirect' => [
//                        'controller' => 'dashboard',
//                        'action' => 'index',
//                        'prefix' => false,
//                        "plugin" => false
//                    ],
//                    'logoutRedirect' => [
//                        'controller' => 'users',
//                        'action' => 'login',
//                        'prefix' => false,
//                        "plugin" => 'UserManager'
//                    ],
//                    'authError' => 'Your session is expired',
//                    'storage' => [
//                        'className' => 'Session',
//                        'key' => 'Auth.User',
//                    ],
//                ]);
//                $this->Auth->allow(['signup', 'forgot', 'login', 'passwordreset', 'verifyaccount']);
//                break;
        }
        
    }
    
    public function beforeFilter(Event $event)
    {
        $this->ConfigSettings = Configure::read('Setting');
    }

    public function beforeRender(Event $event)
    {
        $ConfigSettings = Configure::read('Setting');
        $prefix = $this->request->getParam('prefix');
        if ($prefix == "admin") {
            $this->set(['authData' => $this->request->getSession()->read('Auth.Admin'), 'ConfigSettings' => $ConfigSettings]);
        } else if ($prefix == "api" || $prefix == "") {
            
            $metaData = [];
            if ((strtolower($this->request->getParam('plugin')) != "cmsmanager")) {

                $modules = TableRegistry::getTableLocator()->get('CmsManager.Modules');

                $metaObj = $modules->find('metas', $this->request->getAttribute('params'))->cache('metaData');
                if (!$metaObj->isEmpty()) {
                    $metas = $metaObj->first();
                    $metaData = [
                        'meta_title' => $metas->meta_title,
                        'meta_keyword' => $metas->meta_keyword,
                        'meta_description' => $metas->meta_description
                    ];
                }
            }
            if ($prefix == "api") {
                $this->metaData = $metaData;
            } else {
                
                $this->set([
                    'title' => $ConfigSettings['SYSTEM_APPLICATION_NAME'],
                    'metaData' => $metaData,
                    'ConfigSettings' => $ConfigSettings,
                ]);
            }
        }
    }
    
}
