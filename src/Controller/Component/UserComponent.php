<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Utility\Security;
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
    private $Key = 'wt1U5MTXGenFoFLgdTXGenFoenFoZoiLwZoiLwQFLgdTXGenFoZoiLwQZoiLwQWJGrbTXGWJGrbTXGenFoZoiLwWJGrACQWJGrHA';

    public function generateAuthenCode($userId = NULL){

    }

    public function checkAuthenCode($authenCode = ''){
    	
    }

    public function hasPassword($password = ''){
        // decryption later.
        //$key = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
        return Security::encrypt($password, $this->Key);
    }

    public function decryptPassword($password = ''){
        //$key = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
        return Security::decrypt($password, $this->Key);
    }
}
