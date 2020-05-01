<?= $this->Html->css('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css') ?>
<?= $this->Html->css('assets/libs/clockpicker/bootstrap-clockpicker.min.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-daterangepicker/daterangepicker.css') ?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">เพิ่มรายการรับสินค้าเข้าระบบ</h4>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">

        <div class="row pb-3">
            <div class="col-md-12 text-left">
                <?= $this->Html->link(__('< ย้อนกลับ'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm btn-rounded w-md waves-effect waves-light m-b-5', 'escape' => false]) ?>
            </div>
        </div>
        <?= $this->Form->create('create', ['url' => ['controller' => 'goods-receipt', 'action' => 'add'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'add-goods-receipt']) ?>
        <?= $this->Form->hidden('type',['value'=>'RECEIPT'])?>
        
        <fieldset>
            <div class="card-box">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-2 col-form-label">รับเข้าคลังสินค้า</label>
                            <div class="col-9">
                                <?php echo $this->Form->control('warehouse_id', ['options' => $warehouses, 'class' => 'form-control', 'label' => false]); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">วันที่</label>
                            <div class="col-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="docdate" name="docdate">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ti-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </fieldset>


        <div class="form-group row">
            <div class="col-12 text-center">
                <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> ต่อไป'), ['id' => 'btn-add-product', 'class' => 'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
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
            autoclose:true,
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

    });
</script>
