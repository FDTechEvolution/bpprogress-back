<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">เมนู</li>
                <li>
                    <?= $this->Html->link('<i class="remixicon-dashboard-line"></i><span>Dashboards </span>', ['controller' => 'home'],['class'=>'waves-effect','escape'=>false]) ?>
                </li>
                <li>
                    <?= $this->Html->link('<i class="mdi mdi-cart-plus"></i><span class="badge badge-danger badge-pill float-right" id="notis-new-order"></span><span> รายการสั่งซื้อ </span>', ['controller' => 'orders', 'action' => 'index', 'status' => 'NEW'], ['class' => 'waves-effect', 'escape' => false]) ?>
                </li>
                <li>
                    <?= $this->Html->link('<i class="mdi mdi-cube-send"></i><span class="badge badge-danger badge-pill float-right" id="notis-new-preorder"></span><span> รายการพรีออเดอร์ </span>', ['controller' => 'pre-orders', 'action' => 'index', 'status' => 'NEW'], ['class' => 'waves-effect', 'escape' => false]) ?>
                </li>
                <li>
                    <?= $this->Html->link('<i class="fas fa-money-bill-wave-alt"></i><span class="badge badge-danger badge-pill float-right" id="notis-new-payment"></span><span> แจ้งชำระเงิน </span>', ['controller' => 'payments', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?>
                </li>
                <li class="mm-active">
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-stack-line"></i>
                        <span> คลัง/สินค้า </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <?= $this->Html->link('รายการสินค้า', ['controller' => 'products']) ?>
                        </li>
                        <li>
                            <?= $this->Html->link('คลังสินค้า', ['controller' => 'warehouses']) ?>
                        </li>
                        <li>
                            <?= $this->Html->link('รับสินค้าเข้า', ['controller' => 'goods-receipt']) ?>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-stack-line"></i>
                        <span> ข้อมูลหลัก </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <?= $this->Html->link('ประเภทสินค้า', ['controller' => 'product-categories']) ?>
                        </li>
                        <li>
                            <?= $this->Html->link('ยี่ห้อสินค้า', ['controller' => 'brands']) ?>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->