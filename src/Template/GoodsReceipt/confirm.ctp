<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h4 class="page-title">ยืนยันการนำเข้าสินค้า</h4>
        </div>
    </div>
</div>     

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <!-- Logo & title -->
            <div class="clearfix">
                <div class="float-left">
                    <?= $this->Html->image('logo/logo-light.png', ['height' => '30']) ?>
                </div>
                <div class="float-right">
                    <h3 class="m-0 d-print-none font">ใบรับสินค้า (Goods Receipt)</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h5>บริษัท บี.พี.โปรเกรส อินเตอร์เนชั่นแนล จำกัด</h5>
                    <address>
                        สำนักงานใหญ่ นครราชสีมา<br>
                        เลขที่ 969/22 ม.3 ถ.มิตรภาพ<br>
                        ต.จอหอ อ.เมือง จ.นครราชสีมา<br>
                        <abbr title="Phone">P:</abbr> โทร.044-276886  แฟ๊กซ์ 044-928504
                    </address>

                </div><!-- end col -->
                <div class="col-md-4 offset-md-2">
                    <div class="mt-3 float-right">
                        <p class="m-b-10"><strong>วันที่ : </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp;&nbsp; <?= $goodsReceipt->docdate->i18nFormat(DATE_FORMATE, null, NULL) ?></span></p>
                        <p class="m-b-10"><strong>สถานะ : </strong> <span class="float-right"><?= $goodsReceipt->status ?></span></p>
                        <p class="m-b-10"><strong>หมายเลขเอกสาร. : </strong> <span class="float-right"><?= $goodsReceipt->docno ?> </span></p>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->


            <?php $finalQty = 0; ?>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table mt-4 table-centered">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 10%"></th>
                                    <th>รายการ</th>

                                    <th class="text-right">จำนวน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($goodsReceipt->goods_lines as $index => $line): ?>
                                    <tr id="<?= $line->product->id ?>">
                                        <td><?= $index + 1 ?></td>
                                        <td>
                                            <?php
                                            $imgUrl = $line->product->product_images[0]['image']['fullpath'];
                                            echo $this->Html->image($imgUrl, ['width' => '70']);
                                            ?>
                                        </td>
                                        <td><?= $line->product->name ?></td>
                                        <td class="text-right"><?= number_format($line->qty) ?></td>

                                    </tr>
                                    <?php $finalQty += $line->qty; ?>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div> <!-- end table-responsive -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-6">

                </div> <!-- end col -->
                <div class="col-sm-6">
                    <div class="float-right">

                        <h3>รวมทั้งหมด <?= number_format($finalQty) ?> ชิ้น</h3>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="mt-4 mb-1">
                <div class="text-right d-print-none">

                    <?= $this->Form->create('confirm') ?>
                    <?= $this->Form->hidden('id', ['value' => $goodsReceipt->id]) ?>
                    <?= $this->Form->hidden('status', ['value' => 'CF']) ?>
                    <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light btn-lg"><i class="mdi mdi-printer mr-1"></i> Print</a>
                    <?php if ($goodsReceipt->status != 'CF') { ?>
                        <button type="submit" class="btn btn-success waves-effect waves-light btn-lg">ยืนยัน</button>
                    <?php } ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>
<!-- end row -->