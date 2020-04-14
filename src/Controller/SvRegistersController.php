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
    }

    public function register(){

        if ($this->request->is(['post','ajax'])) {
            $postData = $this->request->getData();
            $chkMobile = $this->checkRegister($postData['mobile']);
            if($chkMobile){
                $user_register = $this->Users->newEntity();
                $user_register = $this->Users->patchEntity($user_register, $postData);

                if($this->Users->save($user_register)){
                    $this->createOTP($user_register->id);
                    $this->responData['status'] = 200;
                    $this->responData['msg'] = 'Registed...';
                }else{
                    $this->responData['msg'] = 'Failed...';
                }
            }else{
                $this->responData['status'] = 400;
                $this->responData['msg'] = 'Mobile Dupplicate';
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

    private function createOTP ($id) {
        $otp = $this->Otps->newEntity();
        $otp->user_id = $id;
        $otp->otp_ref = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 0, 4);
        $otp->otp_code = substr(str_shuffle("0123456789"), 0, 6);
        $this->Otps->save($otp);
    }
}
