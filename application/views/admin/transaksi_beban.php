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
    <title>Alsan Motor | Expense</title>
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
                        <h4 class="page-title">Expense</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <!-- <a href="<?php echo base_url() ?>penjualan/https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro

                        </a> -->
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>c_main/admin_index">Dashboard</a></li>
                            <li class="active">Expense</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Expense Table</h3>
                            <!-- <p class="text-muted">Add class <code>.table</code></p> -->
                            <div class="table-responsive">
                                <table class="table" id="table_beban">
                                    <thead>
                                        <tr>
                                            <th>Expense Transaction Code</th>
                                            <th>Month</th>
                                            <th>Expense</th>
                                            <th>Amount</th>
                                            <th>Total</th>
                                            <th><button class="btn btn-success"><i class="glyphicon glyphicon-plus" id="btn_tambah"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- MODAL TAMBAH -->
  <!-- Modal -->
    <div id="modal_beban" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">x</button>
            <h4 class="modal-title text-center">Add New Expense Transaction</h4>
          </div>
          <div class="modal-body">
     <form method="POST" action="" id="form_beban" enctype="multipart/form-data">
     <div class="form-horizontal">

        <div class="form-group">
         <label class="control-label col-sm-3">Expense Transaction Code</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="kode_transaksi_beban" name="kode_transaksi_beban" value="" readonly>
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Month</label>
         <div class="col-sm-9">
            <input type="date" class="form-control" id="bulan" name="bulan">
         </div>
        </div>

        <?php
         foreach ($data_beban as $row) { ?>
             <div class="form-group">
                <label class="control-label col-sm-3"><?php echo $row->nama_beban?></label>
                <div class="col-sm-9">
                    <input type="hidden" class="form-control" id="<?php echo $row->kode_beban ?>" name="<?php echo $row->kode_beban ?>" value="<?php echo $row->kode_beban ?>">
                    <input type="number" class="form-control" id="<?php echo $row->kode_beban ?>_jml" name="<?php echo $row->kode_beban?>_jml" value="0">
                </div>
             </div>
        <?php } ?>

        <div class="form-group">
         <label class="control-label col-sm-3">Total</label>
         <div class="col-sm-9">
            <input type="hidden" class="form-control" id="total" name="total">
            <span id="total_span"></span>
         </div>
        </div>

     
          </div>
          <div class="modal-footer">
            <input type="submit" name="action" id="btn_save" class="btn btn-success" value="">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  <!-- AKHIR MODAL TAMBAH -->

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

        $(document).ready(function(){
            
            var dataTable=$("#table_beban").DataTable({
                "processing":true,
                "serverSide":true,
                "order":[],
                "aLengthMenu":[[5,15,15,-1],[5,10,15,"All"]],
                "iDisplayLength":5,
                "ajax":{
                    url:"<?php echo base_url('c_beban/ambil_data_beban') ?>",
                    method:"POST"
                },
                "columnDefs":[
                 {
                  // remove column order
                  "targets":[5], //8 itu kolom ke berapa yang gak boleh di order(diurutkan)
                  "orderable":false
                 }
                ]
            });

            function generate_kode_transaksi_beban(){
                $.ajax({
                    url:"<?php echo base_url('c_beban/kode_transaksi_beban') ?>",
                    method:"POST",
                    dataType:"json",
                    success:function(data){
                      $("#kode_transaksi_beban").val(data.kode_transaksi_beban);
                    }
                });
            }

            $("#btn_tambah").click(function(){
                aksi='add';
                $("#form_beban")[0].reset();
                $("#btn_save").val("Save");
                generate_kode_transaksi_beban();
                $("#modal_beban").modal("show");
            });

            function hitung_total(){
                listrik=$("#BB001_jml").val();
                air=$("#BB002_jml").val();
                gaji_karyawan=$("#BB003_jml").val();
                belanja_kebutuhan_jasa=$("#BB004_jml").val();
                lain_lain=$("#BB005_jml").val();
                // alert(listrik);
                // alert(air);
                // alert(gaji_karyawan);
                // alert(belanja_kebutuhan_jasa);
                // alert(lain_lain);
                total=0;
                total=parseInt(listrik)+parseInt(air)+parseInt(gaji_karyawan)+parseInt(belanja_kebutuhan_jasa)+parseInt(lain_lain);
                // alert(total);
                $("#total").val(total);
                $("#total_span").html(formatAngka(total));
            }

            $("#BB001_jml").on('keyup',function(){
                hitung_total();
            });

            $("#BB002_jml").on('keyup',function(){
                hitung_total();
            });

            $("#BB003_jml").on('keyup',function(){
                hitung_total();
            });

            $("#BB004_jml").on('keyup',function(){
                hitung_total();
            });

            $("#BB005_jml").on('keyup',function(){
                hitung_total();
            });
            
            $(document).on('submit','#form_beban',function(evt){
                evt.preventDefault();

                if (aksi=='add'){
                    url="<?php echo base_url('c_beban/save') ?>";
                }else{
                    url="<?php echo base_url('c_beban/update') ?>";
                }

                total=$("#total").val();

                if (total !=""){
                            $.ajax({
                                url:url,
                                method:"POST",
                                dataType:"json",
                                data:new FormData(this),
                                contentType:false,
                                processData:false,
                                success:function(data){
                                    $("#form_beban")[0].reset();
                                    $("#modal_beban").modal("hide");
                                    if (data.status=='simpan'){
                                        alert('data has been saved');
                                    }else{
                                        alert('data has been updated');
                                    }
                                    dataTable.ajax.reload();
                                }
                            });
                }else{
                    alert("Please fill all Expenses");
                }
            });

            // $(document).on('click','.update',function(){
            //     aksi='update';
            //     kode_transaksi_beban=$(this).attr("id");
            //     $('#form_beban')[0].reset();
            //     $(".modal-title").html('View Data');
            //     $("#btn_save").val("Update");
            //     $('#kode_transaksi_beban').val(kode_transaksi_beban);
            //     $.ajax({
            //         url:"<?php echo base_url('c_beban/view/') ?>" + kode_transaksi_beban,
            //         method:"GET",
            //         dataType:"json",
            //         success:function(data){
                        
                        

            //             $("#modal_beban").modal("show");
            //             $('#btn_add').val('update');
            //         },
            //         error:function(){
            //             // console.log();
            //             // alert("gagal");
            //         }
            //     });
            // });

            // $(document).on('click','.delete',function(){
            //     kode_transaksi_beban=$(this).attr("id");
            //     if (confirm('Do You want to delete this data?')){
            //     $.ajax({
            //         url:"<?php echo base_url('c_beban/delete/') ?>"+kode_transaksi_beban,
            //         method:"POST",
            //         dataType:"json",
            //         success:function(){
            //             alert('data has been deleted');
            //             dataTable.ajax.reload();
            //         },
            //         error:function(){
            //             // console.log();
            //             // alert("gagal");
            //         }
            //     });
            // }
            // });

        });
    </script>
</body>

</html>
