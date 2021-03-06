<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                       
                        <span> Dashboards </span>
                    </a>
                </li>
                <li>
                    <?= $this->Html->link('<i class="mdi mdi-cart-plus"></i><span class="badge badge-danger badge-pill float-right">2</span><span> รายการสั่งซื้อ </span>',['controller'=>'orders'],['class'=>'waves-effect','escape'=>false])?>
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
                        <li>
                            <a href="#">นำสินค้าออก</a>
                        </li>
                        <li>
                            <a href="#">ย้ายสินค้า</a>
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