<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="button-list">
                <?= $this->Html->link(__('<i class="mdi mdi-plus-circle-outline"></i> เพิ่มสินค้า'), ['action' => 'add'], ['class' => 'btn btn-outline-primary waves-effect waves-light', 'escape' => false]) ?>

                <button type="button" class="btn btn-outline-secondary waves-effect waves-light">Secondary</button>
                <button type="button" class="btn btn-outline-success waves-effect waves-light">Success</button>
                <button type="button" class="btn btn-outline-info waves-effect waves-light">Info</button>
                <button type="button" class="btn btn-outline-warning waves-effect waves-light">Warning</button>
                <button type="button" class="btn btn-outline-danger waves-effect waves-light">Danger</button>
                <button type="button" class="btn btn-outline-dark waves-effect waves-light">Dark</button>
                <button type="button" class="btn btn-outline-purple waves-effect waves-light">Purple</button>
                <button type="button" class="btn btn-outline-pink waves-effect waves-light">Pink</button>
                <button type="button" class="btn btn-outline-light waves-effect">Light</button>
            </div>

        </div>
    </div>
</div>
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
            <table cellpadding="0" cellspacing="0" id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr style="background-color: #3b73da91; color: #000;">
                        <th scope="col" style="width: 5%;" class="text-center"><?= __('#') ?></th>
                        <th scope="col" style="width: 20%;"><?= __('ชื่อสินค้า') ?></th>
                        <th scope="col" style="width: 20%;" class="text-center"><?= __('ราคา / ราคาพิเศษ (฿)') ?></th>
                        <th scope="col" style="width: 15%;" class="text-center"><?= __('คงเหลือ') ?></th>
                        <th scope="col" style="width: 10%;" class="text-center"><?= __('สถานะ') ?></th>
                        <th scope="col" style="width: 30%;" class="actions text-center"><?= __('การจัดการ') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $index => $product): ?>
                        <tr>
                            <td class="text-center"><?= h($index + 1) ?></td>
                            <td><?= h($product->name) ?></td>
                            <?php
                            $modalPrice = [
                                'data-id' => $product->id,
                                'data-name' => $product->name,
                                'data-price' => $product->price,
                                'data-special_price' => $product->special_price,
                                'title' => 'แก้ไขสินค้าคงเหลือ',
                                'class' => 'btn btn-link waves-effect px-1 py-0 ml-1',
                                'data-toggle' => 'modal',
                                'data-target' => '#editPriceProductModal',
                                'escape' => false
                            ];
                            ?>
                            <td class="text-center"><?= number_format(h($product->price)) ?> <?php if ($product->special_price != 0) {
                            echo "<strong style='color: #000;'>/</strong> <span style='color: #dd0000;'>" . number_format(h($product->special_price)) . "</span>" . " <span>( " . number_format(h(($product->price - $product->special_price) / $product->price) * 100) . "% )</span>";
                        } ?> <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i>'), ['action' => 'setPrice', $product->id], $modalPrice) ?></td>
                            <?php
                            $modalQty = [
                                'data-id' => $product->id,
                                'data-name' => $product->name,
                                'data-qty' => $product->qty,
                                'title' => 'แก้ไขสินค้าคงเหลือ',
                                'class' => 'btn btn-link waves-effect px-1 py-0 ml-1',
                                'data-toggle' => 'modal',
                                'data-target' => '#editQtyProductModal',
                                'escape' => false
                            ];
                            ?>
                            <td class="text-center"><strong><?php if ($product->qty >= 20) {
                                echo "<span style='color: #18e000;'>" . number_format(h($product->qty)) . "</span>";
                            } else {
                                echo "<span style='color: #dd0000;'>" . number_format(h($product->qty)) . "</span>";
                            } ?></strong> <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i>'), ['action' => 'setQty', $product->id], $modalQty) ?> </td>
                            <td class="text-center">
                                    <?= $this->Form->create('changStatForm', ['url' => ['controller' => 'products', 'action' => 'status'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_stat-' . $index . '']) ?>
                                <fieldset>
                                <?php if (h($product->isactive == 'Y')) { ?>
                                    <?= $this->Form->checkbox(__('isactive'), ['id' => 'isactive-Y-' . $index . '', 'data-plugin' => 'switchery', 'data-color' => '#00b19d', 'data-size' => 'small', 'value' => 'N', 'escape' => false, 'checked' => 'checked', 'onchange' => 'this.form.submit()']) ?>
    <?php } else { ?>
        <?= $this->Form->checkbox(__('isactive'), ['id' => 'isactive-N-' . $index . '', 'data-plugin' => 'switchery', 'data-color' => '#00b19d', 'data-size' => 'small', 'value' => 'Y', 'escape' => false, 'onchange' => 'this.form.submit()']) ?>
                                <?php } ?>
                                <?php echo $this->Form->control('productID', ['id' => 'stat_product_ID-' . $index . '', 'class' => 'form-control', 'label' => false, 'type' => 'hidden', 'value' => $product->id]); ?>
                                </fieldset>
                                <?= $this->Form->end() ?>
                            </td>

                            <td class="actions text-center">
    <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'view', $product->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
    <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'edit', $product->id], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
    <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $product->id], ['confirm' => __('โปรดตรวจสอบ!!...รายการสินค้าที่อยู่ในยี่ห้อนี้ทั้งหมดจะถูกลบไปด้วย\n ยืนยันการลบ #{0}?', $product->name), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                            </td>
                        </tr>
<?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- EDIT PRODUCT QTY -->
<div class="modal fade" id="editQtyProductModal" tabindex="-1" role="dialog" aria-labelledby="editQtyProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 40%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editQtyProductModalLabel">แก้ไขจำนวนคงเหลือสินค้า <span id="product_qty_name"></span></h5>
            </div>
            <div class="modal-body">
<?= $this->Form->create('productQty', ['url' => ['controller' => 'products', 'action' => 'setqty'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_qty_edit']) ?>
                <fieldset>
                    <div class="row">
                        <div class="col-12 px-3">
                            <div class="form-group row pt-1">
                                <label class="col-12 col-form-label">จำนวนคงเหลือปัจจุบัน : <span id="product_qty_now"></label> 
                            </div>
                            <div class="form-group row pt-1">
                                <label class="col-4 col-form-label">แก้ไขจำนวนคงเหลือ : </label>
                                <div class="col-5">
<?php echo $this->Form->control('qty', ['id' => 'edit_qty', 'type' => 'number', 'class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                        <?php echo $this->Form->control('productID', ['id' => 'edit_productID', 'class' => 'form-control', 'type' => 'hidden', 'label' => false]); ?>
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


<!-- EDIT PRODUCT PRICE -->
<div class="modal fade" id="editPriceProductModal" tabindex="-1" role="dialog" aria-labelledby="editPriceProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 40%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPriceProductModalLabel">แก้ไขราคาสินค้า <span id="product_price_name"></span></h5>
            </div>
            <div class="modal-body">
<?= $this->Form->create('productQty', ['url' => ['controller' => 'products', 'action' => 'setprice'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_price_edit']) ?>
                <fieldset>
                    <div class="row">
                        <div class="col-12 px-3">
                            <div class="form-group row pt-1">
                                <label class="col-12 col-form-label">ราคาสินค้าปัจจุบัน : <span id="product_price_now"></span>/<span id="product_Sprice_now"></span> (<span id="product_price_percent"></span> %)</label>
                            </div>
                            <div class="form-group row pt-1">
                                <label class="col-4 col-form-label">แก้ไขราคาเต็มสินค้า : </label>
                                <div class="col-5">
                                    <?php echo $this->Form->control('price', ['id' => 'edit_price', 'type' => 'number', 'class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row pt-1">
                                <label class="col-4 col-form-label">แก้ไขราคาพิเศษ : </label>
                                <div class="col-5">
<?php echo $this->Form->control('special_price', ['id' => 'edit_special_price', 'type' => 'number', 'class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                        <?php echo $this->Form->control('productID', ['id' => 'edit_productID', 'class' => 'form-control', 'type' => 'hidden', 'label' => false]); ?>
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


<style>
    strong {
        font-weight: 700;
    }
    .mce-menubar {
        display: none;
    }
</style>

<?= $this->Html->script('assets/jquery.min.js') ?>
<?= $this->Html->script('assets/libs/switchery/switchery.min.js') ?>

<?= $this->Html->script('assets/libs/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('assets/libs/datatables/dataTables.bootstrap4.js') ?>

<?= $this->Html->script('assets/jquery.core.js') ?>


<script>
    $(document).ready(function () {
        $('#editQtyProductModal').on('show.bs.modal', function (e) {
            var productId = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');
            var qty = $(e.relatedTarget).data('qty');

            $(e.currentTarget).find('input[id="edit_productID"]').val(productId);
            document.getElementById("product_qty_now").innerHTML = qty;
            document.getElementById("product_qty_name").innerHTML = name;
        });

        $('#editPriceProductModal').on('show.bs.modal', function (e) {
            var productId = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');
            var price = $(e.relatedTarget).data('price');
            var Sprice = $(e.relatedTarget).data('special_price');

            $(e.currentTarget).find('input[id="edit_productID"]').val(productId);
            $(e.currentTarget).find('input[id="edit_price"]').val(price);
            $(e.currentTarget).find('input[id="edit_special_price"]').val(Sprice);

            document.getElementById("product_price_now").innerHTML = price;
            document.getElementById("product_Sprice_now").innerHTML = Sprice;
            document.getElementById("product_price_percent").innerHTML = ((price - Sprice) / price) * 100;
            document.getElementById("product_price_name").innerHTML = name;
        });

        $.noConflict();
        var table = $('#datatable').DataTable();
    });

</script>