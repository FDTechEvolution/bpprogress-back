<?= $this->Html->css('assets/libs/datatables/dataTables.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') ?>
<?= $this->Html->css('assets/libs/switchery/switchery.min.css') ?>
<?= $this->Html->css('assets/libs/multiselect/multi-select.css') ?>
<?= $this->Html->css('assets/libs/select2/select2.min.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-select/bootstrap-select.min.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') ?>
<?= $this->Html->css('assets/libs/dropzone/dropzone.min.css') ?>

<!-- Summernote css -->
<?= $this->Html->css('assets/libs/summernote/summernote-bs4.css') ?>
<!-- Summernote js -->
<?= $this->Html->script('/css/assets/libs/summernote/summernote-bs4.min.js') ?>


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
        <?= $this->Form->create($product, ['id' => 'frm-product', 'novalidate' => 'novalidate']) ?>
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
                                        <label>ตั้งแต่จำนวน</label>
                                    </div>
                                    <div class="col-4">
                                        <label>ถึงจำนวน</label>
                                    </div>
                                    <div class="col-2">
                                        <label>ราคาขายส่ง</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12" id="box-wholesales-input">
                                        <?php if (sizeof($product->wholesale_rates) == 0) { ?>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <input type="number" name="wholesales[startqty][]" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <input type="number" name="wholesales[endqty][]" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <input type="number" name="wholesales[price][]" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <?php foreach ($product->wholesale_rates as $item): ?>
                                                <div class="row" id="<?= $item['id'] ?>">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="number" name="wholesales[startqty][]" class="form-control" value="<?=$item['startqty']?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="number" name="wholesales[endqty][]" class="form-control" value="<?=$item['endqty']?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <input type="number" name="wholesales[price][]" class="form-control" value="<?=$item['price']?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-outline-secondary waves-effect waves-light" onclick="removeElementById('<?= $item['id'] ?>');">ลบ</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php } ?>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12"><button type="button" class="btn btn-outline-success" id="bt-add-wholesales-rate">เพิ่มราคาส่ง</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">รูปภาพสินค้า</label>

                            <div class="col-10">
                                <p>*** ขนาดที่แนะนำควรจะเป็น 1:1</p>

                                <input name="file" type="file" name="image_file" id="image_file" accept="image/png, image/jpeg" />

                                <div class="row" id="box-image">
                                    <?php foreach ($product->product_images as $productImage): ?>
                                        <div class="col-md-2">
                                            <image src="<?= $productImage->image->fullpath ?>" class="img-fluid" />
                                        </div>
                                    <?php endforeach; ?>
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

                                <?= $this->Form->control('short_description', ['id' => 'short_description']) ?>
                            </div>
                        </div>
                        <div class="row pt-2 py-2 px-3">
                            <label class="col-2 col-form-label">รายละเอียดสินค้าแบบเต็ม</label>

                            <div class="col-9">
                                <?= $this->Form->control('description', ['id' => 'description']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="form-group row">
            <div class="col-12 text-center">
                <button type="submit" id="bt-save" class="btn btn-primary btn-custom waves-effect w-md waves-light m-b-5"><i class="mdi mdi-content-save"></i> SAVE</button>

                <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> Cancel'), ['class' => 'btn btn-secondary btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>

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

        $('#bt-add-wholesales-rate').on('click', function () {
            var idRandom = generateCode(20);
            var btHtml = '';
            btHtml += '<div class="row" id="' + idRandom + '">';
            btHtml += '<div class="col-4">';
            btHtml += ' <div class="form-group">';
            btHtml += '     <input type="number" name="wholesales[startqty][]" class="form-control" />';
            btHtml += ' </div>';
            btHtml += '</div>';
            btHtml += '<div class="col-4">';
            btHtml += ' <div class="form-group">';
            btHtml += '     <input type="number" name="wholesales[endqty][]" class="form-control" />';
            btHtml += ' </div>';
            btHtml += '</div>';
            btHtml += '<div class="col-2">';
            btHtml += ' <div class="form-group">';
            btHtml += '     <input type="number" name="wholesales[price][]" class="form-control" />';
            btHtml += ' </div>';
            btHtml += '</div>';
            btHtml += '<div class="col-2">';
            btHtml += ' <div class="form-group">';
            btHtml += '     <button type="button" class="btn btn-outline-secondary waves-effect waves-light" onclick="removeElementById(\'' + idRandom + '\');">ลบ</button>';
            btHtml += ' </div>';
            btHtml += '</div>';
            btHtml += '</div>';

            $('#box-wholesales-input').append(btHtml);
        });

        $('#short_description').summernote({
            height: 150, //set editable area's height
            codemirror: {// codemirror options
                theme: 'monokai'
            }
        });
        $('#description').summernote({
            height: 300, //set editable area's height
            codemirror: {// codemirror options
                theme: 'monokai'
            }
        });
        $('#bt-save').on('click', function () {
            $('frm-product').submit();
        });

    });

</script>
