<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;

/**
 * SvUsers Controller
 *
 *
 * @method \App\Model\Entity\SvUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SvUsersController extends AppController {

    public $responData = ['status' => 403, 'msg' => '', 'data' => []];
    public $Users = null;
    public $Addresses = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Users = TableRegistry::get('Users');
        $this->Addresses = TableRegistry::get('Addresses');

        $this->loadComponent('User');

        $this->autoRender = false;
    }

    public function getUser($id = null) {
        $user = $this->Users->find()
                ->contain(['Addresses'=>function($q){
                    return $q->where(['Addresses.isactive'=>'Y']);
                }])
                ->where(['Users.id' => $id])
                ->first();

        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

        $this->responData = ['status' => 200, 'msg' => '', 'data' => $user];

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

    public function saveAddress() {
        if ($this->request->is(['POST', 'PUT', 'AJAX'])) {
            $postData = $this->request->getData();
            $address = $this->Addresses->newEntity();

            $address = $this->Addresses->patchEntity($address, $postData);
            $this->Addresses->save($address);
            $this->responData = ['status' => 200, 'msg' => '', 'data' => $address];
        }

        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');



        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

    public function updateAddress() {
        if ($this->request->is(['POST', 'PUT', 'AJAX'])) {
            $postData = $this->request->getData();
            if (isset($postData['address_id']) && $postData['address_id'] != '') {
                $address = $this->Addresses->find()->where(['Addresses.id' => $postData['address_id']])->first();
                if (!is_null($address)) {
                    if(isset($postData['isactive'])){
                        $address->isactive = $postData['isactive'];
                    }
                    
                    $this->Addresses->save($address);
                     $this->responData = ['status' => 200, 'msg' => '', 'data' => $address];
                }
            }
        }

        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');
        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

    public function updateUser() {
        if ($this->request->is(['POST', 'PUT', 'AJAX'])) {
            $postData = $this->request->getData();
            if (isset($postData['user_id']) && $postData['user_id'] != '') {
                $user = $this->Users->find()->where(['id' => $postData['user_id']])->first();
                if (!is_null($user)) {
                    
                    $user->fullname = $postData['fullname'];
                    $user->email = $postData['email-name'];
                    $user->mobile = $postData['mobile'];
                    
                    $this->Users->save($user);
                    $this->responData = ['status' => 200, 'msg' => '', 'data' => $user];
                }
            }
        }

        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');
        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

    public function changePassword() {
        if ($this->request->is(['POST', 'PUT', 'AJAX'])) {
            $postData = $this->request->getData();
            // $this->log($postData, 'debug');
            if(isset($postData['old_password']) && $postData['old_password'] != '') {
                $checkOldPassword = $this->checkOldPassword($postData['old_password'], $postData['user_id']);
                if($checkOldPassword) {
                    if($postData['new_password'] >= 8 && $postData['confirm_password'] >= 8) {
                        if($postData['new_password'] == $postData['confirm_password']) {
                            $setNewPassword = $this->Users->find()->where(['id' => $postData['user_id']])->first();
                            $setNewPassword->password = $this->User->hasPassword($postData['new_password']);
                            $this->Users->save($setNewPassword);
                            $this->responData = ['status' => 200, 'msg' => '', 'data' => $setNewPassword];
                        }else{
                            $this->responData = ['status' => 404, 'msg' => 'รหัสผ่านไม่ตรงกัน กรุณาตรวจสอบ...'];
                        }
                    }else{
                        $this->responData = ['status' => 404, 'msg' => 'รหัสผ่านไม่ครบ กรุณาตรวจสอบ...'];
                    }
                }else{
                    $this->responData = ['status' => 404, 'msg' => 'รหัสผ่านไม่ถูกต้อง กรุณาตรวจสอบ...'];
                }
            }
        }

        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');
        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

    private function checkOldPassword($old_password, $user_id) {
        $user = $this->Users->find()->where(['id' => $user_id])->first();
        return $this->User->checkPassword($old_password,$user->password);
    }

}
