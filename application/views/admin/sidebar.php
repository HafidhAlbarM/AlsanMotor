<div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                        <a href="<?php echo base_url('c_main/admin_index') ?>" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('c_main/admin_profile') ?>" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Profile</a>
                    </li>
                    <?php if($this->session->level=='1' || $this->session->level=='2'){ ?>
                    <li>
                        <a href="<?php echo base_url('c_main/admin_transaksi_penjualan') ?>" class="waves-effect"><i class="fa fa-dollar fa-fw" aria-hidden="true"></i>Selling Transaction</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('c_main/admin_transaksi_penjualan_list') ?>" class="waves-effect"><i class="fa fa-dollar fa-fw" aria-hidden="true"></i> Transaction List</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('c_main/admin_transaksi_pemesanan_list') ?>" class="waves-effect"><i class="fa fa-dollar fa-fw" aria-hidden="true"></i> Order List</a>
                    </li>
                    <?php } ?>
                    <?php if($this->session->level=='1'){ ?>
                    <li>
                        <a href="<?php echo base_url('c_main/admin_transaksi_pembelian') ?>" class="waves-effect"><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i>Purchasing Transaction</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('c_main/admin_transaksi_beban') ?>" class="waves-effect"><i class="fa fa-bolt fa-fw" aria-hidden="true"></i>Expense Transaction</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('c_main/admin_product') ?>" class="waves-effect"><i class="fa fa-archive fa-fw" aria-hidden="true"></i>Product</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('c_main/admin_karyawan') ?>" class="waves-effect"><i class="fa fa-users fa-fw" aria-hidden="true"></i>Employee</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('c_main/admin_user') ?>" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i>User</a>
                    </li>
                    <?php } ?>
                    <?php if($this->session->level=='1' || $this->session->level=='2'){ ?>
                    <li>
                        <a href="<?php echo base_url('c_main/admin_mobil') ?>" class="waves-effect"><i class="fa fa-car fa-fw" aria-hidden="true"></i>Car</a>
                    </li>
                    <?php } ?>
                    <?php if($this->session->level=='1'){ ?>
                    <li>
                        <a href="<?php echo base_url('c_main/admin_distributor') ?>" class="waves-effect"><i class="fa fa-table fa-truck fa-fw" aria-hidden="true"></i>Distributor</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url("c_main/admin_transaksi_pembelian_laporan") ?>" class="waves-effect"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i>Purchasing</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url("c_main/admin_transaksi_pembelian_laporan_detail") ?>" class="waves-effect"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i>Purchasing Detail</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url("c_main/admin_transaksi_penjualan_laporan") ?>" class="waves-effect"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i>Selling</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url("c_main/admin_transaksi_penjualan_laporan_detail") ?>" class="waves-effect"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i>Selling Detail</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url("c_main/admin_laba_rugi_laporan") ?>" class="waves-effect"><i class="fa fa-usd fa-fw" aria-hidden="true"></i>Profit / Loss</a>
                    </li>
                    <?php } ?>
                    <!-- <li>
                        <a href="<?php echo base_url() ?>c_main/fontawesome.html" class="waves-effect"><i class="fa fa-font fa-fw" aria-hidden="true"></i>Icons</a>
                    </li> -->
                    <li>
                        <a href="<?php echo base_url() ?>c_main/admin_google_map" class="waves-effect"><i class="fa fa-globe fa-fw" aria-hidden="true"></i>Google Map</a>
                    </li>
                    <!-- <li>
                        <a href="<?php //echo base_url() ?>c_main/404.html" class="waves-effect"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>Error 404</a>
                    </li> -->

                </ul>
                <!-- <div class="center p-20">
                     <a href="<?php //echo base_url() ?>c_main/https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger btn-block waves-effect waves-light">Upgrade to Pro</a>
                 </div> -->
            </div>
            
        </div>