<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * SvProductImages Controller
 *
 *
 * @method \App\Model\Entity\SvProductImage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SvProductImagesController extends AppController {

    public $Products = null;
    public $ProductImages = null;
    public $Images = null;
    public $responData = ['status' => 403, 'msg' => '', 'data' => []];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('json');

        $this->Products = TableRegistry::get('Products');
        $this->ProductImages = TableRegistry::get('ProductImages');
        $this->Images = TableRegistry::get('Images');
    }

    public function uploadProductImage() {
        $this->loadComponent('UploadImage');
        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            //$this->log($postData, 'debug');
            $file = $postData['image_file'];
            $productId = $postData['product_id'];
            if (!is_null($file['name']) && $file['name'] != '') {
                $result = $this->UploadImage->upload($file, '', null, null, 'products' . DS);
                //$this->log($result,'debug');

                $image = $this->Images->newEntity();
                $image->fullpath = $result['url'];
                $image->path = $result['image_path'];
                $image->name = $result['image_name'];
                $this->Images->save($image);

                $productImage = $this->ProductImages->newEntity();
                $productImage->product_id = $productId;
                $productImage->image_id = $image->id;
                $productImage->type = 'NORMAL';
                $productImage->seq = 1;
                $this->ProductImages->save($productImage);

                $this->responData['status'] = 200;
                $this->responData['data'] = $image;
            }
        }
        $json = json_encode($this->responData);
        $this->set(compact('json'));
    }

}
