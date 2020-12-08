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
    <title>Alsan Motor | Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>assets/ample-admin-lite/html/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url() ?>assets/ample-admin-lite/html/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>assets/ample-admin-lite/html/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url() ?>assets/ample-admin-lite/html/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
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
        <?php $this->load->view('admin/navbar');?>
        <!-- End Top Navigation -->
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
                        <h4 class="page-title">Dashboard</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <!-- <a href="<?php echo base_url() ?>penjualan/https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro</a> -->
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>penjualan/#">Dashboard</a></li>
                        </ol>
                        <?php //echo print_r($this->session->all_userdata()); ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Different data widgets -->
                <!-- ============================================================== -->
                <!-- .row -->
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Customer Rating (<?php echo date('F') ?>)</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div id="sparklinedash"></div>
                                </li>
                                <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">95</span>%</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Selling (<?php echo date('F') ?>)</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div id="sparklinedash2"></div>
                                </li>
                                <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple"><?php echo number_format($jumlah_total_penjualan,2) ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Item Sold (<?php echo date('F') ?>)</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div id="sparklinedash3"></div>
                                </li>
                                <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info"><?php echo $jumlah_total_product ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/.row -->
                <!--row -->
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Products Yearly Purchase & Sales</h3>
                            <ul class="list-inline text-right">
                                <li>
                                    <h5><i class="fa fa-circle m-r-5 text-info"></i>Purchasing</h5> </li>
                                <li>
                                    <h5><i class="fa fa-circle m-r-5 text-inverse"></i>Selling</h5> </li>
                            </ul>
                            <div id="ct-visits" style="height: 405px;"></div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- table -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <!-- <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                                <select class="form-control pull-right row b-none">
                                    <option>March 2017</option>
                                    <option>April 2017</option>
                                    <option>May 2017</option>
                                    <option>June 2017</option>
                                    <option>July 2017</option>
                                </select>
                            </div> -->
                            <h3 class="box-title">Recent sales</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>SELLING CODE</th>
                                            <th>DATE</th>
                                            <th>EMPLOYEE CODE</th>
                                            <th>PLATE NUMBER</th>
                                            <th>TOTAL QTY</th>
                                            <th>TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                         $no=1;
                                         foreach( $data_penjualan as $row){ ?>
                                             <tr>
                                                <td><?php echo $no?></td>
                                                <td class="txt-oflo"><?php echo $row->kode_penjualan ?></td>
                                                <td><?php echo $row->tanggal_penjualan ?></td>
                                                <td class="txt-oflo"><?php echo $row->kode_karyawan ?></td>
                                                <td class="txt-oflo"><?php echo $row->plat_nomor ?></td>
                                                <td class="txt-oflo text-right"><?php echo $row->total_qty ?></td>
                                                <td class="text-right"><span class="text-success">Rp. <?php echo number_format($row->total,2) ?></span></td>
                                            </tr>
                                        <?php 
                                            $no++;
                                         }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- chat-listing & recent comments -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- .col -->
                    <div class="col-md-12 col-lg-8 col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Recent Comments</h3>
                            <div class="comment-center p-t-10">
                                <div class="comment-body">
                                    <div class="user-img"> <img src="<?php echo base_url()?>assets/ample-admin-lite/plugins/images/users/pawandeep.jpg" alt="user" class="img-circle">
                                    </div>
                                    <div class="mail-contnet">
                                        <h5>Fajar</h5><span class="time">10:20 AM   10  Apr 2019</span>
                                        <br/><span class="mail-desc">Pelayanannya bagus</span> <a href="<?php echo base_url() ?>penjualan/javacript:void(0)" class="btn btn btn-rounded btn-default btn-outline m-r-5"><i class="ti-check text-success m-r-5"></i>Approve</a><a href="<?php echo base_url() ?>penjualan/javacript:void(0)" class="btn-rounded btn btn-default btn-outline"><i class="ti-close text-danger m-r-5"></i> Reject</a>
                                    </div>
                                </div>
                                <div class="comment-body">
                                    <div class="user-img"> <img src="<?php echo base_url()?>assets/ample-admin-lite/plugins/images/users/sonu.jpg" alt="user" class="img-circle">
                                    </div>
                                    <div class="mail-contnet">
                                        <h5>Bakri</h5><span class="time">10:20 AM   20  Mar 2019</span>
                                        <br/><span class="mail-desc">Mobil saya jadi bersih lagi. Terimakasih Alsan Motor :-D</span>
                                    </div>
                                </div>
                                <div class="comment-body b-none">
                                    <div class="user-img"> <img src="<?php echo base_url()?>assets/ample-admin-lite/plugins/images/users/arijit.jpg" alt="user" class="img-circle">
                                    </div>
                                    <div class="mail-contnet">
                                        <h5>Taufik Hidayat</h5><span class="time">10:20 AM   31  Dec 2018</span>
                                        <br/><span class="mail-desc">#2019GantiPresiden</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="panel">
                            <div class="sk-chat-widgets">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        CHAT LISTING
                                    </div>
                                    <div class="panel-body">
                                        <ul class="chatonline">
                                            <li>
                                                <div class="call-chat">
                                                    <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                    <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                </div>
                                                <a href="<?php echo base_url() ?>penjualan/javascript:void(0)"><img src="<?php echo base_url()?>assets/ample-admin-lite/plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span>Firaun <small class="text-success">online</small></span></a>
                                            </li>
                                            <li>
                                                <div class="call-chat">
                                                    <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                    <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                </div>
                                                <a href="<?php echo base_url() ?>penjualan/javascript:void(0)"><img src="<?php echo base_url()?>assets/ample-admin-lite/plugins/images/users/genu.jpg" alt="user-img" class="img-circle"> <span>Butet<small class="text-warning">Away</small></span></a>
                                            </li>
                                            <li>
                                                <div class="call-chat">
                                                    <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                    <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                </div>
                                                <a href="<?php echo base_url() ?>penjualan/javascript:void(0)"><img src="<?php echo base_url()?>assets/ample-admin-lite/plugins/images/users/ritesh.jpg" alt="user-img" class="img-circle"> <span>Paijo <small class="text-danger">Busy</small></span></a>
                                            </li>
                                            <li>
                                                <div class="call-chat">
                                                    <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                    <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                </div>
                                                <a href="<?php echo base_url() ?>penjualan/javascript:void(0)"><img src="<?php echo base_url()?>assets/ample-admin-lite/plugins/images/users/arijit.jpg" alt="user-img" class="img-circle"> <span>Taufik Hidayat <small class="text-muted">Offline</small></span></a>
                                            </li>
                                            <li>
                                                <div class="call-chat">
                                                    <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                    <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                </div>
                                                <a href="<?php echo base_url() ?>penjualan/javascript:void(0)"><img src="<?php echo base_url()?>assets/ample-admin-lite/plugins/images/users/govinda.jpg" alt="user-img" class="img-circle"> <span>Tukiyem <small class="text-success">online</small></span></a>
                                            </li>
                                            <li>
                                                <div class="call-chat">
                                                    <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                    <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                </div>
                                                <a href="<?php echo base_url() ?>penjualan/javascript:void(0)"><img src="<?php echo base_url()?>assets/ample-admin-lite/plugins/images/users/hritik.jpg" alt="user-img" class="img-circle"> <span>Juminten <small class="text-success">online</small></span></a>
                                            </li>
                                            <li>
                                                <div class="call-chat">
                                                    <button class="btn btn-success btn-circle btn-lg" type="button"><i class="fa fa-phone"></i></button>
                                                    <button class="btn btn-info btn-circle btn-lg" type="button"><i class="fa fa-comments-o"></i></button>
                                                </div>
                                                <a href="<?php echo base_url() ?>penjualan/javascript:void(0)"><img src="<?php echo base_url()?>assets/ample-admin-lite/plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span>Cecep <small class="text-success">online</small></span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by wrappixel.com </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/js/waves.js"></script>
    <!--Counter js -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!-- chartist chart -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/js/custom.min.js"></script>
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/js/dashboard1.js"></script>
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
</body>

</html>
