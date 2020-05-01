<?= $this->Html->css('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css') ?>
<?= $this->Html->css('assets/libs/clockpicker/bootstrap-clockpicker.min.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') ?>
<?= $this->Html->css('assets/libs/bootstrap-daterangepicker/daterangepicker.css') ?>

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-12">
                    <h2>รับสินค้าเข้าระบบ No.<?= $goodsReceipt->docno ?></h2>
                </div>
            </div>

            <?= $this->Form->create($goodsReceipt, ['class' => 'form-horizontal', 'role' => 'form', 'id' => 'add-goods-receipt']) ?>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="form-group row">
                        <label class="col-2 col-form-label">รับเข้าคลังสินค้า</label>
                        <div class="col-9">
                            <strong><?= $goodsReceipt->warehouse->name ?></strong>
                            <?= ''// $this->Form->control('warehouse_id', ['options' => $warehouses, 'class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">วันที่</label>
                        <div class="col-5">
                            <strong><?= $goodsReceipt->docdate->i18nFormat(DATE_FORMATE, null, NULL) ?></strong>
                            <div class="input-group" style="display: none;">
                                <input type="text" class="form-control" id="docdate" name="docdate">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="ti-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">รายละเอียด</label>
                        <div class="col-9">
                            <?= $this->Form->textarea('description', ['class' => 'form-control', 'row' => '5']) ?>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-8 col-12 text-left">
                            <h3>รายการสินค้า</h3>
                        </div>
                        <div class="col-md-4 col-12 text-right">
                            <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target=".bs-example-modal-xl">เพิ่มสินค้า</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table" id="tb-product-selected">
                                <thead>
                                    <tr>
                                       
                                        <th></th>
                                        <th>ชื่อสินค้า</th>
                                        <th class="text-right">จำนวนที่นำเข้า</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($goodsReceipt->goods_lines as $index => $line): ?>
                                        <tr id="<?= $line->product->id ?>">
                                           
                                            <td>
                                                <?php
                                                $imgUrl = $line->product->product_images[0]['image']['fullpath'];
                                                echo $this->Html->image($imgUrl, ['width' => '70']);
                                                ?>
                                            </td>
                                            <td><?= $line->product->name ?></td>
                                            <td class="text-right"><?= number_format($line->qty) ?></td>
                                            <td class="text-right">
                                                <input type="hidden" name="lines[product_id][]" value="<?= $line->product->id ?>"/>
                                                <input type="hidden" name="lines[qty][]" value="<?= $line->qty ?>"/>
                                                <button class="btn btn-outline-secondary" onclick="removeElementById('<?= $line->product->id ?>')">ลบ</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <button type="submit" id="" class="btn btn-outline-primary btn-lg">บันทึก</button>
                    <?= $this->Html->link('ยืนยันการนำเข้า',['action'=>'confirm',$goodsReceipt->id],['class'=>'btn btn-primary btn-lg'])?>
                    
                </div>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myExtraLargeModalLabel">รายการสินค้าในระบบ</h4>

            </div>
            <div class="modal-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>ชื่อสินค้า</th>
                            <th>จำนวนคงเหลือ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $index => $product): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <?php if (sizeof($product->product_images) == 0) { ?>
                                        <?= $this->Html->image('no-image.jpg', ['width' => '80']) ?>
                                    <?php } else { ?>
                                        <?= $this->Html->image($product->product_images[0]['image']['fullpath'], ['width' => '80']) ?>
                                    <?php } ?>
                                </td>
                                <td><?= $product->name ?></td>
                                <td>0</td>
                                <td>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="check_<?= $product->id ?>" value="<?= $product->id ?>" name="modal_product_id">
                                            <label class="custom-control-label" for="check_<?= $product->id ?>">เลือก</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" id="bt-modal-save">บันทึก</button>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->script('/css/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') ?>
<?= $this->Html->script('/css/assets/libs/clockpicker/bootstrap-clockpicker.min.js') ?>
<?= $this->Html->script('/css/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>
<?= $this->Html->script('/css/assets/libs/moment/moment.min.js') ?>
<?= $this->Html->script('/css/assets/libs/bootstrap-daterangepicker/daterangepicker.js') ?>

<script>
    $(document).ready(function () {
        $('#docdate').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            locale: {
                applyLabel: "Submit",
                cancelLabel: "Cancel",
                fromLabel: "From",
                toLabel: "To",
                customRangeLabel: "Custom",
                daysOfWeek: ["อา", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                monthNames: ["มกราคม", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                firstDay: 1
            }
        });


        $('#bt-modal-save').on('click', function () {
            var productIds = [];
            $.each($("input[name='modal_product_id']:checked"), function () {
                productIds.push($(this).val());

                $.get(siteurl + 'sv-products/get-detail-product', {product: $(this).val()})
                        .done(function (data) {
                            var json = JSON.parse(data);
                            var product = json.data;
                            console.log(json);

                            if ($('#' + product.id).length === 0) {
                                //tb-product-selected
                                var strContent = '';
                                strContent += '<tr id="' + product.id + '">';
                              
                                strContent += '<td><image src="' + product.images + '" width="70"/></td>';
                                strContent += '<td>' + product.name + '</td>';
                                strContent += '<td>';
                                strContent += '<input type="number" name="lines[qty][]" value="0" class="form-control"/>';
                                strContent += '<input type="hidden" name="lines[product_id][]" value="' + product.id + '"/>';
                                strContent += '</td>';
                                strContent += '<td class="text-right"><button class="btn btn-outline-secondary" onclick="removeElementById(\'' + product.id + '\')">ลบ</button></td>';
                                strContent += '</tr>';

                                $("#tb-product-selected tbody").append(strContent);
                            }

                        });

            });

            //console.log(productIds);
        });

    });
</script>
