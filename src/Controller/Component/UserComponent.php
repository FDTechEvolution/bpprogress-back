<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
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
    public $UserAuthens = NULL;

    public $components = ['Utils'];

    public function generateAuthenCode($userId = NULL){
        $this->UserAuthens = TableRegistry::get('UserAuthens');

        $code = $this->Utils->generateRandomString(20);


    }

    public function checkAuthenCode($authenCode = ''){
    	
    }

    public function hasPassword($password = ''){
        // decryption later.
        //$key = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
        //Security::setHash('md5');
        //return Security::encrypt($password, $this->Key);
        return (new DefaultPasswordHasher)->hash($password);
    }

    public function authenUser($mobile='',$password = ''){
        $this->Users = TableRegistry::get('Users');
        $user = $this->Users->find()->where(['mobile'=>$mobile])->first();

        if(!is_null($user)){
            $result = $this->checkPassword($password,$user->password);
            if($result){
                return $user;
            }
        }

        return null;
    }

    public function checkPassword($password,$hashedPassword){
        return (new DefaultPasswordHasher)->check($password,$hashedPassword);
    }

    private function decryptPassword($password = ''){
        //$key = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
        return Security::decrypt($password, $this->Key);
        //return (new DefaultPasswordHasher)->check($password);
    }
}
