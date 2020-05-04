<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController {

    public $OrderStatus = [
        'DR'=>'ฉบับร่าง',
        'NEW'=>'คำสั่งซื้อใหม่',
        'WT'=>'รอจัดส่ง',
        'SENT'=>'ส่งแล้ว',
        'RECEIPT'=>'รับสินค้าแล้ว'
    ];
    
    public $PaymentStatus = [
        'PAID'=>'ชำระเงินแล้ว',
        'NOTPAID'=>'ยังไม่ได้ชำระเงิน'
    ];
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {

        if ($this->request->is(['POST'])) {
            $postData = $this->request->getData();
            $this->Orders->updateAll(['status' => $postData['status']], ['Orders.id' => $postData['order_id']]);

            return $this->redirect(['action' => 'index']);
        }
        $status = 'NEW';
        $orders = $this->getOrderBtStatus($status);
        $orderStatus = $this->OrderStatus;
        $paymentStatus = $this->PaymentStatus;
        $this->set(compact('orders', 'status','orderStatus','paymentStatus'));
    }

    public function waitingDelivery() {
        if ($this->request->is(['POST'])) {
            $postData = $this->request->getData();
            $this->Orders->updateAll(['status' => $postData['status']], ['Orders.id' => $postData['order_id']]);

            return $this->redirect(['action' => 'waitingDelivery']);
        }
        $status = 'WT';
        $orders = $this->getOrderBtStatus($status);
        $orderStatus = $this->OrderStatus;
        $paymentStatus = $this->PaymentStatus;
        $this->set(compact('orders', 'status','orderStatus','paymentStatus'));
    }

    private function getOrderBtStatus($status = null ) {
        $user = $this->MyAuthen->getLogedUser();
        $orders = $this->Orders->find()
                ->contain(['Users'])
                ->where(['Orders.shop_id' => $user['shop_id'], 'status' => $status])
                ->toArray();
        return $orders;
    }

}
