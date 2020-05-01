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

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('json');

        $this->Products = TableRegistry::get('Products');
        $this->Orders = TableRegistry::get('Orders');
        $this->OrderLines = TableRegistry::get('OrderLines');

        $this->autoRender = false;
    }

    public function save() {
        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            $result = $this->verifyOrderFields($postData);
            if ($result['status'] == true) {
                $order = $this->Orders->newEntity();
                $order->shop_id = $postData['shop_id'];
                $order->user_id = $postData['user_id'];
                $order->docdate =  new Date();
                $order->status = 'DR';
                
                if($this->Orders->save($order)){
                    $this->createOrderLine($order->id, $postData['order_lines']);
                    
                    //Update final order
                    
                }
                
                
            } else {
                $this->responData['msg'] = 'please check require field(s),' . $result['msg'];
            }
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

    private function createOrderLine($orderId=null,$orderLines = null) {
        
    }

    private function verifyOrderFields($fields = []) {
        $status = true;
        $msg = '';

        if (!isset($fields['shop_id']) || $fields['shop_id'] == NULL || $fields['shop_id'] == '') {
            $status = false;
            $msg .= 'shop_id, ';
        }
        if (!isset($fields['user_id']) || $fields['user_id'] == NULL || $fields['user_id'] == '') {
            $status = false;
            $msg .= 'user_id, ';
        }
        if (!is_array($fields['order_lines'])) {
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

}
