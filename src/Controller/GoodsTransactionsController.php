<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GoodsTransactions Controller
 *
 * @property \App\Model\Table\GoodsTransactionsTable $GoodsTransactions
 *
 * @method \App\Model\Entity\GoodsTransaction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GoodsTransactionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Warehouses'],
        ];
        $goodsTransactions = $this->paginate($this->GoodsTransactions);

        $this->set(compact('goodsTransactions'));
    }

    /**
     * View method
     *
     * @param string|null $id Goods Transaction id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $goodsTransaction = $this->GoodsTransactions->get($id, [
            'contain' => ['Users', 'Warehouses', 'GoodsLines'],
        ]);

        $this->set('goodsTransaction', $goodsTransaction);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $goodsTransaction = $this->GoodsTransactions->newEntity();
        if ($this->request->is('post')) {
            $goodsTransaction = $this->GoodsTransactions->patchEntity($goodsTransaction, $this->request->getData());
            if ($this->GoodsTransactions->save($goodsTransaction)) {
                $this->Flash->success(__('The goods transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The goods transaction could not be saved. Please, try again.'));
        }
        $users = $this->GoodsTransactions->Users->find('list', ['limit' => 200]);
        $warehouses = $this->GoodsTransactions->Warehouses->find('list', ['limit' => 200]);
        $this->set(compact('goodsTransaction', 'users', 'warehouses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Goods Transaction id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $goodsTransaction = $this->GoodsTransactions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $goodsTransaction = $this->GoodsTransactions->patchEntity($goodsTransaction, $this->request->getData());
            if ($this->GoodsTransactions->save($goodsTransaction)) {
                $this->Flash->success(__('The goods transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The goods transaction could not be saved. Please, try again.'));
        }
        $users = $this->GoodsTransactions->Users->find('list', ['limit' => 200]);
        $warehouses = $this->GoodsTransactions->Warehouses->find('list', ['limit' => 200]);
        $this->set(compact('goodsTransaction', 'users', 'warehouses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Goods Transaction id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $goodsTransaction = $this->GoodsTransactions->get($id);
        if ($this->GoodsTransactions->delete($goodsTransaction)) {
            $this->Flash->success(__('The goods transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The goods transaction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
