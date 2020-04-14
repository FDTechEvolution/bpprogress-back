<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * User component
 */
class UserComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function generateAuthenCode($userId = NULL){

    }

    public function checkAuthenCode($authenCode = ''){
    	
    }
}
