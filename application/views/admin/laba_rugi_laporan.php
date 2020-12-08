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
    <title>Alsan Motor | Profit / Loss Report</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>assets/ample-admin-lite/html/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url() ?>assets/ample-admin-lite/html/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>assets/ample-admin-lite/html/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url() ?>assets/ample-admin-lite/html/css/colors/default.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/DataTables/datatables.min.css")?>">
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
                        <h3 class="page-title"><i class="fa fa-usd fa-fw" aria-hidden="true"></i> Profit / Loss</h3> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <!-- <a href="<?php echo base_url() ?>penjualan/https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro

                        </a> -->
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>c_main/admin_index">Dashboard</a></li>
                            <li class="active">Profit / Loss</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                        <div class="row">

                            <div class="panel panel-default">
                                <!-- <div class="panel-heading"></div> -->
                                <div class="panel-body">
                                <form method="POST" action="<?php echo base_url('c_laba_rugi/generate_laporan_laba_rugi')?>">

                                    <div class="container">

                                        <div class="row">
                                            <div class="col-sm-4">

                                                <div class="form-horizontal">
                                                    <div class="form-group">
                                                        <label class="col-sm-6">From Date</label>
                                                        <div class="col-sm-6">
                                                            <input type="date" name="FromDate" class="form-control" id="FromDate" onchange="getObject()">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-4">

                                                <div class="form-horizontal">
                                                    <div class="form-group">
                                                        <label class="col-sm-6">To Date</label>
                                                        <div class="col-sm-6">
                                                            <input type="date" name="ToDate" class="form-control" id="ToDate">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <button type="submit" class="btn btn-success">Generate Report</button>
                                        </div>

                                        <div class="row">
                                            
                                            <?php if(isset($laba_rugi)){ ?>
                                                <br>
                                                    <a href="<?php echo base_url('C_laba_rugi/export_to_pdf')?>" class="btn btn-danger" target="_blank" title="Export To PDF"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                <br>
                                                <div>Periode : <?php echo '<b>'.$FromDate.' - '.$ToDate.'</b>' ?></div>
                                                <table>
                                                    <tr>
                                                        <td colspan="4"><b>Expenses</b></td>
                                                    </tr>
                                                    <?php foreach($data_beban_detail as $row){ ?>
                                                        <tr>
                                                            <td style="width:150px;"><?php echo $row->nama_beban ?></td>
                                                            <td>Rp. </td>
                                                            <td align="right" style="width:150px;"><?php echo number_format($row->biaya,2) ?></td>
                                                            <td></td>
                                                        </tr>
                                                    <?php }?>
                                                    <tr>
                                                        <td>Purchase</td>
                                                        <td>Rp. </td>
                                                        <td align="right"><?php echo number_format($data_pembelian,2) ?></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right"><b>Total Expense</b></td>
                                                        <td></td>
                                                        <td align="right"><b>Rp.</b></td>
                                                        <td align="right"><b><?php echo number_format($data_beban,2)?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"><b>Income</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Selling</td>
                                                        <td>Rp. </td>
                                                        <td align="right"><?php echo number_format($data_penjualan,2) ?></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right"><b>Total Income</b></td>
                                                        <td></td>
                                                        <td align="right"><b>Rp.</b></td>
                                                        <td align="right"><b><?php echo number_format($data_penjualan,2)?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><b>Profit/Loss</b></td>
                                                        <td align="right"><b>Rp.</b></td>
                                                        <td align="right"><b><?php echo number_format($laba_rugi,2) ?></b></td>
                                                    </tr>
                                                </table>
                                            <?php } ?>
                                        </div>

                                    </div>

                                    </form>
                                </div><!--   penutup panel body -->
                            </div><!--   penutup panel -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by wrappixel.com</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/js/custom.min.js"></script>
    <script src="<?php echo base_url("assets/DataTables/datatables.min.js")?>"></script>
    <!-- <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/js/script_product.js"></script> -->
    <script type="text/javascript">
        function getObject(){
            var FromDateValue=document.getElementById("FromDate").value;
            document.getElementById("ToDate").value=FromDateValue;
        }
    </script>
</body>

</html>
