<?= $this->Html->css('assets/libs/datatables/dataTables.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') ?>
<?= $this->Html->css('assets/libs/switchery/switchery.min.css') ?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">รายการแจ้งชำระเงิน</h4> 
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <div class="col-12">
                    <?= $this->element('Payments/menu_status') ?>
                </div>
            </div>
            <hr/>
            <table cellpadding="0" cellspacing="0" id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>วัน/เวลาชำระ</th>
                        <th>วันที่สั่งซื้อ</th>
                        <th>หมายเลขคำสั่งซื้อ</th>
                        <th>ลูกค้า</th>

                        <th class="text-right">ยอดเงินที่ต้องชำระ</th>
                        <th class="text-right">จำนวนเงินที่ชำระ</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payments as $index => $payment): ?>
                        <?php $order = $payment->order; ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $payment->docdate->i18nFormat(DATE_FORMATE, null, NULL) ?> <?= $payment->transfertime ?></td>
                            <td><?= $order->docdate->i18nFormat(DATE_FORMATE, null, NULL) ?></td>
                            <td><?= $this->Html->link($order->docno, ['controller' => 'orders', 'action' => 'view', $order->id]) ?></td>
                            <td><?= $order->user->fullname ?></td>


                            <td class="text-right"><?= number_format($order->totalamt) ?></td>
                            <td class="text-right"><?= number_format($payment->amount) ?></td>

                            <td class="text-right">
                                <?php if ($payment->status == 'NEW') { ?>
                                    <button class="btn btn-sm btn-icon waves-effect btn-outline-secondary" data-action="update-status" data-id="<?= $payment->id ?>" data-status="CF"> ยืนยัน </button>
                                <?php } ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->Form->create('payment', ['id' => 'frm-payment']) ?>
            <?= $this->Form->hidden('payment_id', ['id' => 'payment_id']) ?>
            <?= $this->Form->hidden('status', ['id' => 'status']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

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
            var payment_id = $(this).attr('data-id');
            var status = $(this).attr('data-status');

            $('#payment_id').val(payment_id);
            $('#status').val(status);
            $('#frm-payment').submit();
        });


    });

</script>