
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">รายการคำสั่งซื้อ</h4> 
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <div class="col-12">
                    <?= $this->element('Orders/menu') ?>
                </div>
            </div>
            <hr/>
            <table cellpadding="0" cellspacing="0" id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>วันที่สั่งซื้อ</th>
                        <th>หมายเลขคำสั่งซื้อ</th>
                        <th>ลูกค้า</th>
                        <th>สถานะ</th>
                        <th>บริษัทขนส่ง</th>
                        <th>หมายเลขพัสดุ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $index => $order): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $order->docdate->i18nFormat(DATE_FORMATE, null, NULL) ?></td>
                            <td><?= $this->Html->link($order->docno, ['controller' => 'orders', 'action' => 'view', $order->id]) ?></td>
                            <td><?= $order->user->fullname ?></td>
                            <td><?= $orderStatus[$order->status] ?></td>
                            <td><?= $order->shipping->name ?></td>
                            <td><?= $order->trackingno ?></td>
                            <td class="text-right">
                                <button class="btn btn-sm btn-icon waves-effect btn-outline-secondary" data-action="update-status" data-id="<?= $order->id ?>" data-status="RECEIVED"> รับสินค้าแล้ว </button>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?= $this->Form->create('order', ['id' => 'frm-order']) ?>
<?= $this->Form->hidden('order_id', ['id' => 'order_id']) ?>
<?= $this->Form->hidden('status', ['id' => 'status']) ?>
<?= $this->Form->end() ?>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


<script>
    $(document).ready(function () {
        $('[data-action="update-status"]').on('click',function(){
            var order_id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            
            $('#order_id').val(order_id);
            $('#status').val(status);
            $('#frm-order').submit();
        });


    });

</script>