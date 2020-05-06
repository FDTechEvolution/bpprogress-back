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

        $this->autoRender = false;
    }

    public function uploadProductImage() {
        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

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

                $count = $this->ProductImages->find()->where(['product_id' => $productId])->count();
                $productImage = $this->ProductImages->newEntity();
                $productImage->product_id = $productId;
                $productImage->image_id = $image->id;
                $productImage->type = $count == 0 ? 'DEFAULT' : 'NORMAL';
                $productImage->seq = 1;
                $this->ProductImages->save($productImage);

                $this->responData['status'] = 200;
                $this->responData['data'] = $image;
            }
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

    public function deleteImage($productImageId = null) {
        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

        $productImage = $this->ProductImages->find()->where(['ProductImages.id' => $productImageId])->first();
        $image = $this->ProductImages->Images->find()->where(['Images.id' => $productImage->image_id])->first();

        $this->ProductImages->Images->delete($image, ['atomic' => false]);
        $this->ProductImages->delete($productImage, ['atomic' => false]);

        $this->responData['status'] = 200;
        $this->responData['data'] = [];

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

    public function setDefault($productImageId = null) {
        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');


        $productImage = $this->ProductImages->find()->where(['ProductImages.id' => $productImageId])->first();

        //$productImages = $this->ProductImages->find()->where(['ProductImages.product_id' => $productImage->product_id])->toArray();
        $query =  $this->ProductImages->query();
        $query->update()
                ->set(['type' => 'NORMAL'])
                ->where(['product_id' => $productImage->product_id])
                ->execute();

        $productImage = $this->ProductImages->find()->where(['ProductImages.id' => $productImageId])->first();
        $productImage->type = 'DEFAULT';
        $this->ProductImages->save($productImage);

        $this->responData['status'] = 200;
        $this->responData['data'] = $productImage;

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

}
