<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Brands Controller
 *
 * @property \App\Model\Table\BrandsTable $Brands
 *
 * @method \App\Model\Entity\Brand[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BrandsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $brands = $this->paginate($this->Brands);

        $this->set(compact('brands'));
    }

    /**
     * View method
     *
     * @param string|null $id Brand id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $brand = $this->Brands->get($id, [
            'contain' => ['Products'],
        ]);

        $this->set('brand', $brand);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $brand = $this->Brands->newEntity();
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $brand_name = $postData['name'];
            $checkNameDuplicate = $this->Brands->find()->where(['name' => $postData['name']])->first();
            if(!is_null($checkNameDuplicate)){
                echo "<script>alert('ประเภทสินค้า $brand_name มีอยู่ในระบบแล้ว...กรุณาตรวจสอบ');</script>";
                echo "<script>setTimeout('window.location.href=\"index\";', 0)</script>";
            }else{
                $brand = $this->Brands->patchEntity($brand, $this->request->getData());
                if ($this->Brands->save($brand)) {
                    $this->Flash->success(__('The brand has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The brand could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('brand'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Brand id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            $id = $postData['brandID'];
            $brand_name = $postData['name'];
            $brand = $this->Brands->get($id, [
                'contain' => [],
            ]);

            $checkNameDuplicate = $this->Brands->find()->where(['name' => $brand_name, 'id !=' => $id])->first();
            if(!is_null($checkNameDuplicate)){
                echo "<script>alert('ยี่ห้อสินค้า $brand_name มีอยู่ในระบบแล้ว...กรุณาตรวจสอบ');</script>";
                echo "<script>setTimeout('window.location.href=\"index\";', 0)</script>";
            }else{
                $brand = $this->Brands->patchEntity($brand, $postData);
                if ($this->Brands->save($brand)) {
                    $this->Flash->success(__('The brand has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The brand could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('brand'));
    }

    public function status()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            $id = $postData['cateID'];
            $Brand = $this->Brands->get($id, [
                'contain' => [],
            ]);

            $Brands->isactive = $postData['isactive'];
            if ($this->Brands->save($Brand)) {
                $this->Flash->success(__('The product brand has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product brand could not be saved. Please, try again.'));
        }
        $this->set(compact('brand'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Brand id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $brand = $this->Brands->get($id);
        if ($this->Brands->delete($brand)) {
            $this->Flash->success(__('The brand has been deleted.'));
        } else {
            $this->Flash->error(__('The brand could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
