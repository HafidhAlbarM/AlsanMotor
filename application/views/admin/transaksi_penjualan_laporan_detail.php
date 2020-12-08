<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png"> -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/img/logo_alsan.png">
    <title>Alsan Motor | Selling Report</title>
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
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
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
                        <h3 class="page-title">Selling Report Detail <i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i></h3> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <!-- <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro</a> -->
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('c_main/admin_index') ?>">Dashboard</a></li>
                            <li class="active">Selling Report</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <div class="row">

                                <div class="panel panel-default">
                                    <!-- <div class="panel-heading"></div> -->
                                    <div class="panel-body">
                                     <form method="POST" action="<?php echo base_url('C_transaksipenjualan/generate_report_penjualan_detail') ?>">

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

                                                <div class="col-sm-9">
                                                    <?php
                                                     if(isset($data_transaksi)){ 
                                                        //  $total=0;
                                                        //  $total_qty=0;
                                                        //  foreach($data_transaksi->result() as $row){
                                                        //      $total=$total+$row->total;
                                                        //      $total_qty=$total_qty+$row->total_qty;
                                                        //  }
                                                    ?>
                                                        <br>
                                                        <a href="<?php echo base_url('C_transaksipenjualan/export_to_pdf_detail')?>" class="btn btn-danger" target="_blank" title="Export To PDF"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                        <div>Periode : <?php echo '<b>'.$FromDate.' - '.$ToDate.'</b>' ?></div>
                                                        <!-- <div>Purchase Total : <?php echo '<b> Rp. '. number_format($total,2).'</b>' ?></div>
                                                        <div>Item Total : <?php echo '<b>'. number_format($total_qty) ?></div> -->
                                                        <table class="table table-stripped" id="TableTransaksi">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Selling Code</th>
                                                                <th>Date</th>
                                                                <th>Product Code</th>
                                                                <th>Price</th>
                                                                <th>Qty</th>
                                                                <th>Sub Total</th>
                                                                <!-- <th>Print</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $no=1;
                                                                foreach($data_transaksi->result() as $row){ ?>
                                                                    <tr>
                                                                        <td><?php echo $no ?></td>
                                                                        <td><?php echo $row->kode_penjualan?></td>
                                                                        <td><?php echo $row->tanggal_penjualan?></td>
                                                                        <td><?php echo $row->kode_product?></td>
                                                                        <td><?php echo $row->harga?></td>
                                                                        <td><?php echo $row->qty?></td>
                                                                        <td><?php echo $row->sub_total?></td>
                                                                        <!-- <td>Rp.</td> -->
                                                                        <!-- <td><button type="button" class="btn btn-info"><i class="fa fa-print"></i></button></td> -->
                                                                    </tr>
                                                            <?php 
                                                            $no++;
                                                            } ?>
                                                        </tbody>
                                                    </table>
                                                     <?php 
                                                         //}
                                                        }
                                                    ?>
                                                </div>
                                                
                                            </div>

                                        </div>

                                        </form>
                                    </div><!--   penutup panel body -->
                                </div><!--   penutup panel -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by wrappixel.com </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->

     

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url() ?>assets/ample-admin-lite/html/js/custom.min.js"></script>
    <script src="<?php echo base_url("assets/DataTables/datatables.min.js")?>"></script>
    <script>

    function getObject()
    {
        var FromDateValue=document.getElementById("FromDate").value;
        document.getElementById("ToDate").value=FromDateValue;
    }

     $(document).ready(function(){

        function formatAngka(nStr){
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }

        $("#TableTransaksi").DataTable();

     })
    </script>
</body>

</html>
