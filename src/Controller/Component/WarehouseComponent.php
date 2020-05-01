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
            $warehouseLine = $this->WarehouseProducts->find()->where(['WarehouseProducts.product_id' => $line->product_id])->first();
            if (is_null($warehouseLine)) {
                $warehouseLine = $this->WarehouseProducts->newEntity();
                $warehouseLine->warehouse_id = $goodsReceipt->warehouse_id;
                $warehouseLine->product_id = $line->product_id;
                $warehouseLine->qty = $line->qty;
            } else {
                $currentQty = $warehouseLine->qty;
                $warehouseLine->qty = $currentQty+$line->qty;
            }

            $this->WarehouseProducts->save($warehouseLine);

            $this->updateProductQtyById($line->product_id);
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

}
