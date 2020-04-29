<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController {

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
            $product = $this->Products->patchEntity($product, $this->request->getData());
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
                ->contain(['ProductImages'=>['Images']])
                ->where(['Products.id'=>$id])
                ->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $brands = $this->Products->Brands->find('list', ['limit' => 200]);
        $productCategories = $this->Products->ProductCategories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'brands', 'productCategories'));
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
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
