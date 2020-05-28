<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController {

    public $OrderStatus = [
        'DR' => 'ฉบับร่าง',
        'NEW' => 'คำสั่งซื้อใหม่',
        'WT' => 'รอจัดส่ง',
        'SENT' => 'ส่งแล้ว',
        'RECEIVED' => 'รับสินค้าแล้ว',
        'VO' => 'ยกเลิก'
    ];
    public $PaymentStatus = [
        'PAID' => 'ชำระเงินแล้ว',
        'NOTPAID' => 'ยังไม่ได้ชำระเงิน'
    ];
    public $PaymentMethod = [
        'cod' => 'เก็บเงินปลายทาง',
        'transfer' => 'โอนเงิน',
        'creditcard' => 'บัตรเครดิต',
        'cash' => 'เงินสด'
    ];
    public $Shippings = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Shippings = TableRegistry::get('Shippings');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {

        if ($this->request->is(['POST'])) {
            $postData = $this->request->getData();
            $this->Orders->updateAll(['status' => $postData['status']], ['Orders.id' => $postData['order_id'], 'Orders.status' => 'NEW']);
            $this->Flash->success('อัพเดทสถานะแล้ว');
            return $this->redirect(['action' => 'index']);
        }
        $status = 'NEW';
        $orders = $this->getOrderBtStatus($status);
        $orderStatus = $this->OrderStatus;
        $paymentStatus = $this->PaymentStatus;
        $this->set(compact('orders', 'status', 'orderStatus', 'paymentStatus'));
    }

    public function waitingDelivery() {
        if ($this->request->is(['POST'])) {
            $postData = $this->request->getData();

            $order = $this->Orders->find()->where(['id' => $postData['order_id'], 'status' => 'WT'])->first();
            $order = $this->Orders->patchEntity($order, $postData);
            $this->Orders->save($order);
            $this->Flash->success('อัพเดทสถานะแล้ว');
            return $this->redirect(['action' => 'waiting-delivery']);
        }
        $status = 'WT';
        $orders = $this->getOrderBtStatus($status);
        $orderStatus = $this->OrderStatus;
        $paymentStatus = $this->PaymentStatus;

        $shippings = $this->Shippings->find('list')->where(['isactive' => 'Y'])->toArray();
        $this->set(compact('orders', 'status', 'orderStatus', 'paymentStatus', 'shippings'));
    }

    public function sent() {
        if ($this->request->is(['POST'])) {
            $postData = $this->request->getData();
            $this->Orders->updateAll(['status' => $postData['status']], ['id' => $postData['order_id'], 'status' => 'SENT']);
            $this->Flash->success('อัพเดทสถานะแล้ว');
            return $this->redirect(['action' => 'sent']);
        }
        $status = 'SENT';
        $orders = $this->getOrderBtStatus($status);
        $orderStatus = $this->OrderStatus;
        $paymentStatus = $this->PaymentStatus;

        $shippings = $this->Shippings->find('list')->where(['isactive' => 'Y'])->toArray();
        $this->set(compact('orders', 'status', 'orderStatus', 'paymentStatus', 'shippings'));
    }

    public function updateTracking() {
        if ($this->request->is(['POST'])) {
            $postData = $this->request->getData();
            $orderId = $postData['order_id'];
            $order = $this->Orders->find()->where(['id' => $orderId, 'status' => 'SENT'])->first();
            $order = $this->Orders->patchEntity($order, $postData);
            $this->Orders->save($order);
            $this->Flash->success('อัพเดทหมายเลขพัสดุแล้ว');
            return $this->redirect(['action' => 'sent']);
        }
    }

    public function received() {
        if ($this->request->is(['POST'])) {
            $postData = $this->request->getData();
            $this->Orders->updateAll(['status' => $postData['status'], 'shipping_id' => $postData['shipping_id']], ['id' => $postData['order_id']]);

            return $this->redirect(['action' => 'waiting-delivery']);
        }
        $status = 'RECEIVED';
        $orders = $this->getOrderBtStatus($status);
        $orderStatus = $this->OrderStatus;
        $paymentStatus = $this->PaymentStatus;

        $shippings = $this->Shippings->find('list')->where(['isactive' => 'Y'])->toArray();
        $this->set(compact('orders', 'status', 'orderStatus', 'paymentStatus', 'shippings'));
    }

    public function view($orderId = null) {
        $order = $this->Orders->find()
                ->contain([
                    'Users',
                    'Shippings', 'Addresses',
                    'OrderLines' => [
                        'Products' => [
                            'ProductImages' => [
                                'Images'
                            ]
                        ]
                    ]
                ])
                ->where(['Orders.id' => $orderId])
                ->first();

        $orderStatus = $this->OrderStatus;
        $paymentStatus = $this->PaymentStatus;
        $paymentMethod = $this->PaymentMethod;

        $this->set(compact('order', 'orderStatus', 'paymentStatus', 'paymentMethod'));
    }

    private function getOrderBtStatus($status = null) {
        $user = $this->MyAuthen->getLogedUser();
        $orders = $this->Orders->find()
                ->contain(['Users', 'Shippings'])
                ->where(['Orders.shop_id' => $user['shop_id'], 'status' => $status])
                ->toArray();
        return $orders;
    }

}
