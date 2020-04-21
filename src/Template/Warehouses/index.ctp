<div id="app-warehouse">
    <div class="row pt-3">
        <div class="col-xl-12 col-lg-12">
            <div class="card-box">
                <div id="warehouse">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 text-left">
                                    <?= $this->Html->link(__('สร้างคลังสินค้า'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
                                    <!-- <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#createModal"> สร้างคลังสินค้า</button> -->
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <?php foreach ($warehouses as $warehouse): ?>
                                    <div class="card org-card col-4">
                                        <div class="card-body org-body-action">
                                            <strong class="header-org">คลังสินค้า :</strong> <?= h($warehouse->name) ?><br/>
                                            <strong class="header-org">ร้านค้า :</strong> <?= h($warehouse->shop->name) ?><br/>
                                            <strong class="header-org">รายละเอียด :</strong> <?= h($warehouse->description) ?><br/>
                                            <div style="display: -webkit-inline-box;">
                                            <strong class="header-org">สถานะ : </strong>&nbsp;
                                                <?php if($warehouse->isactive == 'Y'){ ?>
                                                    <div style="color: #00dd00;">เปิดใช้งาน</div><?php 
                                                }else{ ?>
                                                    <div style="color: #dd0000;">ปิดใช้งาน</div>
                                                <?php } ?>
                                            </div>
                                            <hr/>
                                            <div class="row text-center">
                                                <div class="col-4"><button class="btn btn-info btn-block" type="submit"><i class="mdi mdi-format-list-bulleted"></i> รายการ</button></div>
                                                <div class="col-4"><?= $this->Html->link(__('<i class="mdi mdi-lead-pencil"></i> แก้ไข'), ['action' => 'edit', $warehouse->id], ['class' => 'btn btn-success btn-block', 'escape' => false]) ?></div>
                                                <div class="col-4"><?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $warehouse->id], ['class' => 'btn btn-warning btn-block', 'escape' => false, 'confirm' => __('ยืนยันการลบคลังสินค้า #{0}?', $warehouse->name)]) ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>