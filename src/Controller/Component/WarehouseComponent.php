<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * Warehouse component
 */
class WarehouseComponent extends Component {

    public $Warehouses = NULL;
    public $GoodsTransactions = NULL;
    public $GoodsLines = null;
    public $Products = NULL;
    public $WarehouseProducts = null;
    public $Orders = NULL;
    public $UsedWarehouses = NULL;

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function updateByGoodsRceipt($goodsReceiptId = null) {
        $this->Warehouses = TableRegistry::get('Warehouses');
        $this->GoodsTransactions = TableRegistry::get('GoodsTransactions');
        $this->Products = TableRegistry::get('Products');
        $this->WarehouseProducts = TableRegistry::get('WarehouseProducts');

        $goodsReceipt = $this->GoodsTransactions->find()
                ->contain(['Warehouses', 'GoodsLines' => ['Products' => ['ProductImages' => ['Images']]]])
                ->where(['GoodsTransactions.id' => $goodsReceiptId])
                ->first();

        $lines = $goodsReceipt->goods_lines;

        foreach ($lines as $index => $line) {
            $warehouseLine = $this->WarehouseProducts->find()->where(['WarehouseProducts.product_id' => $line->product_id, 'WarehouseProducts.warehouse_id' => $goodsReceipt->warehouse_id])->first();
            if (is_null($warehouseLine)) {
                $warehouseLine = $this->WarehouseProducts->newEntity();
                $warehouseLine->warehouse_id = $goodsReceipt->warehouse_id;
                $warehouseLine->product_id = $line->product_id;
                $warehouseLine->qty = $line->qty;
            } else {
                $currentQty = $warehouseLine->qty;
                $warehouseLine->qty = $currentQty + $line->qty;
            }

            $this->WarehouseProducts->save($warehouseLine);

            $this->updateProductQtyById($line->product_id);
        }
    }

    public function updateByOrder($orderId = null) {
        $this->Orders = TableRegistry::get('Orders');
        $this->UsedWarehouses = TableRegistry::get('UsedWarehouses');
        $this->WarehouseProducts = TableRegistry::get('WarehouseProducts');
        
        $order = $this->Orders->find()
                ->contain(['OrderLines'])
                ->where(['Orders.id' => $orderId])
                ->first();
        $orderLines = $order->order_lines;
        foreach ($orderLines as $orderLine) {
            $usedQty = $orderLine['qty'];
            $result = $this->checkStockByProduct($orderLine['product_id'], $usedQty);

            //update warehouse
            $warehouses = $result['warehouse'];
            foreach ($warehouses as $warehouse) {
                $warehouseLine = $this->WarehouseProducts->find()
                        ->where(['WarehouseProducts.product_id' => $orderLine->product_id, 'WarehouseProducts.warehouse_id' => $warehouse['warehouse_product']['warehouse_id']])
                        ->first();
                $currentQty = $warehouseLine->qty;
                $warehouseLine->qty = $currentQty - $warehouse['use_qty'];

                $this->WarehouseProducts->save($warehouseLine);

                $this->updateProductQtyById($orderLine->product_id);

                //Create used warehouse
                $usedWarehouse = $this->UsedWarehouses->newEntity();
                $usedWarehouse->warehouse_id = $warehouseLine['warehouse_id'];
                $usedWarehouse->order_line_id = $orderLine['id'];
                $usedWarehouse->qty = $warehouse['use_qty'];
                $this->UsedWarehouses->save($usedWarehouse);
            }
        }
    }

    public function updateWarehuseProductQty($warehouseId = null, $productId = null, $usedQty = 1, $status = 'NEW') {
        $this->WarehouseProducts = TableRegistry::get('WarehouseProducts');
        
        if ($status == 'VOID') {
            $warehouseLine = $this->WarehouseProducts->find()
                    ->where(['WarehouseProducts.product_id' => $productId, 'WarehouseProducts.warehouse_id' => $warehouseId])
                    ->first();
            $currentQty = $warehouseLine->qty;
            $warehouseLine->qty = $currentQty + $usedQty;

            $this->WarehouseProducts->save($warehouseLine);

            $this->updateProductQtyById($productId);
        }
    }

    public function updateProductQtyById($id = null) {
        $this->WarehouseProducts = TableRegistry::get('WarehouseProducts');
        $warehouseLines = $this->WarehouseProducts->find()->where(['WarehouseProducts.product_id' => $id])->toArray();

        $qtyamt = 0;

        foreach ($warehouseLines as $index => $line) {
            $qtyamt += $line->qty;
        }

        $this->Products = TableRegistry::get('Products');
        $product = $this->Products->get($id);
        $product->qty = $qtyamt;

        $this->Products->save($product);

        return $product;
    }

    public function checkStockByProduct($productId = NULL, $useQty = 0) {
        $this->WarehouseProducts = TableRegistry::get('WarehouseProducts');
        $this->Products = TableRegistry::get('Products');

        $result = [
            'use_qty' => $useQty,
            'status' => true
        ];

        $product = $this->Products->find()
                ->contain(['WarehouseProducts'])
                ->where(['Products.id' => $productId])
                ->first();
        if ($useQty > $product['qty']) {
            $result['status'] = false;
            return $result;
        }

        $usedWarehouse = [];
        $isOk = false;

        foreach ($product->warehouse_products as $item) {
            if ($isOk) {
                break;
            }

            if ($useQty > $item['qty']) {
                $useQty = $useQty - $item['qty'];
                array_push($usedWarehouse, ['warehouse_product' => $item, 'use_qty' => $item['qty']]);
            } else {
                array_push($usedWarehouse, ['warehouse_product' => $item, 'use_qty' => $useQty]);
                $isOk = true;
            }
        }

        $result['warehouse'] = $usedWarehouse;
        return $result;
    }

}
