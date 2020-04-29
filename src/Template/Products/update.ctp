<?= $this->Html->css('assets/libs/datatables/dataTables.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') ?>
<?= $this->Html->css('assets/libs/switchery/switchery.min.css') ?>
<?= $this->Html->css('assets/libs/multiselect/multi-select.css') ?>
<?= $this->Html->css('assets/libs/select2/select2.min.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-select/bootstrap-select.min.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') ?>
<?= $this->Html->css('assets/libs/dropzone/dropzone.min.css') ?>



<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">แก้ไขรายการสินค้า</h4>
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
        <?= $this->Form->create($product) ?>
        <?= $this->Form->hidden('product_id', ['value' => $product->id, 'id' => 'product_id']) ?>
        <fieldset>
            <div class="card-box">
                <div class="row">
                    <div class="col-12" style="padding: 20px;">
                        <div class="form-group row">
                            <label class="col-2 col-form-label">ชื่อสินค้า</label>
                            <div class="col-9">
                                <?php echo $this->Form->control('name', ['class' => 'form-control', 'maxlength' => 255, 'label' => false]); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">ประเภทสินค้า</label>
                            <div class="col-9">
                                <?php echo $this->Form->control('product_category_id', ['options' => $productCategories, 'class' => 'form-control', 'label' => false]); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">ยี่ห้อสินค้า</label>
                            <div class="col-9">
                                <?php echo $this->Form->control('brand_id', ['options' => $brands, 'class' => 'form-control', 'label' => false]); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">ขายปลีก</label>
                            <div class="col-9">
                                <?= $this->Form->checkbox(__('isretail'), ['id' => 'isretail', 'data-plugin' => 'switchery', 'data-color' => '#00b19d', 'value' => 'Y', 'escape' => false]) ?>
                                <div class="row mt-2">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>ราคาขายปลึก</label>
                                            <?php echo $this->Form->control('price', ['type' => 'number', 'class' => 'form-control', 'label' => false]); ?>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>ราคาขายปลึกพิเศษ</label>
                                            <?php echo $this->Form->control('special_price', ['type' => 'number', 'class' => 'form-control', 'label' => false]); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">ขายส่ง</label>
                            <div class="col-9">
                                <?= $this->Form->checkbox(__('iswholesale'), ['id' => 'iswholesale', 'data-plugin' => 'switchery', 'data-color' => '#00b19d', 'value' => 'Y', 'escape' => false]) ?>
                                <div class="row mt-2">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>ตั้งแต่จำนวน</label>
                                            <input type="number" name="" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>ถึงจำนวน</label>
                                            <input type="number" name="" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>ราคาขายส่ง</label>
                                            <input type="number" name="" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">รูปภาพสินค้า</label>

                            <div class="col-10">
                                <p>*** ขนาดที่แนะนำควรจะเป็น 1:1</p>
                                <form enctype="multipart/form-data" method="post" id="imageForm">
                                    <input name="file" type="file" name="image_file" id="image_file" accept="image/png, image/jpeg" />
                                </form>
                                <div class="row" id="box-image">
                                    <?php foreach ($product->product_images as $productImage):?>
                                    <div class="col-md-2">
                                        <image src="<?=$productImage->image->fullpath?>" class="img-fluid" />
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-box">
                <div class="row">
                    <div class="col-12 pt-0" style="padding: 20px;">
                        <div class="form-group row pb-0 mb-2">
                            <label class="col-12 col-form-label">คำอธิบายรายละเอียดสินค้า</label>
                        </div>
                        <hr>
                        <div class="row pb-2 py-2 px-3">
                            <label class="col-2 col-form-label">รายละเอียดโดยย่อ</label>
                            <div class="col-9">
                                <?php echo $this->Form->textarea('short_description', ['id' => 'elm1', 'maxlength' => 255]) ?>
                                <!-- <textarea id="elm1" name=""></textarea> -->
                            </div>
                        </div>
                        <div class="row pt-2 py-2 px-3">
                            <label class="col-2 col-form-label">รายละเอียดสินค้าแบบเต็ม</label>
                            <div class="col-9">
                                <?php echo $this->Form->textarea('description', ['id' => 'elm1']) ?>
                                <!-- <textarea id="elm1" name=""></textarea> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="form-group row">
            <div class="col-12 text-center">
                <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> SAVE'), ['class' => 'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> Cancel'), ['class' => 'btn btn-secondary btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>

    </div>
</div>



<style>
    strong {
        font-weight: 700;
    }
    .mce-menubar {
        display: none;
    }
</style>

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
        $('#image_file').on('change', function (e) {
            e.preventDefault();
            var formData = new FormData();
            //var files = $('#file')[0].files[0];
            // console.log(this.files[0]);
            formData.append('image_file', this.files[0]);
            formData.append('product_id', $('#product_id').val());
            $(this).val('');


            $.ajax({
                type: 'POST',
                url: siteurl + 'sv-product-images/upload-product-image',
                data: formData,
                //dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {

                },
                success: function (response) {
                    var res = JSON.parse(response);
                    console.log(res);
                    var html = '<div class="col-2"><image src="' + res.data.fullpath + '" class="img-fluid"/></div>';
                    $('#box-image').append(html);
                }
            });
        });


    });

</script>
