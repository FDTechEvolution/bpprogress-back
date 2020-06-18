<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * Product component
 */
class ProductComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $Products = null;
    public $WholesaleRates = null;

    public function getUnitPriceByQty($productId = null, $qty = 1, $preorder = null) {
        $this->Products = TableRegistry::get('Products');

        $product = $this->Products->find()->contain(['WholesaleRates'])->where(['Products.id' => $productId])->first();
        $unitPrice = 0;
        //$this->log($product,'debug');
        if (!is_null($product)) {

            if($preorder == 'N'){
                if ($product->iswholesale == 'Y') {
                    $unitPrice = $this->getWholesale($productId, $qty);
                } else {
                    $unitPrice = $product->special_price;
                }
            }else if($preorder == 'Y') {
                $unitPrice = $this->getPreordersale($productId, $qty);
            }
        }

        return $unitPrice;
    }

    private function getWholesale($productId = null, $qty = 1) {
        $unitPrice = 0;
        $this->WholesaleRates = TableRegistry::get('WholesaleRates');
        $wholesale = $this->WholesaleRates->find()
                ->where([
                    'WholesaleRates.endqty >=' => $qty,
                    'WholesaleRates.startqty <=' => $qty,
                    'WholesaleRates.product_id' => $productId
                ])
                ->first();

        if (is_null($wholesale)) {
            $maxEndWholesale = $this->WholesaleRates->find()
                    ->contain(['Products'])
                    ->where([
                        'WholesaleRates.product_id' => $productId
                    ])
                    ->order(['WholesaleRates.endqty'=>'DESC'])
                    ->first();
            $minStartWholesale = $this->WholesaleRates->find()
                    ->where([
                        'WholesaleRates.product_id' => $productId
                    ])
                    ->order(['WholesaleRates.startqty'=>'ASC'])
                    ->first();
            
            if($qty <$minStartWholesale->startqty){
                $unitPrice = $maxEndWholesale->product->special_price;
            }elseif($qty >$maxEndWholesale->endqty){
                $unitPrice = $maxEndWholesale->price;
            }else{
                $unitPrice = $maxEndWholesale->product->special_price;
            }
            
            
            
        } else {
            $unitPrice = $wholesale->price;
        }
        
        return $unitPrice;
    }

    private function getPreordersale($productId = null, $qty = 1) {
        $unitPrice = 0;
        $this->PreorderRates = TableRegistry::get('PreorderRates');
        $preorder = $this->PreorderRates->find()
                ->where([
                    'PreorderRates.endqty >=' => $qty,
                    'PreorderRates.startqty <=' => $qty,
                    'PreorderRates.product_id' => $productId
                ])
                ->first();

        if (is_null($preorder)) {
            $maxEndPreorder = $this->PreorderRates->find()
                    ->contain(['Products'])
                    ->where([
                        'PreorderRates.product_id' => $productId
                    ])
                    ->order(['PreorderRates.endqty'=>'DESC'])
                    ->first();
            $minStartPreorder = $this->PreorderRates->find()
                    ->where([
                        'PreorderRates.product_id' => $productId
                    ])
                    ->order(['PreorderRates.startqty'=>'ASC'])
                    ->first();
            
            if($qty <$minStartPreorder->startqty){
                $unitPrice = $maxEndPreorder->product->special_price;
            }elseif($qty >$maxEndPreorder->endqty){
                $unitPrice = $maxEndPreorder->price;
            }else{
                $unitPrice = $maxEndPreorder->product->special_price;
            }
            
            
            
        } else {
            $unitPrice = $preorder->price;
        }
        
        return $unitPrice;
    }

}
