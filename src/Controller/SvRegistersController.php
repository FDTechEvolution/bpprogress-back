<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
 * SvRegisters Controller
 *
 *
 * @method \App\Model\Entity\SvRegister[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SvRegistersController extends AppController
{

    public $Users = NULL;
    public $responData = ['status'=>403,'msg'=>'','data'=>[]];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('ajax');

        $this->Users = TableRegistry::get('Users');
        $this->Otps = TableRegistry::get('user_otps');
        $this->loadComponent('User');
        $this->loadComponent('Sms');
    }

    public function register(){

        if ($this->request->is(['post','ajax'])) {
            $postData = $this->request->getData();
            // $this->log($postData, 'debug');
            $chkMobile = $this->checkRegister($postData['mobile']);
            if($chkMobile){
                $user_register = $this->Users->newEntity();
                $user_register = $this->Users->patchEntity($user_register, $postData);

                $password = $this->User->hasPassword($postData['password']);
                $user_register->password = $password;

                if($this->Users->save($user_register)){
                    $this->responData['data'] = $this->Sms->getSendOTP($user_register->id, $postData['mobile']);
                    $this->responData['status'] = 200;
                    $this->responData['msg'] = 'Registed...';
                }else{
                    $this->responData['msg'] = 'เกิดข้อผิดพลาดในการลงทะเบียน กรุณาลองใหม่ในภายหลัง...';
                }
            }else{
                $this->responData['status'] = 400;
                $this->responData['msg'] = 'หมายเลขโทรศัพท์นี้ ได้มีการลงทะเบียนแล้ว กรุณาตรวจสอบ...';
            }
            
        }

        $json = json_encode($this->responData);
        $this->set(compact('json'));
        // $this->set('_serialize', ['json']);
    }

    private function checkRegister ($mobile) {
        $chk_register = $this->Users->find()->where(['mobile' => $mobile])->first();
        if(sizeof($chk_register) > 0) {
            return false;
        }else{
            return true;
        }
    }

    public function checkOtp () {
        if ($this->request->is(['post','ajax'])) {
            $postData = $this->request->getData();
            $otp = $this->Otps->find('all')->where(['user_id' => $postData['id'], 'otp_ref' => $postData['otp_ref'], 'otp_code' => $postData['otp_code']])->first();
            if(sizeof($otp) > 0) {
                $user_verify = $this->Users->get($postData['id']);
                $user_verify->isverify = 'Y';
                if($this->Users->save($user_verify)) {
                    $this->responData['status'] = 200;
                    $this->responData['msg'] = 'Verified';
                }
            }else{
                $this->responData['status'] = 400;
                $this->responData['msg'] = 'รหัส OTP ไม่ถูกต้อง กรุณาตรวจสอบ...';
            }
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->set(compact('json'));
    }
}
