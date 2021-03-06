<!-- third party css -->
<?= $this->Html->css('assets/libs/datatables/dataTables.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/datatables/responsive.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/datatables/buttons.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/datatables/select.bootstrap4.css') ?>

<?= $this->Html->css('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') ?>
<?= $this->Html->css('assets/libs/switchery/switchery.min.css') ?>
<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="button-list">
                <?= $this->Html->link(__('<i class="mdi mdi-plus-circle-outline"></i> เพิ่มสินค้า'), ['action' => 'add'], ['class' => 'btn btn-outline-primary waves-effect waves-light', 'escape' => false]) ?>

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
             <table cellpadding="0" cellspacing="0" id="basic-datatable" class="table w-100">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%;" class="text-center"><?= __('#') ?></th>
                        <th scope="col" style="width: 20%;"><?= __('ชื่อสินค้า') ?></th>
                        <th scope="col" style="width: 17%;" class="text-center"><?= __('ราคา / ราคาพิเศษ (฿)') ?></th>
                        <th scope="col" style="width: 18%;" class="text-center"><?= __('การขาย') ?></th>
                        <th scope="col" style="width: 10%;" class="text-center"><?= __('คงเหลือ') ?></th>
                        <th scope="col" style="width: 10%;" class="text-center"><?= __('สถานะ') ?></th>
                        <th scope="col" style="width: 20%;" class="actions text-center"><?= __('การจัดการ') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $index => $product): ?>
                        <tr>
                            <td class="text-center"><?= h($index + 1) ?></td>
                            <td><?= h($product->name) ?></td>

                            <td class="text-center"><?= number_format(h($product->price)) ?> <?php
                                if ($product->special_price != 0) {
                                    echo "<strong style='color: #000;'>/</strong> <span style='color: #dd0000;'>" . number_format(h($product->special_price)) . "</span>" . " <span>( " . number_format(h(($product->price - $product->special_price) / $product->price) * 100) . "% )</span>";
                                }
                                ?>
                            </td>

                            <td class="text-center">
                                <?php
                                    if($product->isretail == 'Y') {
                                        echo "ปลีก";
                                    }
                                    if($product->iswholesale == 'Y') {
                                        if($product->isretail == 'Y') {
                                            echo " / ";
                                        }
                                        echo "ส่ง";
                                    }
                                    if($product->ispreorder == 'Y') {
                                        if($product->isretail == 'Y' || $product->iswholesale == 'Y') {
                                            echo " / ";
                                        }
                                        echo "พรีออเดอร์";
                                    }
                                ?>
                            </td>

                            <td class="text-center"><strong><?php
                                    if ($product->qty >= 20) {
                                        echo "<span style='color: #18e000;'>" . number_format(h($product->qty)) . "</span>";
                                    } else {
                                        echo "<span style='color: #dd0000;'>" . number_format(h($product->qty)) . "</span>";
                                    }
                                    ?></strong>  </td>
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
                                <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'update', $product->id], ['class' => 'btn btn-sm btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                                <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $product->id], ['confirm' => __('โปรดยืนยันการลบ #{0}?', $product->name), 'class' => 'btn btn-sm btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- third party js -->
<?= $this->Html->script('/css/assets/libs/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/dataTables.bootstrap4.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/dataTables.responsive.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/responsive.bootstrap4.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/dataTables.buttons.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/buttons.html5.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/buttons.flash.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/buttons.print.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/dataTables.keyTable.min.js') ?>
<?= $this->Html->script('/css/assets/libs/datatables/dataTables.select.min.js') ?>
<?= $this->Html->script('/css/assets/libs/pdfmake/pdfmake.min.js') ?>
<?= $this->Html->script('/css/assets/libs/pdfmake/vfs_fonts.js') ?>
<!-- third party js ends -->
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
        $("#basic-datatable").DataTable({
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function () {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            }
        });
    });
</script>