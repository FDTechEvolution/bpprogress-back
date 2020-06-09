<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * SvProductCategories Controller
 *
 *
 * @method \App\Model\Entity\SvProductCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SvProductCategoriesController extends AppController {

    public $responData = ['status' => 403, 'msg' => '', 'data' => []];
    public $ProductCategories = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('json');

        $this->ProductCategories = TableRegistry::get('ProductCategories');

        $this->autoRender = false;
    }

    public function index() {
        
        $productCategories = $this->ProductCategories->find()->where(['isactive'=>'Y'])->order(['name'=>'ASC'])->toArray();
        $this->responData = ['status' => 200, 'msg' => '', 'data' => $productCategories];
        
        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

}
