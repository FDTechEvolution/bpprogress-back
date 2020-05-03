<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * SvNotifications Controller
 *
 *
 * @method \App\Model\Entity\SvNotification[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SvNotificationsController extends AppController {

    public $Orders = null;
    public $responData = ['status' => 403, 'msg' => '', 'data' => []];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);


        $this->Orders = TableRegistry::get('Orders');

        $this->autoRender = false;
    }

    public function countNewOrder($shopId = NULL) {
        $count = 0;

        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

        if (is_null($shopId)) {
            $count = $this->Orders->find()->where(['Orders.status' => 'NEW'])->count();
        } else {
            $count = $this->Orders->find()->where(['Orders.shop_id' => $shopId, 'Orders.status' => 'NEW'])->count();
        }

        $this->responData['status'] = 200;
        $this->responData['data'] = $count;

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

}
