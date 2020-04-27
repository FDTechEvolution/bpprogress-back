<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * SvGenerals Controller
 *
 *
 * @method \App\Model\Entity\SvGeneral[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SvGeneralsController extends AppController {

    public $Users = null;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $controllerName = $this->request->getParam('controller');
        $actionName = $this->request->getParam('action');

        $this->Users = TableRegistry::get('Users');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function getMenuAccess($userId = null) {
        $menus = [
            'NORMAL' => [
                
            ],
            'SELLER' => [],
            'ADMIN' => []
        ];

        $user = $this->Users->find()->where(['id' => $userId])->first();

        $menus = $menus[$user->type];


        return $menus;
    }

}
