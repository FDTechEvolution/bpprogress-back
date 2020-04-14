<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
 * SvLogin Controller
 *
 *
 * @method \App\Model\Entity\SvLogin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SvLoginController extends AppController
{
    
    public $Users = NULL;
    public $responData = ['status'=>200,'msg'=>'','data'=>[]];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('ajax');

        $this->Users = TableRegistry::get('Users');

        $this->loadComponent('User');
    }


    public function login(){
        
    }
}
