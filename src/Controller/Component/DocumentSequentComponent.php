<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * DocumentSequent component
 */
class DocumentSequentComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $_docStatus = [
        'DR'=>['label'=>'ฉบับร่าง','action_label'=>'ฉบับร่าง'],
        'CF'=>['label'=>'ยืนยัน/สมบูรณ์','action_label'=>'ยืนยัน'],
        'VO'=>['label'=>'ยกเลิก','action_label'=>'ยกเลิก'],
    ];
    
    public function getDocumentStatus(){
        return $this->_docStatus;
    }
}
