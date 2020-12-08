<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/ample-admin-lite/plugins/images/favicon.png"> -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/img/logo_alsan.png">
    <title>Alsan Motor | Profile</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>assets/ample-admin-lite/html/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url()?>assets/ample-admin-lite/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url()?>assets/ample-admin-lite/html/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>assets/ample-admin-lite/html/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url()?>assets/ample-admin-lite/html/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url()?>assets/ample-admin-lite/https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="<?php echo base_url()?>assets/ample-admin-lite/https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php $this->load->view('admin/navbar');?><!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php 
        
            $this->load->view("admin/sidebar"); 
        
        ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">My Profile</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <!-- <a href="<?php echo base_url() ?>penjualan/https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro</a> -->
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>penjualan/#">Dashboard</a></li>
                            <li class="active">Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="<?php echo base_url()?>assets/ample-admin-lite/plugins/images/users/<?php echo $data_karyawan->foto ?>">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="<?php echo base_url() ?>penjualan/javascript:void(0)"><img src="<?php echo base_url()?>assets/ample-admin-lite/plugins/images/users/<?php echo $data_karyawan->foto ?>" class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white"><?php echo $data_karyawan->nama_karyawan ?></h4>
                                        <h5 class="text-white"><?php echo $data_karyawan->email ?></h5> </div>
                                </div>
                            </div>
                            <div class="user-btm-box">
                                <div class="col-md-3 col-sm-4 text-center">
                                    <p class="text-purple"><i class="ti-facebook"></i></p>
                                    <h1><?php echo substr($data_karyawan->tanggal_masuk,5,2) ?></h1> </div>
                                <div class="col-md-3 col-sm-4 text-center">
                                    <p class="text-blue"><i class="ti-twitter"></i></p>
                                    <h1><?php echo substr($data_karyawan->tanggal_masuk,8,2) ?></h1> </div>
                                <div class="col-md-6 col-sm-4 text-center">
                                    <p class="text-danger"><i class="ti-dribbble"></i></p>
                                    <h1><?php echo substr($data_karyawan->tanggal_masuk,0,4) ?></h1> </div>
                            </div>
                            <div class="text-center">
                              <?php
                                $date1=date_create($data_karyawan->tanggal_masuk);
                                $date2=date_create(date("Y-m-d"));
                                $diff=date_diff($date1,$date2);
                                echo $diff->format("%R%a Days Working");
                              ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <form class="form-horizontal form-material">
                                <div class="form-group">
                                    <label class="col-md-12">Employee Code</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="<?php echo $data_karyawan->kode_karyawan ?>" class="form-control form-control-line" readonly> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Employee Name</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="<?php echo $data_karyawan->nama_karyawan ?>" class="form-control form-control-line" readonly> </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" placeholder="<?php echo $data_karyawan->email ?>" class="form-control form-control-line" name="example-email" id="example-email" readonly> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Gender</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="<?php echo $data_karyawan->jenis_kelamin ?>" class="form-control form-control-line" readonly> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Address</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="<?php echo $data_karyawan->alamat ?>" class="form-control form-control-line" readonly> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Phone Number</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="<?php echo $data_karyawan->no_telp ?>" class="form-control form-control-line" readonly> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Division</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="<?php echo $data_karyawan->divisi ?>" class="form-control form-control-line" readonly> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">User Id</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="<?php echo $data_karyawan->userid ?>" class="form-control form-control-line" readonly> </div>
                                </div>
                                <!-- <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Update Profile</button>
                                    </div>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by wrappixel.com </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="<?php echo base_url()?>assets/ample-admin-lite/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()?>assets/ample-admin-lite/html/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url()?>assets/ample-admin-lite/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url()?>assets/ample-admin-lite/html/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url()?>assets/ample-admin-lite/html/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()?>assets/ample-admin-lite/html/js/custom.min.js"></script>
</body>

</html>
