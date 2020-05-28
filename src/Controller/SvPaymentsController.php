<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * SvPayments Controller
 *
 *
 * @method \App\Model\Entity\SvPayment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SvPaymentsController extends AppController {

    public $Payments = NULL;
    public $Images = null;
    public $responData = ['status' => 403, 'msg' => '', 'data' => []];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Payments = TableRegistry::get('Payments');
        $this->Images = TableRegistry::get('Images');

        $this->autoRender = false;

        
    }

    public function update() {
        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');
        
        if ($this->request->is(['POST', 'AJAX'])) {

            $postData = $this->request->getData();
            $paymentId = $postData['payment_id'];
            //$this->log($postData,'debug');
            $payment = $this->Payments->find()->where(['Payments.id'=>$paymentId])->first();
            $payment = $this->Payments->patchEntity($payment, $postData);
            $payment->status = 'NEW';

            if ($this->Payments->save($payment)) {
                $this->responData['status'] = 200;
                $this->responData['data'] = $payment;
            } else {
                $this->log($payment->errors(),'debug');
            }
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');


        return $this->response;
    }

    public function _save() {
        if ($this->request->is(['POST', 'AJAX'])) {

            $this->loadComponent('UploadImage');

            $postData = $this->request->getData();
            $this->log($postData, 'debug');
            $file = $postData['image_file'];
            $payment = $this->Payments->newEntity();

            if (!is_null($file['name']) && $file['name'] != '') {
                $result = $this->UploadImage->upload($file, '', null, null, 'slips' . DS, false);
                $this->log($result, 'debug');
                if ($result['status'] == true) {
                    $image = $this->Images->newEntity();
                    $image->fullpath = $result['url'];
                    $image->path = $result['image_path'];
                    $image->name = $result['image_name'];
                    $this->Images->save($image);

                    $payment->image_id = $image->id;
                }
            }


            $payment->user_id = $postData['user_id'];
            $payment->order_id = $postData['order_id'];
            $payment->amount = $postData['amount'];
            $payment->status = 'NEW';

            if ($this->Payments->save($payment)) {
                $this->responData['status'] = 200;
                $this->responData['data'] = $payment;
            } else {
                
            }
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response->withStringBody($json);
        $this->response->withType('json');


        return $this->response;
    }

}
