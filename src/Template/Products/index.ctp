<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">รายการสินค้า</h4> 
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row pb-3">
                <div class="col-md-12 text-right">
                    <?= $this->Html->link(__('<i class="mdi mdi-account-multiple-plus"></i> เพิ่มสินค้า'), ['action' => 'add'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle' => 'modal', 'data-target' => '#addProductModal', 'escape' => false]) ?>
                </div>
            </div>
            <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr style="background-color: #3b73da91; color: #000;">
                        <th scope="col" style="width: 5%;"><?= __('#') ?></th>
                        <th scope="col" style="width: 20%;"><?= __('ชื่อสินค้า') ?></th>
                        <th scope="col" style="width: 20%;" class="text-center"><?= __('ราคา / ราคาพิเศษ (฿)') ?></th>
                        <th scope="col" style="width: 10%;" class="text-center"><?= __('คงเหลือ') ?></th>
                        <th scope="col" style="width: 15%;" class="text-center"><?= __('สถานะ') ?></th>
                        <th scope="col" style="width: 30%;" class="actions text-center"><?= __('การจัดการ') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $index => $product): ?>
                    <tr>
                        <td><?= h($index + 1) ?></td>
                        <td><?= h($product->name) ?></td>
                        <td class="text-center"><?= number_format(h($product->price)) ?> <?php if(isset($product->special_price)){ echo "<strong style='color: #000;'>/</strong> <span style='color: #dd0000;'>".number_format(h($product->special_price))."</span>";} ?></td>
                        <td class="text-center"><strong><?php if($product->qty >= 20){ echo "<span style='color: #18e000;'>".number_format(h($product->qty))."</span>"; }else{ echo "<span style='color: #dd0000;'>".number_format(h($product->qty))."</span>"; } ?></strong></td>
                        <td class="text-center">
                            <?php if(h($product->isactive == 'Y')) { ?>
                                <?= $this->Form->button(__('<i class="mdi mdi-earth"></i> เปิดใช้งาน'), ['class' => 'btn btn-success waves-effect waves-light', 'data-toggle' => 'modal', 'data-target' => '#statBrandModal', 'data-id' => $product->id, 'data-value' => 'N', 'escape' => false, 'title'=>'คลิกเพื่อปิดการใช้งาน']) ?>
                            <?php }else{ ?>
                                <?= $this->Form->button(__('<i class="mdi mdi-earth-off"></i> ปิดการใช้งาน'), ['class' => 'btn btn-outline-secondary', 'data-toggle' => 'modal', 'data-target' => '#statBrandModal', 'data-id' => $product->id, 'data-value' => 'Y', 'escape' => false, 'title'=>'คลิกเพื่อเปิดใช้งาน']) ?>
                            <?php } ?>
                        </td>
                        <?php
                            $modalProduct = [
                                'data-id' => $product->id,
                                'data-name' => $product->name,
                                'data-description' => $product->description,
                                'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5',
                                'data-toggle' => 'modal',
                                'data-target' => '#editProductModal',
                                'escape' => false
                            ];
                        ?>
                        <td class="actions text-center">
                            <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'view', $product->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'edit', $product->id], $modalProduct) ?>
                            <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $product->id], ['confirm' => __('โปรดตรวจสอบ!!...รายการสินค้าที่อยู่ในยี่ห้อนี้ทั้งหมดจะถูกลบไปด้วย\n ยืนยันการลบ #{0}?', $product->name), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ADD PRODUCT -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 75%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">เพิ่มรายการสินค้า</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('partner', ['url'=>['controller'=>'products', 'action'=>'add'], 'class' => 'form-horizontal', 'role' => 'form']) ?>
                <fieldset>
                    <div class="card-box">
                        <div class="row">
                            <div class="col-12" style="padding: 20px;">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">ชื่อสินค้า</label>
                                    <div class="col-9">
                                        <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">ประเภทสินค้า</label>
                                    <div class="col-9">
                                        <?php echo $this->Form->control('product_category_id', ['options' => $productCategories, 'class' => 'form-control', 'label' => false]); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-form-label">ข้อมูลของสินค้า</label>
                                </div>
                                <div class="form-group row">
                                    <div class="col-6">
                                        <div class="row">
                                            <label class="col-12 col-form-label">ยี่ห้อสินค้า</label>
                                            <div class="col-12">
                                                <?php echo $this->Form->control('brand_id', ['options' => $brands, 'class' => 'form-control', 'label' => false]); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="row">
                                            <label class="col-12 col-form-label text-center">ขายปลีก</label>
                                            <div class="col-12">
                                                <?php echo $this->Form->select('isretail', ['Y' => 'เปิด','N' => 'ปิด'], ['class' => 'form-control', 'label' => false]); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="row">
                                            <label class="col-12 col-form-label text-center">ขายส่ง</label>
                                            <div class="col-12">
                                                <?php echo $this->Form->select('iswholesale', ['Y' => 'เปิด','N' => 'ปิด'], ['class' => 'form-control', 'label' => false]); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box">
                        <div class="row">
                            <div class="col-12">

                            </div>
                        </div>
                    </div>
                </fieldset>
                <br>
                <div class="form-group row">
                    <div class="col-12 text-center">
                        <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> SAVE'), ['class' => 'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                        <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> Cancel'), ['class' => 'btn btn-secondary btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>


<!-- EDIT BRAND -->
<div class="modal fade" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="editBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 40%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBrandModalLabel">แก้ไขรายการประเภทสินค้า</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('brand', ['url'=>['controller'=>'brands', 'action'=>'edit'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_edit']) ?>
                <fieldset>
                    <div class="row">
                        <div class="col-12" style="padding: 20px;">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ชื่อประเภทสินค้า</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('name', ['id' => 'edit_name', 'class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">รายละเอียดเพิ่มเติม</label>
                                <div class="col-9">
                                    <?php echo $this->Form->textarea('description', ['id' => 'edit_description', 'maxlength' => 255, 'class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <?php echo $this->Form->control('brandID', ['id' => 'edit_brandID' ,'class' => 'form-control', 'type' => 'hidden', 'label' => false]); ?>
                        </div>
                    </div>
                </fieldset>
                <br>
                <div class="form-group row">
                    <div class="col-12 text-center">
                        <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> SAVE'), ['class' => 'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                        <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> Cancel'), ['class' => 'btn btn-secondary btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>


<!-- Change Stat Brand -->
<div class="modal fade" id="statBrandModal" tabindex="-1" role="dialog" aria-labelledby="statBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statBrandModalLabel">เปลี่ยนสถานะ</h5>
            </div>
            <div class="modal-body">
                ยืนยันการเปลี่ยนแปลงสถานะ ?
            </div>
            <div class="modal-footer">
            <?= $this->Form->create('brand', ['url'=>['controller'=>'brands', 'action'=>'edit'], 'class' => 'form-horizontal', 'role' => 'form','id'=>'frm_stat']) ?>
                <fieldset>
                    <?php echo $this->Form->control('brandID', ['id' => 'stat_brandID', 'class' => 'form-control', 'label' => false, 'type' => 'hidden']); ?>
                    <?php echo $this->Form->control('isactive', ['id' => 'stat_isactive','class' => 'form-control', 'label' => false, 'type' => 'hidden']); ?>
                </fieldset>
                <div class="form-group row">
                    <div class="col-12 text-center">
                        <?= $this->Form->button(__('<i class=" mdi mdi-auto-upload"></i> CONFIRM'), ['class' => 'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                        <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> Cancel'), ['class' => 'btn btn-secondary btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
                    </div>
                </div>
            <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<style>
    strong {
        font-weight: 700;
    }
</style>

<script>
    $(document).ready(function () {
        $('#editBrandModal').on('show.bs.modal', function (e) {
            var brandId = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');
            var description = $(e.relatedTarget).data('description');
            
            $(e.currentTarget).find('input[id="edit_brandID"]').val(brandId);
            $('#frm_edit input[id="edit_name"]').val(name);
            $('#frm_edit textarea[id="edit_description"]').val(description);
        });

        $('#statBrandModal').on('show.bs.modal', function (e) {
            var warehouseId = $(e.relatedTarget).data('id');
            var stat = $(e.relatedTarget).data('value');
            
            $(e.currentTarget).find('input[id="stat_brandID"]').val(warehouseId);
            $('#frm_stat input[id="stat_isactive"]').val(stat);
        });
    });

</script>