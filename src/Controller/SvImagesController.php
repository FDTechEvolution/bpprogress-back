<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * SvImages Controller
 *
 *
 * @method \App\Model\Entity\SvImage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SvImagesController extends AppController {

    public $Images = null;
    public $responData = ['status' => 403, 'msg' => '', 'data' => []];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Images = TableRegistry::get('Images');

        $this->autoRender = false;
    }
    
    public function saveSlip(){
        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

        $this->loadComponent('UploadImage');
        if ($this->request->is(['post', 'ajax'])) {
            $postData = $this->request->getData();
            //$this->log($postData, 'debug');
            $file = $postData['image_file'];
            
            if (!is_null($file['name']) && $file['name'] != '') {
                $result = $this->UploadImage->upload($file, '', null, null, 'slips' . DS);
                //$this->log($result,'debug');

                $image = $this->Images->newEntity();
                $image->fullpath = $result['url'];
                $image->path = $result['image_path'];
                $image->name = $result['image_name'];
                $this->Images->save($image);

               

                $this->responData['status'] = 200;
                $this->responData['data'] = $image;
            }
        }

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

}
