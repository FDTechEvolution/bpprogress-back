
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
                    <?= $this->element('Orders/preorder_menu') ?>
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
                            <td><?= $order->shipping->name?></td>
                            <td><?= $order->trackingno?></td>
                            
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-center" id="modal-tracking" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">กรุณาระบุหมายเลขติดตามพัสดุ [Tracking No]</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('order', ['id' => 'frm-order']) ?>
                <?= $this->Form->hidden('order_id', ['id' => 'order_id']) ?>
                <?= $this->Form->hidden('status', ['id' => 'status']) ?>
                <div class="form-group">
                    <?= $this->Form->control('shipping_id', ['options' => $shippings, 'class' => 'form-control', 'id' => 'shipping_id', 'label' => 'บริษัทขนส่ง*']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('trackingno', ['class' => 'form-control', 'id' => 'trackingno', 'label' => 'Tracking No*']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
            <div class="modal-footer">
                <button type="button" id="bt-save" class="btn btn-primary">บันทึก</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {
        $("#frm-order").validate({
            rules: {
                shipping_id: {
                    required: true
                },
                trackingno:{
                    required: true
                }
            },
            messages: {
                trackingno:{
                    required:"กรุณาระบุหมายเลขพัสดุ"
                }
            },
            errorPlacement: function (error, element)
            {
                error.insertAfter(element);
            }
        });
        
        $('[data-action="update-status"]').on('click', function () {
            var order_id = $(this).attr('data-id');
            var status = $(this).attr('data-status');

            $('#order_id').val(order_id);
            $('#status').val(status);

        });

        $('#bt-save').on('click', function () {
            if ($("#frm-order").valid()) {
                 $('#frm-order').submit();
            }
           
        });
    });
</script>