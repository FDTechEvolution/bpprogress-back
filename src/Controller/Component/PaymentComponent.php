<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Payment component
 */
class PaymentComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $PaymentStatus = [
        'PAID' => 'ชำระเงินแล้ว',
        'NOTPAID' => 'ยังไม่ได้ชำระเงิน'
    ];
    
    public function getPaymentStatus(){
        return $this->PaymentStatus;
    }
}
