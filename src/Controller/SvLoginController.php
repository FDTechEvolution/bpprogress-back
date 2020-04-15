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
            $this->log($postData, 'debug');
            if(isset($postData['mobile']) && isset($postData['password'])){
                $password = $postData['password'];
                $mobile = $postData['mobile'];

                $user = $this->User->authenUser($mobile,$password);
                if(is_null($user)){
                    $this->responData['status'] = 403;
                    $this->responData['msg'] = 'หมายเลขโทรศัพท์ หรือ รหัสผ่าน ไม่ถูกต้อง!';
                }else{
                    if($user->type !='NORMAL'){
                        $authenCode = $this->User->generateAuthenCode($user->id);
                        $user['authen_code'] = $authenCode;
                    }

                    if($user->isverify != 'Y') {
                        $responData['status'] = 404;
                    }

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
