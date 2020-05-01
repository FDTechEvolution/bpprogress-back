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
                <li class="mm-active">
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-stack-line"></i>
                        <span> System </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <span> ร้านค้าในระบบ </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <span> ผู้ใช้งานระบบ </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <span> คำสั่งซื้อทั้งหมด </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-stack-line"></i>
                        <span> Master Data </span>
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