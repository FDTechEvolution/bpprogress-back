<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;

/**
 * SvUsers Controller
 *
 *
 * @method \App\Model\Entity\SvUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SvUsersController extends AppController {

    public $responData = ['status' => 403, 'msg' => '', 'data' => []];
    public $Users = null;
    public $Addresses = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Users = TableRegistry::get('Users');
        $this->Addresses = TableRegistry::get('Addresses');

        $this->autoRender = false;
    }

    public function getUser($id = null) {
        $user = $this->Users->find()
                ->contain(['Addresses'])
                ->where(['Users.id' => $id])
                ->first();

        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');

        $this->responData = ['status' => 200, 'msg' => '', 'data' => $user];

        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

    public function saveAddress() {
        if ($this->request->is(['POST', 'PUT', 'AJAX'])) {
            $postData = $this->request->getData();
            $address = $this->Addresses->newEntity();

            $address = $this->Addresses->patchEntity($address, $postData);
            $this->Addresses->save($address);
            $this->responData = ['status' => 200, 'msg' => '', 'data' => $address];
        }

        $this->modifyHeader();
        $this->RequestHandler->respondAs('json');



        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->response = $this->response->withStringBody($json);
        $this->response = $this->response->withType('json');

        return $this->response;
    }

}
