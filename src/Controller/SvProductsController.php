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
        $this->ProductImages = TableRegistry::get('ProductImages');
        $this->Wholesales = TableRegistry::get('WholesaleRates');
    }

    public function getAllProducts() {
        if ($this->request->is(['get','ajax'])) {
            $products = $this->Products->find()->where(['isactive' => 'Y'])->order(['created' => 'DESC'])->limit(20)->toArray();
            foreach($products as $index => $product) {
                $product_img = $this->ProductImages->find()
                                ->contain(['Images'])
                                ->where(['ProductImages.product_id' => $product->id, 'ProductImages.type' => 'DEFAULT'])
                                ->first();
                $products[$index]['images'] = $product_img->image->fullpath;
            }
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
            if($products) {
                $product_img = $this->ProductImages->find()
                                ->contain(['Images'])
                                ->where(['ProductImages.product_id' => $products->id, 'ProductImages.type' => 'DEFAULT'])
                                ->first();
                $products['images'] = $product_img->image->fullpath;

                if($products->iswholesale == 'Y'){
                    $product_wholesales = $this->Wholesales->find()
                                        ->where(['product_id' => $id])
                                        ->order(['seq' => 'ASC'])
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
        if ($this->request->is(['get','ajax'])) {
            $products = $this->Products->find()->where(['isactive' => 'Y'])->order(['created' => 'DESC'])->limit(10)->toArray();
            foreach($products as $index => $product) {
                $product_img = $this->ProductImages->find()
                                ->contain(['Images'])
                                ->where(['ProductImages.product_id' => $product->id, 'ProductImages.type' => 'DEFAULT'])
                                ->first();
                $products[$index]['images'] = $product_img->image->fullpath;
            }
            $this->responData['status'] = 200;
            $this->responData['data'] = $products;
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->set(compact('json'));
    }

    public function getProductCategory () {
        if ($this->request->is(['get','ajax'])) {
            $id = $this->request->getQuery('id');
            // $this->log($id, 'debug');
            $products = $this->Products->find()
                        ->contain(['ProductCategories'])
                        ->where(['ProductCategories.id' => $id, 'Products.isactive' => 'Y'])
                        ->order(['Products.created' => 'DESC'])
                        ->limit(20)
                        ->toArray();
            if($products){
                foreach($products as $index => $product) {
                    $product_img = $this->ProductImages->find()
                                    ->contain(['Images'])
                                    ->where(['ProductImages.product_id' => $product->id, 'ProductImages.type' => 'DEFAULT'])
                                    ->first();
                    $products[$index]['images'] = $product_img->image->fullpath;
                }
                $this->responData['status'] = 200;
                $this->responData['data'] = $products;
            }else{
                $this->responData['status'] = 400;
            }
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->set(compact('json'));
    }

}
