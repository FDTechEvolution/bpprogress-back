<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

/**
 * Home Controller
 *
 *
 * @method \App\Model\Entity\Home[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HomeController extends AppController {

    public $Connection = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Connection = ConnectionManager::get('default');
    }

    public function index() {
        $user = $this->MyAuthen->getLogedUser();
        $sql = "select sum(o.totalamt) as salesamt from orders o where o.status in ('NEW','WT','SENT','RECEIVED') and o.shop_id = :shop_id";
        $salesamt = $this->Connection->execute($sql, ['shop_id'=>$user['shop_id']])->fetchAll('assoc');
        $salesamt = $salesamt[0]['salesamt'];
        
        $sql = "select count(*) as count_order from orders o where o.status in ('NEW','WT','SENT','RECEIVED') and o.shop_id = :shop_id";
        $countOrder = $this->Connection->execute($sql, ['shop_id'=>$user['shop_id']])->fetchAll('assoc');
        $countOrder = $countOrder[0]['count_order'];
        
        $sql = "select count(*) as count_product from products p where p.shop_id = :shop_id";
        $countProduct = $this->Connection->execute($sql, ['shop_id'=>$user['shop_id']])->fetchAll('assoc');
        $countProduct = $countProduct[0]['count_product'];
        
        $sql = "select sum(wp.qty) as warehouse_qty from warehouses w left join warehouse_products wp on w.id = wp.warehouse_id where w.shop_id = :shop_id";
        $warehouseQty = $this->Connection->execute($sql, ['shop_id'=>$user['shop_id']])->fetchAll('assoc');
        $warehouseQty = $warehouseQty[0]['warehouse_qty'];
        
        $this->set(compact('salesamt','countOrder','countProduct','warehouseQty'));
    }

}
