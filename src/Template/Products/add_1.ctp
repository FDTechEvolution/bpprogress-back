<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">เพิ่มรายการสินค้า</h4>
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
            <?= $this->Form->create('addproduct', ['url'=>['controller'=>'products', 'action'=>'add'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'add-product']) ?>
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
                            </div>
                        </div>
                    </div>
                    <div class="card-box">
                        <div class="row">
                            <div class="col-12 pt-0" style="padding: 20px;">
                                <div class="form-group row pb-0 mb-2">
                                    <label class="col-12 col-form-label">ข้อมูลของสินค้า</label>
                                </div>
                                <hr>
                                <div class="form-group row py-1 px-3">
                                    <label class="col-2 col-form-label">ประเภทสินค้า</label>
                                    <div class="col-9">
                                        <?php echo $this->Form->control('product_category_id', ['options' => $productCategories, 'class' => 'form-control', 'label' => false]); ?>
                                    </div>
                                </div>
                                <div class="form-group row py-1 px-3">
                                    <div class="col-6">
                                        <div class="row">
                                            <label class="col-4 col-form-label">ยี่ห้อสินค้า</label>
                                            <div class="col-8">
                                                <?php echo $this->Form->control('brand_id', ['options' => $brands, 'class' => 'form-control', 'label' => false]); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="col-2">
                                        <div class="row">
                                            <label class="col-6 col-form-label text-center">ขายปลีก</label>
                                            <div class="col-6">
                                                <?= $this->Form->checkbox(__('isretail'), ['id' => 'isretail', 'data-plugin' => 'switchery', 'data-color' => '#00b19d', 'value' => 'Y', 'escape' => false]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="row">
                                            <label class="col-6 col-form-label text-center">ขายส่ง</label>
                                            <div class="col-6">
                                            <?= $this->Form->checkbox(__('iswholesale'), ['id' => 'iswholesale', 'data-plugin' => 'switchery', 'data-color' => '#00b19d', 'value' => 'Y', 'escape' => false]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row py-1 px-3">
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">ราคาสินค้า (฿)</label>
                                            <div class="col-8">
                                                <?php echo $this->Form->control('price', ['type' => 'number', 'class' => 'form-control', 'label' => false]); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">ราคาพิเศษ (฿)</label>
                                            <div class="col-8">
                                                <?php echo $this->Form->control('special_price', ['type' => 'number', 'class' => 'form-control', 'label' => false]); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">จำนวนสินค้า</label>
                                            <div class="col-8">
                                                <?php echo $this->Form->control('qty', ['type' => 'number', 'class' => 'form-control', 'label' => false]); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-12 col-form-label pt-0">โน๊ตเพิ่มเติม</label>
                                            <div class="col-12">
                                                <?php echo $this->Form->textarea('note', ['class' => 'form-control', 'maxlength' => 255, 'label' => false]); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row py-1 px-3">
                                    
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
                                        <?php echo $this->Form->textarea('short_description',['id' => 'elm1', 'maxlength' => 255]) ?>
                                    </div>
                                </div>
                                <div class="row pt-2 py-2 px-3">
                                    <label class="col-2 col-form-label">รายละเอียดสินค้าแบบเต็ม</label>
                                    <div class="col-9">
                                        <?php echo $this->Form->textarea('description',['id' => 'elm2']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            <?= $this->Form->end() ?>

            <div class="card-box">
                <div class="row">
                    <div class="col-12 pt-0" style="padding: 20px;">
                        <div class="form-group row pb-0 mb-2">
                            <label class="col-12 col-form-label">รูปภาพสินค้า</label>
                        </div>
                        <hr>
                        <?= $this->Form->create('productimage', ['url'=>['controller'=>'products', 'action'=>'uploadproductimage'], 'id' => 'dropzone', 'class' => 'form-horizontal dropzone', 'role' => 'form', 'enctype' => 'multipart/form-data']) ?>
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        
            <div class="form-group row">
                <div class="col-12 text-center">
                    <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> บันทึก'), ['id' => 'btn-add-product', 'class' => 'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                </div>
            </div>
    </div>
</div>



<style>
    strong {
        font-weight: 700;
    }
    .mce-menubar {
        display: none;
    }
    .dropzone {
        border: 2px dashed rgba(0,0,0,0.3);
    }
</style>

<?= $this->Html->script('assets/jquery.min.js') ?>
<?= $this->Html->script('assets/libs/switchery/switchery.min.js') ?>

<?= $this->Html->script('assets/libs/tinymce/tinymce.min.js') ?>
<?= $this->Html->script('assets/libs/dropzone/dropzone.js') ?>




<script>
    $(document).ready(function () {
        if($("#elm1").length > 0){
            tinymce.init({
                selector: "textarea#elm1",
                theme: "modern",
                height:200,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });
        }

        if($("#elm2").length > 0){
            tinymce.init({
                selector: "textarea#elm2",
                theme: "modern",
                height:250,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });
        }

        $('#editBrandModal').on('show.bs.modal', function (e) {
            var brandId = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');
            var description = $(e.relatedTarget).data('description');
            
            $(e.currentTarget).find('input[id="edit_brandID"]').val(brandId);
            $('#frm_edit input[id="edit_name"]').val(name);
            $('#frm_edit textarea[id="edit_description"]').val(description);
        });
    });

</script>

<script>
    var form = document.getElementById("add-product");

    document.getElementById("btn-add-product").addEventListener("click", function () {
        form.submit();
    });
</script>