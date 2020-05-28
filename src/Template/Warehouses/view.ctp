<!-- third party css -->
<?= $this->Html->css('assets/libs/datatables/dataTables.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/datatables/responsive.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/datatables/buttons.bootstrap4.css') ?>
<?= $this->Html->css('assets/libs/datatables/select.bootstrap4.css') ?>
<!-- third party css end -->
<?= $this->Html->css('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') ?>
<?= $this->Html->css('assets/libs/switchery/switchery.min.css') ?>  

<div class="row">
    <div class="col-12">
        <div class="card-box">
           

            <?php $finalQty = 0; ?>
            <div class="row">
                <div class="col-12">
                     <h3 class="m-0 d-print-none font">รายการสินค้าของ <strong>"<?= $warehouse->name ?>"</strong></h3>
                </div>
               
            </div>
             <hr/>
            <div class="row">
                
                <div class="col-12">

                    <table class="table w-100 nowrap" id="scroll-horizontal-datatable">
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

        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>
<!-- end row -->

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


<script>
    $(document).ready(function () {
        $("#scroll-horizontal-datatable").DataTable({
            scrollX: !0,
            "ordering": false,
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function () {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            }
        })
    });
</script>