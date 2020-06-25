<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController {

    public $WholesaleRates = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Warehouses = TableRegistry::get('Warehouses');
        $this->WarehouseProducts = TableRegistry::get('WarehouseProducts');
        $this->GoodsLines = TableRegistry::get('GoodsLines');
        $this->GoodsTransactions = TableRegistry::get('GoodsTransactions');
        $this->OrderLines = TableRegistry::get('OrderLines');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Brands', 'ProductCategories'],
        ];
        $products = $this->paginate($this->Products);

        $brands = $this->Products->Brands->find('list', ['limit' => 200]);
        $productCategories = $this->Products->ProductCategories->find('list', ['limit' => 200]);
        $this->set(compact('products', 'brands', 'productCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $product = $this->Products->get($id, [
            'contain' => ['Brands', 'ProductCategories', 'GoodsLines', 'ProductImages', 'WholesaleRates'],
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            // $this->log($product, 'debug');
            $product = $this->Products->patchEntity($product, $this->request->getData());
            $user = $this->MyAuthen->getLogedUser();
            $product->shop_id = $user['shop_id'];

            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'update', $product->id]);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $brands = $this->Products->Brands->find('list', ['limit' => 200]);
        $productCategories = $this->Products->ProductCategories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'brands', 'productCategories'));
    }

    public function uploadproductimage($id = null) {
        $postData = $this->request->getData();

        if ($this->request->is(['post', 'ajax'])) {
            foreach ($postData as $pdata) {
                $this->log($pdata, 'debug');
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function update($id = null) {

        $product = $this->Products->find()
                ->contain([
                    'ProductImages' => [
                        'Images',
                        'sort' => ['ProductImages.type' => 'ASC']
                    ], 'WholesaleRates', 'PreorderRates'
                ])
                ->where(['Products.id' => $id])
                ->first();
        //$this->log($product,'debug');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            //$this->log($postData, 'debug');
            if (isset($postData['isactive']) && $postData['isactive'] != 'Y') {
                $postData['isactive'] = 'N';
            }
            if (isset($postData['isretail']) && $postData['isretail'] != 'Y') {
                $postData['isretail'] = 'N';
            }
            if (isset($postData['iswholesale']) && $postData['iswholesale'] != 'Y') {
                $postData['iswholesale'] = 'N';
            }
            if (isset($postData['ispreorder']) && $postData['ispreorder'] != 'Y') {
                $postData['ispreorder'] = 'N';
            }
            $product = $this->Products->patchEntity($product, $postData);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                //Wholesales
                $this->wholesalesPrice($id, $postData['wholesales']);

                //Preorders
                $this->preorderPrice($id, $postData['preorders']);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $brands = $this->Products->Brands->find('list', ['limit' => 200]);
        $productCategories = $this->Products->ProductCategories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'brands', 'productCategories'));
    }

    private function wholesalesPrice($productId = null, $wholesales = []) {
        $this->WholesaleRates = TableRegistry::get('WholesaleRates');

        $result = $this->WholesaleRates->deleteAll(['WholesaleRates.product_id' => $productId]);

        foreach ($wholesales['startqty'] as $index => $startQty) {
            $endQty = $wholesales['endqty'][$index];
            $price = $wholesales['price'][$index];

            $wholesale = $this->WholesaleRates->newEntity();
            $wholesale->seq = $index;
            $wholesale->startqty = is_null($startQty) || $startQty == '' ? 0 : $startQty;
            $wholesale->endqty = is_null($endQty) || $endQty == '' ? 0 : $endQty;
            $wholesale->price = is_null($price) || $price == '' ? 0 : $price;
            $wholesale->product_id = $productId;

            $this->WholesaleRates->save($wholesale);
        }
    }

    private function preorderPrice($productId = null, $preorders = []) {
        $this->PreorderRates = TableRegistry::get('PreorderRates');

        $result = $this->PreorderRates->deleteAll(['PreorderRates.product_id' => $productId]);

        foreach ($preorders['startqty'] as $index => $startQty) {
            $endQty = $preorders['endqty'][$index];
            $price = $preorders['price'][$index];

            $preorder = $this->PreorderRates->newEntity();
            $preorder->seq = $index;
            $preorder->startqty = is_null($startQty) || $startQty == '' ? 0 : $startQty;
            $preorder->endqty = is_null($endQty) || $endQty == '' ? 0 : $endQty;
            $preorder->price = is_null($price) || $price == '' ? 0 : $price;
            $preorder->product_id = $productId;

            $this->PreorderRates->save($preorder);
        }
    }

    public function setqty() {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            $id = $postData['productID'];
            $Product = $this->Products->get($id, [
                'contain' => [],
            ]);

            $Product->qty = $postData['qty'];
            if ($this->Products->save($Product)) {
                $this->Flash->success(__('The product brand has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product brand could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }

    public function setprice() {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            $this->log($postData, 'debug');
            $id = $postData['productID'];
            $Product = $this->Products->get($id, [
                'contain' => [],
            ]);

            $Product->price = $postData['price'];
            $Product->special_price = $postData['special_price'];
            if ($this->Products->save($Product)) {
                $this->Flash->success(__('The product brand has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product brand could not be saved. Please, try again.'));
        }
        $this->set(compact('brand'));
    }

    public function status() {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            $id = $postData['productID'];
            if (isset($postData['isactive']) && $postData['isactive'] != 'Y') {
                $postData['isactive'] = 'N';
            }
            $Product = $this->Products->get($id, [
                'contain' => [],
            ]);

            $Product->isactive = $postData['isactive'];
            if ($this->Products->save($Product)) {
                $this->Flash->success(__('The product brand has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product brand could not be saved. Please, try again.'));
        }
        $this->set(compact('brand'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $orderline = $this->OrderLines->find()->where(['product_id' => $id])->first();
        $product = $this->Products->get($id);
        $product_name = $product->name;
        if(is_null($orderline)) {
            $this->WholesaleRates = TableRegistry::get('WholesaleRates');
            $this->PreorderRates = TableRegistry::get('PreorderRates');

            if ($this->Products->delete($product)) {
                $warehouseproducts = $this->WarehouseProducts->deleteAll(['WarehouseProducts.product_id' => $id]);
                $warehouserates = $this->WholesaleRates->deleteAll(['WholesaleRates.product_id' => $id]);
                $preorderrates = $this->PreorderRates->deleteAll(['PreorderRates.product_id' => $id]);
                
                $goodslines = $this->GoodsLines->find()->where(['product_id' => $id])->toArray();
                foreach($goodslines as $goodsline) {
                    $goodstransaction = $this->GoodsTransactions->find()->where(['id' => $goodsline->goods_transaction_id])->first();
                    $this->GoodsTransactions->delete($goodstransaction);
                    $this->GoodsLines->delete($goodsline);
                }
                $this->Flash->success(__('สินค้า "'.$product_name.'" ถูกลบแล้ว'));
            } else {
                $this->Flash->error(__('The product could not be deleted. Please, try again.'));
            }
        }else{
            $this->Flash->error(__('ไม่สามารถลบสินค้า "'.$product_name.'" ได้ เนื่องจากสินค้ามีประวัติการสั่งซื้อ...กรุณาปิดการแสดงผลแทนการลบสินค้า'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
