<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Shops Controller
 *
 * @property \App\Model\Table\ShopsTable $Shops
 *
 * @method \App\Model\Entity\Shop[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ShopsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $shops = $this->paginate($this->Shops);

        $this->set(compact('shops'));
    }

    /**
     * View method
     *
     * @param string|null $id Shop id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $shop = $this->Shops->get($id, [
            'contain' => ['Users', 'Warehouses'],
        ]);

        $this->set('shop', $shop);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $shop = $this->Shops->newEntity();
        if ($this->request->is('post')) {
            $shop = $this->Shops->patchEntity($shop, $this->request->getData());
            if ($this->Shops->save($shop)) {
                $this->Flash->success(__('The shop has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shop could not be saved. Please, try again.'));
        }
        $users = $this->Shops->Users->find('list', ['limit' => 200]);
        $this->set(compact('shop', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Shop id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $shop = $this->Shops->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $shop = $this->Shops->patchEntity($shop, $this->request->getData());
            if ($this->Shops->save($shop)) {
                $this->Flash->success(__('The shop has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shop could not be saved. Please, try again.'));
        }
        $users = $this->Shops->Users->find('list', ['limit' => 200]);
        $this->set(compact('shop', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Shop id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $shop = $this->Shops->get($id);
        if ($this->Shops->delete($shop)) {
            $this->Flash->success(__('The shop has been deleted.'));
        } else {
            $this->Flash->error(__('The shop could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
