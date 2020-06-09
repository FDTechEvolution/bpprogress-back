<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;


/**
 * Manual Controller
 *
 *
 * @method \App\Model\Entity\Manual[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ManualController extends AppController
{
    public function index($password){
         $this->autoRender = false;
         $this->loadComponent('User');

         $_password = $this->User->hasPassword($password);
         echo $_password;

         echo $this->User->checkPassword($password,$_password);
        
    }
}
