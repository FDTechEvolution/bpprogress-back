<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProductCategories Controller
 *
 * @property \App\Model\Table\ProductCategoriesTable $ProductCategories
 *
 * @method \App\Model\Entity\ProductCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $productCategories = $this->paginate($this->ProductCategories);

        $this->set(compact('productCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Product Category id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productCategory = $this->ProductCategories->get($id, [
            'contain' => ['Products'],
        ]);

        $this->set('productCategory', $productCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productCategory = $this->ProductCategories->newEntity();
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $cate_name = $postData['name'];
            $checkNameDuplicate = $this->ProductCategories->find()->where(['name' => $postData['name']])->first();
            if(!is_null($checkNameDuplicate)){
                echo "<script>alert('ประเภทสินค้า $cate_name มีอยู่ในระบบแล้ว...กรุณาตรวจสอบ');</script>";
                echo "<script>setTimeout('window.location.href=\"index\";', 0)</script>";
            }else{
                $productCategory = $this->ProductCategories->patchEntity($productCategory, $postData);
                if ($this->ProductCategories->save($productCategory)) {
                    $this->Flash->success(__('The product category has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The product category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('productCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            $id = $postData['cateID'];
            $cate_name = $postData['name'];
            $productCategory = $this->ProductCategories->get($id, [
                'contain' => [],
            ]);

            $checkNameDuplicate = $this->ProductCategories->find()->where(['name' => $cate_name, 'id !=' => $id])->first();
            if(!is_null($checkNameDuplicate)){
                echo "<script>alert('ประเภทสินค้า $cate_name มีอยู่ในระบบแล้ว...กรุณาตรวจสอบ');</script>";
                echo "<script>setTimeout('window.location.href=\"index\";', 0)</script>";
            }else{
                $productCategory = $this->ProductCategories->patchEntity($productCategory, $this->request->getData());
                if ($this->ProductCategories->save($productCategory)) {
                    $this->Flash->success(__('The product category has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The product category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('productCategory'));
    }

    public function status()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            $this->log($postData, 'debug');
            $id = $postData['cateID'];
            $productCategory = $this->ProductCategories->get($id, [
                'contain' => [],
            ]);

            $productCategory->isactive = $postData['isactive'];
            if ($this->ProductCategories->save($productCategory)) {
                $this->Flash->success(__('The product category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product category could not be saved. Please, try again.'));
        }
        $this->set(compact('productCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productCategory = $this->ProductCategories->get($id);
        if ($this->ProductCategories->delete($productCategory)) {
            $this->Flash->success(__('The product category has been deleted.'));
        } else {
            $this->Flash->error(__('The product category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
