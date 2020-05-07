<div id="app-warehouse">
    <div class="row pt-3">
        <div class="col-xl-12 col-lg-12">
            <div class="card-box">
                <div id="warehouse">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 text-left">
                                    <?= $this->Html->link(__('< ย้อนกลับ'), ['action' => 'index']) ?>
                                    <!-- <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#createModal"> สร้างคลังสินค้า</button> -->
                                </div>
                            </div>
                            <hr/>
                            <div class="assets form large-9 medium-8 columns content">
                                <div class="row pb-2">
                                    <div class="col-lg-12"><legend><?= __('สร้างคลังสินค้า') ?></legend></div>
                                </div>
                                <?= $this->Form->create($warehouse, ['class' => 'row px-3']) ?>
                                <?= $this->Form->hidden('shop_id',['value'=>$user['shop_id']])?>
                                    <fieldset style="width: 100%;">
                                        <div class="row py-2">
                                            <div class="col-lg-2"><label>ชื่อคลังสินค้า : </label></div><div class="col-lg-6"><?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?></div>
                                        </div>
                                       
                                        <div class="row py-2">
                                            <div class="col-lg-2"><label>รายละเอียด : </label></div><div class="col-lg-6"><?php echo $this->Form->control('description', ['class' => 'form-control', 'label' => false]); ?></div>
                                        </div>
                                    </fieldset>
                                    <div class="row py-3">
                                        <div class="col-lg-12">
                                            <?= $this->Form->button(__('สร้างคลังสินค้า'), ['class' => 'btn btn-primary']) ?>
                                        </div>
                                    </div>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>