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
            $chkMobile = $this->checkRegister($postData['mobile']);
            if($chkMobile){
                $user_register = $this->Users->newEntity();
                $user_register = $this->Users->patchEntity($user_register, $postData);

                $password = $this->User->hasPassword($postData['password']);
                $user_register->password = $password;

                if($this->Users->save($user_register)){
                    $this->responData['data'] = $this->createOTP($user_register->id, $postData['mobile']);
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

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->set(compact('json'));
    }

    private function checkRegister ($mobile) {
        $chk_register = $this->Users->find()->where(['mobile' => $mobile])->first();
        if(sizeof($chk_register) > 0) {
            return false;
        }else{
            return true;
        }
    }

    private function createOTP ($id,$mobile) {
        $otp = $this->Otps->newEntity();
        $otp->user_id = $id;
        $otp->otp_ref = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 0, 4);
        $otp->otp_code = substr(str_shuffle("0123456789"), 0, 6);
        if($this->Otps->save($otp)){
            // return $otp_return = [$id, $otp->otp_ref];
            $message = "รหัส OTP ของคุณคือ ".$otp->otp_code." รหัสอ้างอิง ".$otp->otp_ref." สำหรับลงทะเบียน BPprogress ระยะเวลาสิ้นสุด ".date('d-m-Y')." ";
            return $this->Sms->sendOTP('0000', $mobile, $message);
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
