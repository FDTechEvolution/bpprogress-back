<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 *
 * @method \App\Model\Entity\Payment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaymentsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $status = $this->request->getQuery('status');
        $this->loadComponent('Payment');
        if(is_null($status) || $status ==''){
            $status = 'NEW';
        }
        if ($this->request->is(['POST'])) {
            $postData = $this->request->getData();
            $this->Payments->updateAll(['status' => $postData['status']], ['Payments.id' => $postData['payment_id'], 'Payments.status' => 'NEW']);
            $this->Flash->success('อัพเดทสถานะแล้ว');
            return $this->redirect(['action' => 'index']);
        }
        
        $payments = $this->Payments->find()
                ->contain(['Users','Orders'=>['Users'],'Images'])
                ->where(['Payments.status'=>$status])
                ->toArray();
        
        $paymentStatus = $this->Payment->getPaymentStatus();
        
        $this->set(compact('status','payments','paymentStatus'));
    }
    
    

}
