<?= $this->Html->css('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css') ?>
<?= $this->Html->css('assets/libs/clockpicker/bootstrap-clockpicker.min.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-daterangepicker/daterangepicker.css') ?>

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-12">
                    <h2>รับสินค้าเข้าระบบ No.<?= $goodsReceipt->docno ?></h2>
                </div>
            </div>

            <?= $this->Form->create('create', ['class' => 'form-horizontal', 'role' => 'form', 'id' => 'add-goods-receipt']) ?>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="form-group row">
                        <label class="col-2 col-form-label">รับเข้าคลังสินค้า</label>
                        <div class="col-9">
                            <?= $this->Form->control('warehouse_id', ['options' => $warehouses, 'class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">วันที่</label>
                        <div class="col-5">
                            <div class="input-group">
                                <input type="text" class="form-control" id="docdate" name="docdate">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="ti-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">รายละเอียด</label>
                        <div class="col-9">
                            <?= $this->Form->textarea('description', ['class' => 'form-control', 'row' => '5']) ?>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-8 col-12 text-left">
                            <h3>รายการสินค้า</h3>
                        </div>
                        <div class="col-md-4 col-12 text-right">
                            <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target=".bs-example-modal-xl">เพิ่มสินค้า</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>ชื่อสินค้า</th>
                                        <th>จำนวนที่นำเข้า</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myExtraLargeModalLabel">รายการสินค้าในระบบ</h4>

            </div>
            <div class="modal-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>ชื่อสินค้า</th>
                            <th>จำนวนคงเหลือ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $index => $product): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <?php if (sizeof($product->product_images) == 0) { ?>
                                        <?= $this->Html->image('no-image.jpg', ['width' => '80']) ?>
                                    <?php } else { ?>
                                        <?= $this->Html->image($product->product_images[0]['image']['fullpath'], ['width' => '80']) ?>
                                    <?php } ?>
                                </td>
                                <td><?= $product->name ?></td>
                                <td>0</td>
                                <td>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="check_<?= $product->id ?>" value="<?= $product->id ?>" name="modal_product_id">
                                            <label class="custom-control-label" for="check_<?= $product->id ?>">เลือก</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" id="bt-modal-save">บันทึก</button>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->script('/css/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') ?>
<?= $this->Html->script('/css/assets/libs/clockpicker/bootstrap-clockpicker.min.js') ?>
<?= $this->Html->script('/css/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>
<?= $this->Html->script('/css/assets/libs/moment/moment.min.js') ?>
<?= $this->Html->script('/css/assets/libs/bootstrap-daterangepicker/daterangepicker.js') ?>

<script>
    $(document).ready(function () {
        $('#docdate').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            locale: {
                applyLabel: "Submit",
                cancelLabel: "Cancel",
                fromLabel: "From",
                toLabel: "To",
                customRangeLabel: "Custom",
                daysOfWeek: ["อา", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                monthNames: ["มกราคม", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                firstDay: 1
            }
        });


        $('#bt-modal-save').on('click', function () {
            var productIds = [];
            $.each($("input[name='modal_product_id']:checked"), function () {
                productIds.push($(this).val());
            });
            
            console.log(productIds);
        });

    });
</script>
