<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\Routing\Router;
use Cake\Utility\Hash;

/**
 * MyAuthen component
 */
class MyAuthenComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'loginRedirect' => null,
        'userAccesses' => null
    ];
    public $components = ['Cookie'];
    public $Controller = null;
    private $UserAccesses = [
        'ADMIN' => [
            'controller' => [
            ],
            'action' => [
            ]
        ],
        'SELLER' => [
            'controller' => [
            ],
            'action' => [
            ]
        ],
        'NORMAL' => [
            'controller' => [
            ],
            'action' => [
            ]
        ]
    ];
    
    public function deleteAuthen(){
        $this->request->getSession()->destroy();
        $this->Cookie->delete('MyAuthen.user');
    }

    public function setAuthen($user = null) {
        if (isset($user['password'])) {
            $user['password'] = null;
        }

        $this->request->getSession()->write('MyAuthen.user', $user);
        $this->Cookie->write('MyAuthen.user', $user);
    }

    public function authen($controllerName = null, $actionName = null) {
        $controller = $this->_registry->getController();

        if (!empty($this->Cookie->read('MyAuthen.user'))) {
            $user = $this->Cookie->read('MyAuthen.user');
        } else {

            if (strtolower($controllerName) != strtolower($this->_config['loginRedirect']['controller'])) {
                //$this->log($this->_config['loginRedirect']['controller'],'debug');
                //$this->log($controllerName,'debug');
                return $controller->redirect($this->_config['loginRedirect']);
            }
        }
    }
    
     public function getLogedUserId(){
        $userId = $this->request->getSession()->read('MyAuthen.user.id');
        if(is_null($userId)){
            $user = $this->Cookie->read('MyAuthen.user');
            $this->request->getSession()->write('MyAuthen.user', $user);
        }
        return $userId;
    }
     public function getLogedUser(){
        $user = $this->request->getSession()->read('MyAuthen.user');
        if(is_null($user)){
            $user = $this->Cookie->read('MyAuthen.user');
            $this->request->getSession()->write('MyAuthen.user', $user);
        }
        //$this->log($user,'debug');
        return $user;
    }

}
