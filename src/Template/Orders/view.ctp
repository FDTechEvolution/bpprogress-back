<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">หมายเลขคำสั่งซื้อ <?= $order['docno'] ?></h4> 
            <div class="clearfix"></div>
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
                    <h3 class="m-0 d-print-none font">ใบสั่งซื้อสินค้า (Order)</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <h5><strong>บริษัท บี.พี.โปรเกรส อินเตอร์เนชั่นแนล จำกัด</strong></h5>
                    <address>
                        สำนักงานใหญ่ นครราชสีมา<br>
                        เลขที่ 969/22 ม.3 ถ.มิตรภาพ<br>
                        ต.จอหอ อ.เมือง จ.นครราชสีมา<br>
                        <abbr title="Phone">P:</abbr> โทร.044-276886  แฟ๊กซ์ 044-928504
                    </address>

                </div><!-- end col -->
                <div class="col-md-5 offset-md-2">
                    <div class="mt-3 float-right">
                        <p class="m-b-10"><strong>วันที่สั่งซื้อ : </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp;&nbsp; <?= $order->docdate->i18nFormat(DATE_FORMATE, null, NULL) ?></span></p>
                        <p class="m-b-10"><strong>สถานะ : </strong> <span class="float-right"><?= $orderStatus[$order->status] ?></span></p>
                        <p class="m-b-10"><strong>หมายเลขเอกสาร. : </strong> <span class="float-right"><?= $order->docno ?> </span></p>

                    </div>
                </div><!-- end col -->
            </div>

            <div class="row mt-3">
                <div class="col-sm-6">
                    <h4 class="font-kanit-600">ที่อยู่สำหรับจัดส่ง</h4>
                    <?php
                    $address = $order['address'];
                    $user = $order['user']
                    ?>
                    <address>
                        <?= $user['fullname'] ?><br>
                        <?= $address['address_line'] ?><br>
                        <?= sprintf('%s, %s, %s %s', $address['subdistrict'], $address['district'], $address['province'], $address['zipcode']) ?><br>
                        <abbr title="Phone">P:</abbr> <?= $address['mobile'] ?>
                    </address>
                </div>
                <div class="col-sm-6">
                    <h4 class="font-kanit-600">การชำระเงิน</h4>
                    <dl class="row">
                        <dt class="col-sm-3">รูปแบบการชำระเงิน</dt>
                        <dd class="col-sm-9"><?= $paymentMethod[$order['payment_method']] ?></dd>
                        <dt class="col-sm-3">สถานะการชำระเงิน</dt>
                        <dd class="col-sm-9"><?= $paymentStatus[$order['payment_status']] ?></dd>


                    </dl>
                </div>
            </div> 
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table mt-4 table-centered">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 10%"></th>
                                    <th>รายการ</th>
                                    <th class="text-right">ราคา</th>
                                    <th class="text-right">จำนวน</th>
                                    <th class="text-right">ราคารวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order['order_lines'] as $index => $line): ?>
                                    <tr id="<?= $line->product->id ?>">
                                        <td><?= $index + 1 ?></td>
                                        <td>
                                            <?php
                                            $imgUrl = $line->product->product_images[0]['image']['fullpath'];
                                            echo $this->Html->image($imgUrl, ['width' => '70']);
                                            ?>
                                        </td>
                                        <td><?= $line->product->name ?></td>
                                        <td class="text-right"><?= number_format($line->unit_price) ?></td>
                                        <td class="text-right"><?= number_format($line->qty) ?></td>
                                        <td class="text-right"><?= number_format($line->amount) ?></td>
                                    </tr>
                                    
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-6">
                    <div class="clearfix pt-5">
                        <h6 class="text-muted">Notes:</h6>

                        <small class="text-muted">
                            
                        </small>
                    </div>
                </div> <!-- end col -->
                <div class="col-sm-6">
                    <div class="float-right">
                        <h3><?= number_format($order['totalamt'])?> บาท</h3>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="mt-4 mb-1">
                <div class="text-right d-print-none">
                    <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer mr-1"></i> Print</a>
                   
                </div>
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>
<!-- end row -->
