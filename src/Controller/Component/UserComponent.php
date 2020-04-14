<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;
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
    public $Users = NULL;

    public function generateAuthenCode($userId = NULL){

    }

    public function checkAuthenCode($authenCode = ''){
    	
    }

    public function hasPassword($password = ''){
        // decryption later.
        //$key = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
        return Security::encrypt($password, $this->Key);
    }

    public function authenUser($mobile='',$password = ''){
        $this->Users = TableRegistry::get('Users');
        $user = $this->Users->find()->where(['mobile'=>$mobile])->first();

        if(!is_null($user)){
            $userPassword = $this->decryptPassword($user->password);
            if($password == $userPassword){
                return $user;
            }
        }

        return null;
    }

    private function decryptPassword($password = ''){
        //$key = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
        return Security::decrypt($password, $this->Key);
    }
}
