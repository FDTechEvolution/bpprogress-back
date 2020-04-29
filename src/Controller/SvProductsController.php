<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * SvProducts Controller
 *
 *
 * @method \App\Model\Entity\SvProduct[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SvProductsController extends AppController
{
    public $Products = NULL;
    public $responData = ['status'=>403,'msg'=>'','data'=>[]];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('json');

        $this->Products = TableRegistry::get('Products');
    }

    public function getAllProducts() {
        if ($this->request->is(['get','ajax'])) {
            $products = $this->Products->find()->toArray();
            $this->responData['status'] = 200;
            $this->responData['data'] = $products;
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->set(compact('json'));
    }

    public function getDetailProduct() {
        if ($this->request->is(['get','ajax'])) {
            $id = $this->request->getQuery('product');
            $products = $this->Products->find()
                        ->contain(['Brands', 'ProductCategories'])
                        ->where(['Products.id' => $id])
                        ->first();

            $this->responData['status'] = 200;
            $this->responData['data'] = $products;
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->set(compact('json'));
    }

}
