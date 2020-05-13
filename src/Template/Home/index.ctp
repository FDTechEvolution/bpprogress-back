<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h4 class="page-title"><?= $this->request->getSession()->read('MyAuthen.user.fullname') ?></h4>
        </div>
    </div>
</div> 
<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card-box">

            <h4 class="mt-0 font-16">ยอดขายทั้งหมด</h4>
            <h2 class="text-primary my-3 text-center">฿<span data-plugin="counterup"><?= number_format($salesamt) ?></span></h2>

        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card-box">

            <h4 class="mt-0 font-16">จำนวนคำสั่งซื้อ</h4>
            <h2 class="text-pink my-3 text-center"><span data-plugin="counterup"><?= number_format($countOrder) ?></span></h2>

        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card-box">

            <h4 class="mt-0 font-16">จำนวนสินค้า</h4>
            <h2 class="text-purple my-3 text-center"><span data-plugin="counterup"><?= number_format($countProduct) ?></span></h2>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card-box">

            <h4 class="mt-0 font-16">จำนวนสินค้าคงคลัง</h4>
            <h2 class="text-success my-3 text-center"><span data-plugin="counterup"><?= number_format($warehouseQty) ?></span></h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="card-widgets">
                    <a href="javascript: void(0);" data-toggle="reload" data-action="refresh-tb" data-id="tb-topsales"><i class="mdi mdi-refresh"></i></a>

                </div>
                <h4 class="header-title mb-0">สินค้าขายดีมากสุด</h4>

                <div id="cardCollpase5" class="collapse pt-3 show">
                    <div class="table-responsive">
                        <table class="table table-hover table-centered mb-0" id="tb-topsales">
                            <thead>
                                <tr>
                                    <th>รูปสินค้า</th>
                                    <th>สินค้าสินค้า</th>
                                  
                                    <th class="text-right">ยอดขาย</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                
                            </tbody>
                        </table>
                    </div> <!-- end table responsive-->
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="card-widgets">
                    <a href="javascript: void(0);" data-toggle="reload" data-action="refresh-tb" data-id="tb-topview""><i class="mdi mdi-refresh"></i></a>
                </div>
                <h4 class="header-title mb-0">สินค้าที่มีผู้เยียมชมมากสุด</h4>

                <div id="cardCollpase5" class="collapse pt-3 show">
                    <div class="table-responsive">
                        <table class="table table-hover table-centered mb-0" id="tb-topview">
                            <thead>
                                <tr>
                                    <th>รูปสินค้ารูปสินค้า</th>
                                    <th>สินค้า</th>
                                    <th class="text-right">ยอดวิว</th>
                             
                                </tr>
                            </thead>
                            <tbody>
                                
                               
                            </tbody>
                        </table>
                    </div> <!-- end table responsive-->
                </div> <!-- collapsed end -->
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
<?= $this->Html->script('dashboard.js')?>