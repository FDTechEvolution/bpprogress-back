<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Database\Expression\QueryExpression;
use Cake\Datasource\ConnectionManager;
/**
 * SvProducts Controller
 *
 *
 * @method \App\Model\Entity\SvProduct[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SvProductsController extends AppController {

    public $Products = NULL;
    public $Connection = null;
    public $WholesaleRates = null;
    public $responData = ['status' => 403, 'msg' => '', 'data' => []];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('json');

        $this->Products = TableRegistry::get('Products');
        $this->ProductImages = TableRegistry::get('ProductImages');
        $this->WholesaleRates = TableRegistry::get('WholesaleRates');
        $this->Connection = ConnectionManager::get('default');
    }

    public function getAllProducts() {
        if ($this->request->is(['get', 'ajax'])) {
            $products = $this->Products->find()->where(['isactive' => 'Y'])->order(['created' => 'DESC'])->limit(20)->toArray();
            foreach ($products as $index => $product) {
                $product_img = $this->ProductImages->find()
                        ->contain(['Images'])
                        ->where(['ProductImages.product_id' => $product->id, 'ProductImages.type' => 'DEFAULT'])
                        ->first();
                if (!is_null($product_img)) {
                    $products[$index]['images'] = $product_img->image->fullpath;
                }
            }
            $this->responData['status'] = 200;
            $this->responData['data'] = $products;
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->set(compact('json'));
    }

    public function getDetailProduct() {
        if ($this->request->is(['get', 'ajax'])) {
            $id = $this->request->getQuery('product');
            $products = $this->Products->find()
                    ->contain(['Brands', 'ProductCategories'])
                    ->where(['Products.id' => $id])
                    ->first();
            if ($products) {
                $product_img = $this->ProductImages->find()
                        ->contain(['Images'])
                        ->where(['ProductImages.product_id' => $products->id, 'ProductImages.type' => 'DEFAULT'])
                        ->first();
                $products['images'] = $product_img->image->fullpath;

                if ($products->iswholesale == 'Y') {
                    $product_wholesales = $this->WholesaleRates->find()
                            ->where(['product_id' => $id])
                            ->order(['startqty' => 'ASC'])
                            ->toArray();
                    $products['wholesale_rate'] = $product_wholesales;
                }
            }

            $this->responData['status'] = 200;
            $this->responData['data'] = $products;
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->set(compact('json'));
    }

    public function getNewProducts() { // home new product ชั่วคราว
        $this->autoRender = false;
        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

        if ($this->request->is(['get', 'ajax'])) {
            $products = $this->Products->find()
                    ->contain([
                        'ProductImages' => function($q) {
                            return $q->contain(['Images'])
                                    ->where(['ProductImages.type' => 'DEFAULT']);
                        }
                    ])
                    ->where(['isactive' => 'Y'])
                    ->order(['created' => 'DESC'])
                    ->limit(10)
                    ->toArray();

            foreach ($products as $index => $product) {

                if (sizeof($product['product_images']) != 0) {
                    $products[$index]['image'] = $product['product_images'][0]['image']['fullpath'];
                } else {
                    $products[$index]['image'] = null;
                }
                if ($product['iswholesale'] == 'Y') {
                    $maxPrice = $this->WholesaleRates->find()
                            ->where(['WholesaleRates.product_id' => $product['id']])
                            ->order(['WholesaleRates.price' => 'DESC'])
                            ->first();

                    $minPrice = $this->WholesaleRates->find()
                            ->where(['WholesaleRates.product_id' => $product['id']])
                            ->order(['WholesaleRates.price' => 'ASC'])
                            ->first();
                    $products[$index]['wholesale_price'] = sprintf('%s-%s', number_format($minPrice['price']), number_format($maxPrice['price']));
                }
            }
            $this->responData['status'] = 200;
            $this->responData['data'] = $products;
        }


        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

    public function getProductCategory() {
        if ($this->request->is(['get', 'ajax'])) {
            $id = $this->request->getQuery('id');
            // $this->log($id, 'debug');
            $products = $this->Products->find()
                    ->contain(['ProductCategories'])
                    ->where(['ProductCategories.id' => $id, 'Products.isactive' => 'Y'])
                    ->order(['Products.created' => 'DESC'])
                    ->limit(20)
                    ->toArray();
            if ($products) {
                foreach ($products as $index => $product) {
                    $product_img = $this->ProductImages->find()
                            ->contain(['Images'])
                            ->where(['ProductImages.product_id' => $product->id, 'ProductImages.type' => 'DEFAULT'])
                            ->first();
                    $products[$index]['images'] = $product_img->image->fullpath;
                }
                $this->responData['status'] = 200;
                $this->responData['data'] = $products;
            } else {
                $this->responData['status'] = 400;
            }
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->set(compact('json'));
    }
    
    public function getTopViewProduct(){
        $this->autoRender = false;
        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');
        
        $limit = $this->request->getQuery('limit');
        if(!is_numeric($limit)){
            $limit =10;
        }
        
        $sql = 'select p.*,img.fullpath from products p left join product_images pimg on (p.id = pimg.product_id and pimg.type="DEFAULT") left join images img on pimg.image_id = img.id order by p.view_count DESC limit 10';
        $products = $this->Connection->execute($sql, ['limit' => $limit])->fetchAll('assoc');
        
        $this->responData['status'] = 200;
        $this->responData['data'] = $products;

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');


        return $this->response;
    }

    public function updateView() {
        $this->autoRender = false;
        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

        $productId = $this->request->getQuery('product');
        $expression = new QueryExpression('view_count = view_count + 1');
        $this->Products->updateAll([$expression], ['Products.id' => $productId]);

        $this->responData['status'] = 200;
        $this->responData['data'] = $productId;

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');


        return $this->response;
    }

}
