<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Login Controller
 *
 *
 * @method \App\Model\Entity\Login[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LoginController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->loadComponent('User');
        
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $this->viewBuilder()->setLayout('login');
        
        if($this->request->is(['post'])){
            $postData = $this->request->getData();
            $mobile = isset($postData['mobile'])?$postData['mobile']:'';
            $password = isset($postData['password'])?$postData['password']:'';
            
            $user = $this->User->authenUser($mobile,$password);
            if(!is_null($user)){
                $this->MyAuthen->setAuthen($user);
                
                $this->redirect(['controller'=>'home']);
            }
            
        }
    }

    public function authenCode ($authenCode = null) {
        if($this->request->is(['get'])){
            $authenCode = $this->request->getQuery('authencode');
            $authenStatus = $this->User->checkAuthenCode($authenCode);
            // $this->log($authenCode, 'debug');
            // $this->log($authenStatus, 'debug');
            if(isset($authenStatus)) {
                $this->MyAuthen->setAuthen($authenStatus);
                
                $this->redirect(['controller'=>'home']);
            }
        }
    }

}
