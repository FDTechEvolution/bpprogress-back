<!-- third party css -->
<?= $this->Html->css('assets/libs/datatables/dataTables.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/datatables/responsive.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/datatables/buttons.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/datatables/select.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') ?>
<?= $this->Html->css('assets/libs/switchery/switchery.min.css') ?>

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
            <div class="row">
                <div class="col-12">
                    <table cellpadding="0" cellspacing="0" id="basic-datatable" class="table w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>วันที่สั่งซื้อ</th>
                                <th>หมายเลขคำสั่งซื้อ</th>
                                <th>ลูกค้า</th>
                                <th>สถานะ</th>
                                <th>รูปแบบการชำระเงิน</th>
                                <th>สถานะการชำระเงิน</th>
                                <th class="text-right">จำนวนเงิน</th>
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
                                    <td><?= $paymentMethod[$order->payment_method] ?></td>
                                    <td>
                                        <?= $paymentStatus[$order->payment_status] ?>
                                        <?php
                                        if ($order->payment_method == 'transfer' && sizeof($order->payments) > 0) {
                                            $pStatus = $order['payments'][0]['status'];
                                            echo '/' . $paymentStatus[$pStatus];
                                        }
                                        ?>
                                    </td>
                                    <td class="text-right"><?= number_format($order->totalamt) ?></td>
                                    <td class="text-right">
                                        <?php if ($order->payment_method == 'transfer') { ?>
                                            <?php if ($pStatus == 'DR') { ?>
                                                <p class="text-danger">รอผู้สั่งซื้อชำระเงิน</p>
                                            <?php } elseif ($pStatus == 'NEW') { ?>
                                                <p class="text-danger">กรุณา <?= $this->Html->link('ยืนยันการชำระเงิน', ['controller' => 'payments']) ?> </p>
                                            <?php } else { ?>
                                                <button class="btn btn-sm btn-icon waves-effect btn-outline-secondary" data-action="update-status" data-id="<?= $order->id ?>" data-status="WT"> ยืนยันคำสั่งซื้อ </button>
                                            <?php } ?>

                                        <?php } else { ?>
                                            <button class="btn btn-sm btn-icon waves-effect btn-outline-secondary" data-action="update-status" data-id="<?= $order->id ?>" data-status="WT"> ยืนยันคำสั่งซื้อ </button>

                                        <?php } ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?= $this->Form->create('order', ['id' => 'frm-order']) ?>
            <?= $this->Form->hidden('order_id', ['id' => 'order_id']) ?>
            <?= $this->Form->hidden('status', ['id' => 'status']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<!-- third party js -->
<?= $this->Html->script('/css/assets/libs/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/dataTables.bootstrap4.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/dataTables.responsive.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/responsive.bootstrap4.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/dataTables.buttons.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/buttons.html5.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/buttons.flash.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/buttons.print.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/dataTables.keyTable.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/dataTables.select.min.js') ?>
<?= $this->Html->script('/css/assets/libs/pdfmake/pdfmake.min.js') ?>
<?= $this->Html->script('/css/assets/libs/pdfmake/vfs_fonts.js') ?>
<!-- third party js ends -->
<!-- Plugins Js -->
<?= $this->Html->script('/css/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') ?>
<?= $this->Html->script('/css/assets/libs/switchery/switchery.min.js') ?>
<?= $this->Html->script('/css/assets/libs/multiselect/jquery.multi-select.js') ?>
<?= $this->Html->script('/css/assets/libs/jquery-quicksearch/jquery.quicksearch.min.js') ?>
<?= $this->Html->script('/css/assets/libs/select2/select2.min.js') ?>
<?= $this->Html->script('/css/assets/libs/bootstrap-select/bootstrap-select.min.js') ?>
<?= $this->Html->script('/css/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') ?>
<?= $this->Html->script('/css/assets/libs/jquery-mask-plugin/jquery.mask.min.js') ?>
<?= $this->Html->script('/css/assets/libs/dropzone/dropzone.min.js') ?>

<!-- init js -->
<?= $this->Html->script('/css/assets/js/pages/form-advanced.init.js') ?>


<script>
    $(document).ready(function () {
        $('[data-action="update-status"]').on('click', function () {
            var order_id = $(this).attr('data-id');
            var status = $(this).attr('data-status');

            $('#order_id').val(order_id);
            $('#status').val(status);
            $('#frm-order').submit();
        });

        $("#basic-datatable").DataTable({
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function () {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            }
        });


    });

</script>