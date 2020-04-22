<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">คลังสินค้า</h4> 
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row pb-3">
                <div class="col-md-12 text-right">
                    <?= $this->Html->link(__('<i class="fa fa-cart-plus"></i> เพิ่มคลังสินค้า'), ['action' => 'add'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle' => 'modal', 'data-target' => '#addWHModal', 'escape' => false]) ?>
                </div>
            </div>
            <table cellpadding="0" cellspacing="0" id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr style="background-color: #3b73da91; color: #000;">
                        <th scope="col" style="width: 15%;"><?= __('คลังสินค้า') ?></th>
                        <th scope="col" style="width: 40%;"><?= __('รายละเอียด') ?></th>
                        <th scope="col" style="width: 15%;" class="text-center"><?= __('สถานะ') ?></th>
                        <th scope="col" style="width: 30%;" class="actions text-center"><?= __('การจัดการ') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($warehouses as $warehouse): ?>
                    <tr>
                        <td><?= h($warehouse->name) ?></td>
                        <td><?= h($warehouse->description) ?></td>
                        <td class="text-center">
                            <?php if(h($warehouse->isactive == 'Y')) { ?>
                                <?= $this->Form->button(__('<i class="mdi mdi-earth"></i> เปิดใช้งาน'), ['class' => 'btn btn-success waves-effect waves-light', 'data-toggle' => 'modal', 'data-target' => '#statWHModal', 'data-id' => $warehouse->id, 'data-value' => 'N', 'escape' => false, 'title'=>'คลิกเพื่อปิดการใช้งาน']) ?>
                            <?php }else{ ?>
                                <?= $this->Form->button(__('<i class="mdi mdi-earth-off"></i> ปิดการใช้งาน'), ['class' => 'btn btn-outline-secondary', 'data-toggle' => 'modal', 'data-target' => '#statWHModal', 'data-id' => $warehouse->id, 'data-value' => 'Y', 'escape' => false, 'title'=>'คลิกเพื่อเปิดใช้งาน']) ?>
                            <?php } ?>
                        </td>
                        <?php
                            $modalWH = [
                                'data-id' => $warehouse->id,
                                'data-name' => $warehouse->name,
                                'data-description' => $warehouse->description,
                                'data-shop' => $warehouse->shop_id,
                                'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5',
                                'data-toggle' => 'modal', 
                                'data-target' => '#editWHModal',
                                'escape' => false
                            ];
                        ?>
                        <td class="actions text-center">
                            <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'view', $warehouse->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'edit', $warehouse->id], $modalWH) ?>
                            <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $warehouse->id], ['confirm' => __('ยืนยันการลบคลังสินค้า #{0}?', $warehouse->name), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ADD WAREHOUSE -->
<div class="modal fade" id="addWHModal" tabindex="-1" role="dialog" aria-labelledby="addWHModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 40%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWHModalLabel">เพิ่มรายการคลังสินค้า</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('warehouse', ['url'=>['controller'=>'warehouses', 'action'=>'add'], 'class' => 'form-horizontal', 'role' => 'form']) ?>
                <fieldset>
                    <div class="row">
                        <div class="col-12" style="padding: 20px;">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ชื่อคลังสินค้า</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">รายละเอียด</label>
                                <div class="col-9">
                                    <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'maxlength' => 255, 'label' => false]); ?>
                                </div>
                            </div>
                            <?php echo $this->Form->control('shop_id', ['id' => 'add_shopID', 'type' => 'hidden', 'value' => '1111']); ?>
                            <?php echo $this->Form->control('isactive', ['type' => 'hidden', 'value' => 'Y']); ?>
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


<!-- EDIT WAREHOUSE -->
<div class="modal fade" id="editWHModal" tabindex="-1" role="dialog" aria-labelledby="editWHModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 40%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editWHModalLabel">แก้ไขรายการคลังสินค้า</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('warehouse', ['url'=>['controller'=>'warehouses', 'action'=>'edit'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_edit']) ?>
                <fieldset>
                    <div class="row">
                        <div class="col-12" style="padding: 20px;">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ชื่อคลังสินค้า</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('name', ['id' => 'edit_name', 'class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">รายละเอียด</label>
                                <div class="col-9">
                                    <?php echo $this->Form->textarea('description', ['id' => 'edit_description', 'maxlength' => 255, 'class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <?php echo $this->Form->control('shop_id', ['id' => 'edit_shopID', 'type' => 'hidden']); ?>
                            <?php echo $this->Form->control('WH_ID', ['id' => 'edit_WH_ID', 'type' => 'hidden']); ?>
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


<!-- Change Stat warehouse -->
<div class="modal fade" id="statWHModal" tabindex="-1" role="dialog" aria-labelledby="statWHModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statWHModalLabel">เปลี่ยนสถานะ</h5>
            </div>
            <div class="modal-body">
                ยืนยันการเปลี่ยนแปลงสถานะ ?
            </div>
            <div class="modal-footer">
            <?= $this->Form->create('wh', ['url'=>['controller'=>'warehouses', 'action'=>'status'], 'class' => 'form-horizontal', 'role' => 'form','id'=>'frm_stat']) ?>
                <fieldset>
                    <?php echo $this->Form->control('WH_ID', ['id' => 'stat_WH_ID', 'class' => 'form-control', 'label' => false, 'type' => 'hidden']); ?>
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



<script>
    $(document).ready(function () {

        $('#editWHModal').on('show.bs.modal', function (e) {
            var warehouseId = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');
            var description = $(e.relatedTarget).data('description');
            var shopId = $(e.relatedTarget).data('shop');
            
            $(e.currentTarget).find('input[id="edit_WH_ID"]').val(warehouseId);
            $('#frm_edit input[id="edit_name"]').val(name);
            $('#frm_edit textarea[id="edit_description"]').val(description);
            $('#frm_edit input[id="edit_shopID"]').val(shopId);
        });

        $('#statWHModal').on('show.bs.modal', function (e) {
            var warehouseId = $(e.relatedTarget).data('id');
            var stat = $(e.relatedTarget).data('value');
            
            $(e.currentTarget).find('input[id="stat_WH_ID"]').val(warehouseId);
            $('#frm_stat input[id="stat_isactive"]').val(stat);
        });
    });
</script>