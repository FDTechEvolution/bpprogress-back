<?= $this->Html->css('assets/libs/datatables/dataTables.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') ?>
<?= $this->Html->css('assets/libs/switchery/switchery.min.css') ?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">ประเภทสินค้า</h4> 
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row pb-3">
                <div class="col-md-12 text-right">
                    <?= $this->Html->link(__('<i class="mdi mdi-plus-circle-outline"></i> เพิ่มประเภทสินค้า'), ['action' => 'add'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle' => 'modal', 'data-target' => '#addCateModal', 'escape' => false]) ?>
                </div>
            </div>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr style="background-color: #3b73da91; color: #000;">
                        <th scope="col" style="width: 25%;"><?= __('ประเภท') ?></th>
                        <th scope="col" style="width: 30%;"><?= __('รายละเอียด') ?></th>
                        <th scope="col" style="width: 15%;" class="text-center"><?= __('จำนวนสินค้า') ?></th>
                        <th scope="col" style="width: 10%;" class="text-center"><?= __('สถานะ') ?></th>
                        <th scope="col" style="width: 20%;" class="actions text-center"><?= __('การจัดการ') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productCategories as $index => $productCategory): ?>
                        <tr>
                            <td><?= h($productCategory->name) ?></td>
                            <td><?= h($productCategory->description) ?></td>
                            <td class="text-center"><?= h($product_count[$index]) ?></td>
                            <td class="text-center">
                                <?= $this->Form->create('changStatForm', ['url' => ['controller' => 'productCategories', 'action' => 'status'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_stat-' . $index . '']) ?>
                                <fieldset>
                                    <?php if (h($productCategory->isactive == 'Y')) { ?>
                                        <?= $this->Form->checkbox(__('isactive'), ['id' => 'isactive-Y-' . $index . '', 'data-plugin' => 'switchery', 'data-color' => '#00b19d', 'data-size' => 'small', 'value' => 'N', 'escape' => false, 'checked' => 'checked', 'onchange' => 'this.form.submit()']) ?>
                                    <?php } else { ?>
                                        <?= $this->Form->checkbox(__('isactive'), ['id' => 'isactive-N-' . $index . '', 'data-plugin' => 'switchery', 'data-color' => '#00b19d', 'data-size' => 'small', 'value' => 'Y', 'escape' => false, 'onchange' => 'this.form.submit()']) ?>
                                    <?php } ?>
                                    <?php echo $this->Form->control('cateID', ['id' => 'stat_cateID-' . $index . '', 'class' => 'form-control', 'label' => false, 'type' => 'hidden', 'value' => $productCategory->id]); ?>
                                </fieldset>
                                <?= $this->Form->end() ?>
                            </td>
                            <?php
                            $modalCate = [
                                'data-id' => $productCategory->id,
                                'data-name' => $productCategory->name,
                                'data-description' => $productCategory->description,
                                'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5',
                                'data-toggle' => 'modal',
                                'data-target' => '#editCateModal',
                                'escape' => false
                            ];
                            ?>
                            <td class="actions text-center">
                                <!-- <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'view', $productCategory->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?> -->
                                <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'edit', $productCategory->id], $modalCate) ?>
                                <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $productCategory->id], ['confirm' => __('โปรดตรวจสอบ!!...หากยังมีรายการสินค้าที่อยู่ในหมวดหมู่นี้ จะไม่สามารถลบได้\n ยืนยันการลบ #{0}?', $productCategory->name), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ADD CATEGORY -->
<div class="modal fade" id="addCateModal" tabindex="-1" role="dialog" aria-labelledby="addCateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 45%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCateModalLabel">เพิ่มรายการประเภทสินค้า</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('partner', ['url' => ['controller' => 'productCategories', 'action' => 'add'], 'class' => 'form-horizontal', 'role' => 'form']) ?>
                <fieldset>
                    <div class="row">
                        <div class="col-12" style="padding: 20px;">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ชื่อประเภทสินค้า</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">รายละเอียดเพิ่มเติม</label>
                                <div class="col-9">
                                    <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'maxlength' => 255, 'label' => false]); ?>
                                </div>
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


<!-- EDIT CATEGORY -->
<div class="modal fade" id="editCateModal" tabindex="-1" role="dialog" aria-labelledby="editCateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 40%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCateModalLabel">แก้ไขรายการประเภทสินค้า</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('partner', ['url' => ['controller' => 'productCategories', 'action' => 'edit'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_edit']) ?>
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
                            <?php echo $this->Form->control('cateID', ['id' => 'edit_cateID', 'class' => 'form-control', 'type' => 'hidden', 'label' => false]); ?>
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
<!-- Plugins Js -->
<?= $this->Html->script('/css/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') ?>
<?= $this->Html->script('/css/assets/libs/switchery/switchery.min.js') ?>
<?= $this->Html->script('/css/assets/libs/multiselect/jquery.multi-select.js') ?>
<?= $this->Html->script('/css/assets/libs/jquery-quicksearch/jquery.quicksearch.min.js') ?>
<?= $this->Html->script('/css/assets/libs/select2/select2.min.js') ?>
<?= $this->Html->script('/css/assets/libs/bootstrap-select/bootstrap-select.min.js') ?>
<?= $this->Html->script('/css/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') ?>
<?= $this->Html->script('/css/assets/libs/jquery-mask-plugin/jquery.mask.min.js') ?>

<!-- init js -->
<?= $this->Html->script('/css/assets/js/pages/form-advanced.init.js') ?>

<script>
    $(document).ready(function () {
        $('#editCateModal').on('show.bs.modal', function (e) {
            var cateId = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');
            var description = $(e.relatedTarget).data('description');

            $(e.currentTarget).find('input[id="edit_cateID"]').val(cateId);
            $('#frm_edit input[id="edit_name"]').val(name);
            $('#frm_edit textarea[id="edit_description"]').val(description);
        });

    });
</script>