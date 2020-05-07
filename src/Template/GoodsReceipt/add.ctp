<?= $this->Html->css('/js/bootstrap-datepicker-thai-thai/css/datepicker.css') ?>

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
                                     <input type="text" name="docdate" id="docdate" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-language="th" class="form-control" readonly required>
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
<?= $this->Html->script('bootstrap-datepicker-thai-thai/js/bootstrap-datepicker.js') ?>
<?= $this->Html->script('bootstrap-datepicker-thai-thai/js/bootstrap-datepicker-thai.js') ?>
<?= $this->Html->script('bootstrap-datepicker-thai-thai/js/locales/bootstrap-datepicker.th.js') ?>
<script>
    $(document).ready(function () {
        $('#docdate').datepicker({
            autoClose: true,
            todayHighlight: true
        });
        
        $("#frm-payment").validate({
            rules: {
                email: {
                    required: true
                },

            },

            // Messages for form validation
            messages: {

            },

            // Do not change code below
            errorPlacement: function (error, element)
            {
                error.insertAfter(element);
            }
        });
        
        $('#bt-save').on('click', function () {
            if ($("#frm-payment").valid()) {
                $("#frm-payment").submit();
            }

        });
    });
</script>
