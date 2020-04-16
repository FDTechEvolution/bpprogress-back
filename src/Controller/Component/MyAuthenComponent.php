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
class MyAuthenComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
    	'loginRedirect'=>null,
    	'userAccesses'=>null
    ];
    public $components = ['Cookie'];
    public $Controller = null;

    private $UserAccesses = [
    	'ADMIN'=>[
    		'controller'=>[

    		],
    		'action'=>[

    		]
    	],
    	'SELLER'=>[
    		'controller'=>[

    		],
    		'action'=>[

    		]
    	],
    	'NORMAL'=>[
    		'controller'=>[

    		],
    		'action'=>[

    		]
    	]
    ];



    public function authen($controllerName = null,$actionName = null){
    	$controller = $this->_registry->getController();

    	if (!empty($this->Cookie->read('remember_me_cookie'))) {
    		$user = $this->Cookie->read('user');
    	}else{
    		
    		if(strtolower($controllerName) != strtolower($this->_config['loginRedirect']['controller'])){
    			//$this->log($this->_config['loginRedirect']['controller'],'debug');
    			//$this->log($controllerName,'debug');
    			return $controller->redirect($this->_config['loginRedirect']);
    		}
    		
    	}
    }

}
