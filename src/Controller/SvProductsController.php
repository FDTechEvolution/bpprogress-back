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
    }

    public function getAllProducts() {
        if ($this->request->is(['get','ajax'])) {
            // $allProducts = [];
            $products = $this->Products->find()->toArray();
            // array_push($this->responData['data'],$products);
            foreach($products as $index => $product) {
                $product_imgs = $this->ProductImages->find()
                                ->contain(['Images'])
                                ->where(['ProductImages.product_id' => $product->id])
                                ->toArray();
                foreach($product_imgs as $product_img){
                    $products[$index]['images'] = $product_img->image->fullpath;
                }
                // array_push($this->responData['data'], $product_imgs);
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
                $product_imgs = $this->ProductImages->find()
                                ->contain(['Images'])
                                ->where(['ProductImages.product_id' => $products->id])
                                ->toArray();
                foreach($product_imgs as $product_img){
                    $products['images'] = $product_img->image->fullpath;
                }
            }

            $this->responData['status'] = 200;
            $this->responData['data'] = $products;
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->set(compact('json'));
    }

}
