<!-- third party css -->
<?= $this->Html->css('assets/libs/datatables/dataTables.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/datatables/responsive.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/datatables/buttons.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/datatables/select.bootstrap4.css') ?>
<!-- third party css end -->
<?= $this->Html->css('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') ?>
<?= $this->Html->css('assets/libs/switchery/switchery.min.css') ?>

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="button-list">
                <?= $this->Html->link(__('<i class="mdi mdi-plus-circle-outline"></i> เพิ่มรายการรับสินค้าเข้าระบบ'), ['action' => 'add'], ['class' => 'btn btn-outline-primary waves-effect waves-light', 'escape' => false]) ?>

            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">รายการรับสินค้าเข้าระบบ</h4> 
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">

            <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                <thead>
                    <tr>
                        <th>วันที่</th>
                        <th>หมายเลขเอกสาร</th>
                        <th>สถานะ</th>

                        <th>รับเข้าคลัง</th>
                        <th>รายละเอียด</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($goodsReceipts as $index => $item): ?>
                        <tr>
                            <td><?= $item->docdate->i18nFormat(DATE_FORMATE, null, NULL) ?></td>
                            <td><?= $item->docno ?></td>
                            <td><?= $item->status ?></td>
                            <td><?= $item->warehouse->name ?></td>
                            <td></td>
                            <td class="text-right">
                                <?= $this->Html->link('<i class="remixicon-list-check"></i>', ['action' => 'confirm', $item->id], ['class' => '', 'escape' => false]) ?>
                                <?php if ($item->status != 'CF') { ?>
                                    <?= $this->Html->link('<i class="remixicon-pencil-fill"></i>', ['action' => 'update', $item->id], ['class' => '', 'escape' => false]) ?>
                                    <?= $this->Html->link('<i class="remixicon-delete-bin-2-line"></i>', ['action' => 'delete', $item->id], ['confirm' => __('โปรดยืนยันการลบ #{0}?', $item->docno), 'class' => '', 'escape' => false]) ?>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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


<script>
    $(document).ready(function () {
        $("#scroll-horizontal-datatable").DataTable({
            scrollX: !0,
            "ordering": false,
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function () {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            }
        })
    });
</script>