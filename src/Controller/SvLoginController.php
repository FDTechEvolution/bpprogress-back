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
        if ($this->request->is(['ajax','post'])) {
            $postData = $this->request->getData();
            if(isset($postData['mobile']) && isset($postData['password'])){
                $password = $postData['password'];
                $mobile = $postData['mobile'];

                $user = $this->User->authenUser($mobile,$password);
                if(is_null($user)){
                    $this->responData['msg'] = 'user or password is invalid.';
                }else{
                    $user->password = NULL;
                    $this->responData['data'] = $user;
                }

            }else{
                $this->responData['status'] = 400;
                $this->responData['msg'] = 'post field(s) is invalid.';
            }
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->set(compact('json'));
    }
}
