
<?=$this->Html->link('คำสั่งซื้อใหม่',['controller'=>'orders','action'=>'index'],['class'=>$status == 'NEW' ? 'btn btn-primary mr-2' : 'btn btn-outline-secondary mr-2'])?>
<?=$this->Html->link('รอจัดส่ง',['controller'=>'orders','action'=>'waiting-delivery'],['class'=>$status == 'WT' ? 'btn btn-primary mr-2' : 'btn btn-outline-secondary mr-2'])?>
<?=$this->Html->link('ส่งแล้ว',['controller'=>'orders','action'=>'index'],['class'=>$status == 'SENT' ? 'btn btn-primary mr-2' : 'btn btn-outline-secondary mr-2'])?>
<?=$this->Html->link('รับสินค้าแล้ว',['controller'=>'orders','action'=>'index'],['class'=>$status == 'RECEIPT' ? 'btn btn-primary mr-2' : 'btn btn-outline-secondary mr-2'])?>