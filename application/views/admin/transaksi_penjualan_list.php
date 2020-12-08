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
    <title>Alsan Motor | Product</title>
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
                        <h2 class="page-title"><i class="fa fa-archive" aria-hidden="true"></i></h2> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <!-- <a href="<?php echo base_url() ?>penjualan/https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro

                        </a> -->
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>c_main/admin_index">Dashboard</a></li>
                            <li class="active">Product</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Product Table</h3>
                            <!-- <p class="text-muted">Add class <code>.table</code></p> -->
                            <div class="table-responsive">
                                <table class="table" id="table_product">
                                    <thead>
                                        <tr>
                                            <th>Selling Code</th>
                                            <th>Date</th>
                                            <th>Employee</th>
                                            <th>Plate Number</th>
                                            <th>Car</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                </table>
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


        <!-- MODAL-->
    <div id="modal_product" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

      </div>
    </div>
  <!-- AKHIR MODAL -->


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
        $(document).ready(function(){
            var dataTable=$("#table_product").DataTable({
                "processing":true,
                "serverSide":true,
                "order":[],
                "aLengthMenu":[[5,15,15,-1],[5,10,15,"All"]],
                "iDisplayLength":5,
                "ajax":{
                    url:"<?php echo base_url('C_transaksipenjualan/ambil_data_penjualan') ?>",
                    method:"POST"
                },
                "columnDefs":[
                 {
                  // remove column order
                  "targets":[6], //8 itu kolom ke berapa yang gak boleh di order(diurutkan)
                  "orderable":false
                 }
                ]
        });

        $(document).on('submit','#form_transaksi',function(evt){
            evt.preventDefault();
            
            let kode_penjualan = $("#kode_penjualan").val();
            let status = $("#status").val();
            let url="<?php echo base_url('c_transaksipenjualan/update_status_penjualan/') ?>" + kode_penjualan + "/" + status;
            
            $.ajax({
                url:url,
                method:"POST",
                dataType:"json",
                // contentType:false,
                // processData:false,
                success:function(data){
                    // console.log(data);
                    // $("#form_transaksi")[0].reset();
                    $("#modal_product").modal("hide");
                    if (data.status=='simpan'){
                        alert('Data has been saved');
                    }else{
                        alert('Data has been updated');
                    }
                    dataTable.ajax.reload();
                }
            });          
        });

        $(document).on('click','.update',function(){
            let url = $(this).data('url');
            $(".modal-content").load(url);
            $("#modal_product").modal("show");
        });

        $(document).on('click','.delete',function(){
            Kode_Product=$(this).attr("id");
            if (confirm('Do You want to delete this data?')){
            $.ajax({
                url:"<?php echo base_url('c_product/delete/') ?>"+Kode_Product,
                method:"POST",
                dataType:"json",
                success:function(){
                    alert('Data has been deleted');
                    dataTable.ajax.reload();
                },
                error:function(){
                    // console.log();
                    // alert("gagal");
                }
            });
        }
        });

        });
    </script>
</body>

</html>
