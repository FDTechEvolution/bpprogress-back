
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
                            <td>
                                <?= $this->Html->link($order->docno, ['controller' => 'orders', 'action' => 'view', $order->id]) ?>

                            </td>
                            <td><?= $order->user->fullname ?></td>
                            <td><?= $orderStatus[$order->status] ?></td>
                            <td><?= $order->shipping->name ?></td>
                            <td>
                                <?= $order->trackingno ?>
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-edit-tracking" data-whatever="<?= $order->trackingno ?>" data-id="<?= $order->id ?>"><i class="far fa-edit"></i>แก้ไข</a>

                            </td>
                            <td class="text-right">
                                <button class="btn btn-sm btn-icon waves-effect btn-outline-secondary" data-action="update-status" data-id="<?= $order->id ?>" data-status="RECEIVED" typ="button"> รับสินค้าแล้ว </button>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-center" id="modal-edit-tracking" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">แก้ไขหมายเลขพัสดุ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('order', ['url' => ['controller' => 'orders', 'action' => 'update-tracking']]) ?>
                <?= $this->Form->hidden('order_id', ['id' => 'order_id']) ?>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">หมายเลขพัสดุ:</label>
                    <input type="text" class="form-control" id="trackingno" name="trackingno">
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary">บันทึก</button>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<?= $this->Form->create('order', ['id' => 'frm-order']) ?>
<?= $this->Form->hidden('order_id', ['id' => 'id']) ?>
<?= $this->Form->hidden('status', ['id' => 'status']) ?>
<?= $this->Form->end() ?>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


<script>
    $(document).ready(function () {
        $('[data-action="update-status"]').on('click', function () {
            var order_id = $(this).attr('data-id');
            var status = $(this).attr('data-status');

            $('#id').val(order_id);
            $('#status').val(status);
            $('#frm-order').submit();
        });


    });

    $('#modal-edit-tracking').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var trackingno = button.data('whatever') // Extract info from data-* attributes
        var order_id = button.data('id');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        //modal.find('.modal-title').text('New message to ' + recipient);
        modal.find('#trackingno').val(trackingno);
        modal.find('#order_id').val(order_id);
    })

</script>