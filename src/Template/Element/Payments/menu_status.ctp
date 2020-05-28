
<?=$this->Html->link('รายการใหม่ <span id="notis-bt-new-payment"></span>',['controller'=>'payments','action'=>'index','status'=>'NEW'],['class'=>$status == 'NEW' ? 'btn btn-primary mr-2' : 'btn btn-outline-secondary mr-2','escape'=>false])?>
<?=$this->Html->link('ยืนยันแล้ว <span id="notis-bt-cf-payment"></span>',['controller'=>'payments','action'=>'index','status'=>'CF'],['class'=>$status == 'CF' ? 'btn btn-primary mr-2' : 'btn btn-outline-secondary mr-2','escape'=>false])?>
