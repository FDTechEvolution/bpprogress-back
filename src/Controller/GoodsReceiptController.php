<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Goods-receipt Controller
 *
 *
 * @method \App\Model\Entity\Goods-receipt[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GoodsReceiptController extends AppController {

    public $Warehouses = NULL;
    public $GoodsTransactions = NULL;
    public $GoodsLines = null;
    public $Products = NULL;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Warehouses = TableRegistry::get('Warehouses');
        $this->GoodsTransactions = TableRegistry::get('GoodsTransactions');
        $this->Products = TableRegistry::get('Products');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $userId = $this->MyAuthen->getLogedUserId();
        $goodsReceipts = $this->GoodsTransactions->find()
                ->contain(['Warehouses'])
                ->where(['GoodsTransactions.user_id' => $userId])
                ->toArray();

        $this->set(compact('goodsReceipts'));
    }

    public function add() {

        if ($this->request->is(['POST'])) {
            $receipt = $this->GoodsTransactions->newEntity();
            $postData = $this->request->getData();
            $receipt = $this->GoodsTransactions->patchEntity($receipt, $postData);
            $receipt->docdate = $this->Utils->adMDYToYMD($postData['docdate']);
            $receipt->docno = $this->Utils->generateNormalDocNo('GR');
            $receipt->user_id = $this->MyAuthen->getLogedUserId();

            if ($this->GoodsTransactions->save($receipt)) {

                return $this->redirect(['controller' => 'goods-receipt', 'action' => 'update', $receipt->id]);
            } else {
                $this->log($receipt->getErrors(), 'debug');
            }
        }


        $warehouses = $this->Warehouses->find('list');

        $this->set(compact('warehouses'));
    }

    public function update($id = null) {
        $goodsReceipt = $this->GoodsTransactions->find()
                ->contain(['Warehouses', 'GoodsLines' => ['Products' => ['ProductImages' => ['Images']]]])
                ->where(['GoodsTransactions.id' => $id])
                ->first();

        if ($this->request->is(['POST', 'PUT'])) {
            $postData = $this->request->getData();

            $goodsReceipt->description = $postData['description'];
            $this->GoodsTransactions->save($goodsReceipt);

            $lines = isset($postData['lines']) ? $postData['lines'] : [];
            $this->goodsLine($id, $lines);
            return $this->redirect(['controller' => 'goods-receipt', 'action' => 'update', $id]);
        }


        $warehouses = $this->Warehouses->find('list');
        $products = $this->Products->find()
                ->contain(['ProductImages' => ['Images']])
                ->toArray();

        $this->set(compact('goodsReceipt', 'warehouses', 'products'));
    }

    private function goodsLine($goodsTransactionId = NULL, $lines = []) {
        $this->GoodsLines = TableRegistry::get('GoodsLines');

        $result = $this->GoodsLines->deleteAll(['GoodsLines.goods_transaction_id' => $goodsTransactionId]);

        if (sizeof($lines) == 0) {
            return null;
        }

        foreach ($lines['qty'] as $index => $item) {
            $goodsLine = $this->GoodsLines->newEntity();
            $goodsLine->goods_transaction_id = $goodsTransactionId;
            $goodsLine->product_id = $lines['product_id'][$index];
            $goodsLine->qty = $lines['qty'][$index];

            $this->GoodsLines->save($goodsLine);
        }
    }

    public function confirm($id = null) {
        $goodsReceipt = $this->GoodsTransactions->find()
                ->contain(['Warehouses', 'GoodsLines' => ['Products' => ['ProductImages' => ['Images']]]])
                ->where(['GoodsTransactions.id' => $id])
                ->first();

        if ($this->request->is(['POST', 'PUT'])) {
            $postData = $this->request->getData();
            $goodsReceipt->status = $postData['status'];
            $this->GoodsTransactions->save($goodsReceipt);
            
            return $this->redirect(['action'=>'confirm',$id]);
        }

        $this->set(compact('goodsReceipt'));
    }

}
