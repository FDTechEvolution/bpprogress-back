<div class="row mt-3">
    <div class="col-12">
        
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
                    <h3 class="m-0 d-print-none font">รายการสินค้าของ <strong>"<?=$warehouse->name?>"</strong></h3>
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
                                
                                    <th>รายการ</th>

                                    <th class="text-right">จำนวน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($warehouse->warehouse_products as $index => $line): ?>
                                    <tr id="<?= $line->product->id ?>">
                                        <td><?= $index + 1 ?></td>
                                       
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

                    <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light btn-lg"><i class="mdi mdi-printer mr-1"></i> Print</a>
                </div>
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>
<!-- end row -->