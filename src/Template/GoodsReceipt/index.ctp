<?= $this->Html->css('assets/libs/datatables/dataTables.bootstrap4.css') ?>
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

            <table id="datatable" class="table table-striped table-bordered table-sm">
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
                                <?= $this->Html->link('<i class="remixicon-list-check"></i>', ['action' => 'confirm', $item->id], ['class' => 'btn btn-icon btn-secondary', 'escape' => false]) ?>
                                <?php if ($item->status != 'CF') { ?>
                                    <?= $this->Html->link('<i class="remixicon-pencil-fill"></i>', ['action' => 'update', $item->id], ['class' => 'btn btn-icon btn-warning', 'escape' => false]) ?>
                                    <?= $this->Html->link('<i class="remixicon-delete-bin-2-line"></i>', ['action' => 'delete', $item->id], ['class' => 'btn btn-icon btn-danger', 'escape' => false]) ?>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
