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
class SvLoginController extends AppController {

    public $Users = NULL;
    public $responData = ['status' => 200, 'msg' => '', 'data' => []];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('json');

        $this->Users = TableRegistry::get('Users');
        $this->Otps = TableRegistry::get('user_otps');

        $this->loadComponent('User');
         $this->autoRender = false;
        $this->modifyHeader();
    }

    public function login() {
        if ($this->request->is(['ajax', 'post'])) {
            $postData = $this->request->getData();
            $isfacebook = (isset($postData['isfacebook'])) ? $postData['isfacebook'] : 'N' ;
            if($isfacebook == 'N') {
                if (isset($postData['mobile']) && isset($postData['password'])) {
                    $password = $postData['password'];
                    $mobile = $postData['mobile'];

                    $user = $this->User->authenUser($mobile, $password);
                    if (is_null($user)) {
                        $this->responData['status'] = 403;
                        $this->responData['msg'] = 'หมายเลขโทรศัพท์ หรือ รหัสผ่าน ไม่ถูกต้อง!';
                    } else {
                        if ($user->type == 'ADMIN' || $user->type == 'SELLER') {
                            $authenCode = $this->User->generateAuthenCode($user->id);
                            $user['authen_code'] = $authenCode;
                            $this->responData['data'] = $user;
                        } else {
                            if ($user->isverify != 'Y') {
                                $getOTP = $this->Otps->find('all')->where(['user_id' => $user->id])->first();
                                $this->responData['status'] = 404;
                                $this->responData['data'] = [true, $getOTP->user_id, $getOTP->otp_ref];
                            } else {
                                // $user->password = NULL;
                                $authenCode = $this->User->generateAuthenCode($user->id);
                                $user['authen_code'] = $authenCode;
                                $this->responData['data'] = $user;
                            }
                        }
                    }
                } else {
                    $this->responData['status'] = 400;
                    $this->responData['msg'] = 'post field(s) is invalid.';
                }
            }else if($isfacebook == 'Y') {
                $user = $this->Users->find()->where(['id' => $postData['id']])->first();
                $this->log($user, 'debug');
                if(is_null($user)) {
                    $fb_register = $this->Users->newEntity();
                    $fb_register->id = $postData['id'];
                    $fb_register->fullname = $postData['fullname'];
                    $fb_register->mobile = 0;
                    $fb_register->isactive = 'Y';
                    $fb_register->isverify = 'Y';
                    $fb_register->type = 'NORMAL';
                    if($this->Users->save($fb_register)) {
                        $authenCode = $this->User->generateAuthenCode($fb_register->id);
                        $fb_register['authen_code'] = $authenCode;
                        $this->responData['data'] = $fb_register;
                    }
                }else{
                    $authenCode = $this->User->generateAuthenCode($user->id);
                    $user['authen_code'] = $authenCode;
                    $this->responData['data'] = $user;
                }
            }
        }
        
        
        $this->RequestHandler->respondAs('json');
        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;

    }

    public function onlogged() {
        if ($this->request->is(['ajax', 'get'])) {
            $user_id = $this->request->getQuery('uid');
            $user_logged = $this->Users->find('all')->where(['id' => $user_id])->first();
            // $this->log($user_logged, 'debug');
            // $this->log(sizeof($user_logged), 'debug');
            if (sizeof($user_logged) > 0) {
                $this->responData['msg'] = true;
            } else {
                $this->responData['msg'] = false;
            }
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->set(compact('json'));
    }

}
