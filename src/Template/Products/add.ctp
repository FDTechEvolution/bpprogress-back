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
        <?= $this->Form->create('addproduct', ['url' => ['controller' => 'products', 'action' => 'add'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'add-product']) ?>
        <?= $this->Form->hidden('isretail',['value'=>'N'])?>
        <?= $this->Form->hidden('iswholesale',['value'=>'N'])?>
        <?= $this->Form->hidden('isstock',['value'=>'Y'])?>
        <?= $this->Form->hidden('price',['value'=>'0'])?>
        <?= $this->Form->hidden('special_price',['value'=>'0'])?>
        <fieldset>
            <div class="card-box">
                <div class="row">
                    <div class="col-12">
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
                    </div>
                </div>
            </div>
        </fieldset>


        <div class="form-group row">
            <div class="col-12 text-center">
                <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> ต่อไป'), ['id' => 'btn-add-product', 'class' => 'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
            </div>
        </div>
        <?=$this->Form->end()?>
    </div>
</div>

<?= $this->Html->script('assets/jquery.min.js') ?>
<?= $this->Html->script('assets/libs/switchery/switchery.min.js') ?>

<?= $this->Html->script('assets/libs/tinymce/tinymce.min.js') ?>
<?= $this->Html->script('assets/libs/dropzone/dropzone.js') ?>

<?= $this->Html->script('assets/jquery.core.js') ?>


<script>
    var form = document.getElementById("add-product");

    document.getElementById("btn-add-product").addEventListener("click", function () {
        form.submit();
    });
</script>