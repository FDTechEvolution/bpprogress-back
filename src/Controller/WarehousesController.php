<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Warehouses Controller
 *
 * @property \App\Model\Table\WarehousesTable $Warehouses
 *
 * @method \App\Model\Entity\Warehouse[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WarehousesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Shops']
        ];
        $warehouses = $this->paginate($this->Warehouses);

        $user = $this->MyAuthen->getLogedUser();
        $this->set(compact('warehouses','user'));
    }

    /**
     * View method
     *
     * @param string|null $id Warehouse id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {

        $warehouse = $this->Warehouses->find()
                ->contain(['WarehouseProducts' => ['Products']])
                ->where(['Warehouses.id' => $id])
                ->first();

        $this->set('warehouse', $warehouse);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $warehouse = $this->Warehouses->newEntity();
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $warehouse_name = $postData['name'];
            $checkNameDuplicate = $this->Warehouses->find()->where(['name' => $warehouse_name, 'shop_id' => $postData['shop_id']])->first();
            if (!is_null($checkNameDuplicate)) {
                echo "<script>alert('คลังสินค้า $warehouse_name มีอยู่ในระบบแล้ว...กรุณาตรวจสอบ');</script>";
                echo "<script>setTimeout('window.location.href=\"index\";', 0)</script>";
            } else {
                $warehouse = $this->Warehouses->patchEntity($warehouse, $this->request->getData());
                if ($this->Warehouses->save($warehouse)) {
                    $this->Flash->success(__('The warehouse has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The warehouse could not be saved. Please, try again.'));
            }
        }
        $user = $this->MyAuthen->getLogedUser();
        //$shops = $this->Warehouses->Shops->find('list', ['limit' => 200]);
        $this->set(compact('warehouse', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Warehouse id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit() {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            $this->log($postData, 'debug');
            $id = $postData['WH_ID'];
            $warehouse_name = $postData['name'];
            $warehouse = $this->Warehouses->get($id, [
                'contain' => [],
            ]);

            $checkNameDuplicate = $this->Warehouses->find()->where(['name' => $warehouse_name, 'id !=' => $id, 'shop_id' => $postData['shop_id']])->first();
            if (!is_null($checkNameDuplicate)) {
                echo "<script>alert('คลังสินค้า $warehouse_name มีอยู่ในระบบแล้ว...กรุณาตรวจสอบ');</script>";
                echo "<script>setTimeout('window.location.href=\"index\";', 0)</script>";
            } else {
                $warehouse = $this->Warehouses->patchEntity($warehouse, $this->request->getData());
                if ($this->Warehouses->save($warehouse)) {
                    $this->Flash->success(__('The warehouse has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The warehouse could not be saved. Please, try again.'));
            }
        }
        $shops = $this->Warehouses->Shops->find('list', ['limit' => 200]);
        $this->set(compact('warehouse', 'shops'));
    }

    public function status() {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            $id = $postData['WH_ID'];
            $Warehouse = $this->Warehouses->get($id, [
                'contain' => [],
            ]);

            $Warehouse->isactive = $postData['isactive'];
            if ($this->Warehouses->save($Warehouse)) {
                $this->Flash->success(__('The warehouse has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The warehouse could not be saved. Please, try again.'));
        }
        $this->set(compact('Warehouse'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Warehouse id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $warehouse = $this->Warehouses->get($id);
        if ($this->Warehouses->delete($warehouse)) {
            $this->Flash->success(__('The warehouse has been deleted.'));
        } else {
            $this->Flash->error(__('The warehouse could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
