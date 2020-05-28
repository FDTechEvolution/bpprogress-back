<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;

/**
 * SvOrders Controller
 *
 *
 * @method \App\Model\Entity\SvOrder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SvOrdersController extends AppController {

    public $responData = ['status' => 403, 'msg' => '', 'data' => []];
    public $Products = null;
    public $Orders = null;
    public $OrderLines = null;
    public $Payments = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('json');

        $this->Products = TableRegistry::get('Products');
        $this->Orders = TableRegistry::get('Orders');
        $this->OrderLines = TableRegistry::get('OrderLines');
        $this->Payments = TableRegistry::get('Payments');

        $this->loadComponent('Warehouse');

        $this->autoRender = false;
    }

    public function getOrder($id = null) {
        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

        $order = $this->Orders->find()
                ->contain([
                    'OrderLines' => [
                        'Products' => [
                            'ProductImages' => function ($query) {
                                return $query->contain(['Images'])
                                        ->where(['ProductImages.type' => 'DEFAULT']);
                            }]
                    ],
                    'Shops',
                    'Users',
                    'Payments', 'Addresses'
                ])
                ->where(['Orders.id' => $id])
                ->first();

        $this->responData = ['status' => 200, 'msg' => '', 'data' => $order];

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

    public function getOrderByUser($userId = null) {
        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

        $orders = $this->Orders->find()
                ->contain([
                    'OrderLines' => [
                        'Products' => [
                            'ProductImages' => function ($query) {
                                return $query->contain(['Images'])
                                        ->where(['ProductImages.type' => 'DEFAULT']);
                            }]
                    ],
                    'Shops',
                    'Users', 'Payments', 'Addresses'
                ])
                ->where(['Orders.user_id' => $userId])
                ->order(['Orders.created' => 'DESC'])
                ->toArray();
        $_orders = $orders;
        foreach ($_orders as $index => $order) {
            $orders[$index]['docdate'] = $order->docdate->i18nFormat(DATE_FORMATE, null, NULL);
        }

        $this->responData = ['status' => 200, 'msg' => '', 'data' => $orders];

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

    public function save() {
        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

        if ($this->request->is(['post', 'ajax'])) {
            //$postData = $this->request->getData();
            $postData = $this->request->getData();
            //$this->log($postData,'debug');
            $result = $this->verifyOrderFields($postData);
            if ($result['status'] == true) {
                $order = $this->Orders->newEntity();
                $order->shop_id = $postData['shop_id'];
                $order->user_id = $postData['user_id'];
                $order->docdate = new Date();
                $order->status = 'DR';
                $order->docno = $this->Utils->generateNormalDocNo('OR');

                if ($this->Orders->save($order)) {
                    $this->createOrderLine($order->id, $postData['order_lines']);

                    //Update final order
                    $order = $this->Orders->find()
                            ->contain(['OrderLines'])
                            ->where(['Orders.id' => $order->id])
                            ->first();
                    $totalamt = 0;
                    foreach ($order->order_lines as $index => $orderLine) {
                        $totalamt += $orderLine->amount;
                    }

                    $order->totalamt = $totalamt;
                    //$order->status = 'NEW';
                    $this->Orders->save($order);


                    //Create payment
                    $this->createPayment($order->id, $order->user_id, $totalamt);

                    //Update Stock
                    $this->Warehouse->updateByOrder($order->id);

                    $this->responData['data'] = $order;
                    $this->responData['status'] = 200;
                }
            } else {
                $this->responData['msg'] = 'please check require field(s),' . $result['msg'];
                $this->responData['data'] = $postData;
            }
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;

        // echo json_encode($this->responData, JSON_UNESCAPED_UNICODE);
    }

    public function updateOrder() {
        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $orderId = $postData['order_id'];

            $order = $this->Orders->find()
                    ->where(['Orders.id' => $orderId])
                    ->first();

            if (isset($postData['status'])) {
                $order->status = $postData['status'];
                $newStatus = $postData['status'];
                //$this->void($orderId,$newStatus);
            }
            if (isset($postData['totalamt'])) {
                $order->totalamt = $postData['totalamt'];
            }
            if (isset($postData['address_id'])) {
                $order->address_id = $postData['address_id'];
            }
            if (isset($postData['payment_method'])) {
                $order->payment_method = $postData['payment_method'];
            }
            if (isset($postData['payment_status'])) {
                $order->payment_status = $postData['payment_status'];
            }

            $this->Orders->save($order);
            $this->responData['data'] = $order;
            $this->responData['status'] = 200;
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

    public function void() {
        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $orderId = $postData['order_id'];
            $order = $this->Orders->find()
                    ->contain(['OrderLines' => ['UsedWarehouses']])
                    ->where(['Orders.id' => $orderId])
                    ->first();

            if ($order->status == 'NEW' || $order->status == 'WS') {
                $orderLines = $order->order_lines;
                foreach ($orderLines as $line) {
                    $usedWarehouses = $line['used_warehouses'];

                    foreach ($usedWarehouses as $usedWarehouse) {
                        $this->Warehouse->updateWarehuseProductQty($usedWarehouse['warehouse_id'], $line['product_id'], $usedWarehouse['qty'], 'VOID');
                    }
                }

                $order->status = 'VO';
                $this->Orders->save($order);

                $this->responData['data'] = $order;
                $this->responData['status'] = 200;
            } else {
                $this->responData['data'] = $order;
                $this->responData['status'] = 400;
                $this->responData['msg'] = 'ไม่สามารถยกเลิกรายการได้';
            }
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

    private function createPayment($orderId = null, $userId = null, $expectamt = 0) {
        $payment = $this->Payments->newEntity();
        $payment->order_id = $orderId;
        $payment->user_id = $userId;
        $payment->expectamt = $expectamt;

        $this->Payments->save($payment);
    }

    private function createOrderLine($orderId = null, $orderLines = null) {
        $this->loadComponent('Product');

        foreach ($orderLines as $index => $line) {
            $product = $this->Products->find()->contain(['WholesaleRates'])->where(['Products.id' => $line['product_id']])->first();
            if (!is_null($product)) {
                $orderLine = $this->OrderLines->newEntity();
                $orderLine->order_id = $orderId;
                $orderLine->product_id = $product->id;
                $orderLine->qty = $line['qty'];

                $unitPrice = $this->Product->getUnitPriceByQty($product->id, $line['qty']);

                $orderLine->unit_price = $unitPrice;
                $orderLine->amount = ($orderLine->qty * $orderLine->unit_price);

                $this->OrderLines->save($orderLine);
            }
        }
    }

    private function verifyOrderFields($fields = []) {
        $status = true;
        $msg = '';

        if (!(isset($fields['shop_id'])) || $fields['shop_id'] == NULL || $fields['shop_id'] == '') {
            $status = false;
            $msg .= 'shop_id, ';
        }
        if (!isset($fields['user_id']) || $fields['user_id'] == NULL || $fields['user_id'] == '') {
            $status = false;
            $msg .= 'user_id, ';
        }
        if (!isset($fields['order_lines']) || !is_array($fields['order_lines'])) {
            $status = false;
            $msg .= 'order_lines, ';
        } else {
            //Check all lines
            foreach ($fields['order_lines'] as $line) {
                if (!isset($line['product_id']) || $line['product_id'] == NULL || $line['product_id'] == '') {
                    $status = false;
                    $msg .= 'product_id, ';
                }
                if (!isset($line['qty']) || $line['qty'] == NULL || $line['qty'] == '') {
                    $status = false;
                    $msg .= 'qty, ';
                }
            }
        }

        return [
            'status' => $status, 'msg' => $msg
        ];
    }

    public function checkStockByProduct() {
        $productId = $this->request->getQuery('product_id');
        $useQty = $this->request->getQuery('qty');

        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

        $result = $this->Warehouse->checkStockByProduct($productId, $useQty);

        $this->responData = ['status' => 200, 'msg' => '', 'data' => $result];

        $json = json_encode($this->responData);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

}
