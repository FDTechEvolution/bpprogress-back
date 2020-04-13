<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
 * SvRegisters Controller
 *
 *
 * @method \App\Model\Entity\SvRegister[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SvRegistersController extends AppController
{

    public $Users = NULL:
    public $responData = ['status'=>200,'msg'=>'','data'=>[]];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('ajax');

        $this->Users = TableRegistry::get('Users');
    }

    public function register(){

        if ($this->request->is('ajax')) {
            
            $this->responData['data'] = [];
        }


        $json = json_encode($this->responData, JSON_UNESCAPED_UNICODE);
        $this->set(compact('json'));
    }
}
