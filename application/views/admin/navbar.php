<nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="logonya.html">
                        <!-- Logo icon image, you can use font-icon also -->
                    <!-- <b> -->
                        <!--This is dark logo icon-->
                        <!-- <img src="<?php echo base_url()?>assets/img/logo_alsan.png" alt="home" class="dark-logo"/> -->
                        <!--This is light logo icon-->
                        <img src="<?php echo base_url()?>assets/img/logo_alsan.png" alt="home" class="light-logo" style="position:relative; width:30%; margin-left:0; left:0"/>
                     <!-- </b> -->
                        <!-- Logo text image you can use text also -->
                        <span class="hidden-xs">
                        <!--This is dark logo text-->
                        <!-- <img src="<?php echo base_url()?>assets/img/logo_alsan_2.png" alt="home" class="dark-logo" /> -->
                        <!--This is light logo text-->
                        <img src="<?php echo base_url()?>assets/img/logo_alsan_2.png" alt="home" class="light-logo" style="position:relative; width:60%; margin-left:0; left:0"/>
                        </span> 
                     </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control"> <a href="<?php echo base_url() ?>penjualan/"><i class="fa fa-search"></i></a> </form>
                    </li>
                    <li>
                        <a class="profile-pic" href="#"> <img src="<?php echo base_url()?>assets/ample-admin-lite/plugins/images/users/<?php echo $this->session->foto ?>" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $this->session->nama_karyawan ?></b></a>
                    </li>
                    <li>
                    <a class="profile-pic" href="<?php echo base_url('c_login/logout')?>"><span class="glyphicon glyphicon-log-out"></span></i></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>