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
    <title>Alsan Motor | Car</title>
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
                        <h3 class="page-title"><i class="fa fa-car fa-fw" aria-hidden="true"></i></h3> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <!-- <a href="<?php echo base_url() ?>penjualan/https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro

                        </a> -->
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>c_main/admin_index">Dashboard</a></li>
                            <li class="active">Car</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Car Table</h3>
                            <!-- <p class="text-muted">Add class <code>.table</code></p> -->
                            <div class="table-responsive">
                                <table class="table" id="table_mobil">
                                    <thead>
                                        <tr>
                                            <th>Plate Number</th>
                                            <th>Car Brand</th>
                                            <th>Car Name</th>
                                            <th>Owner</th>
                                            <th>Car Type</th>
                                            <th>Total Wash</th>
                                            <th><button class="btn btn-success"><i class="glyphicon glyphicon-plus" id="btn_tambah"></i></button></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- MODAL TAMBAH -->
  <!-- Modal -->
    <div id="modal_mobil" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">x</button>
            <h4 class="modal-title text-center">Add New Car</h4>
          </div>
          <div class="modal-body">
     <form method="POST" action="" id="form_mobil" enctype="multipart/form-data">
     <div class="form-horizontal">

        <div class="form-group">
         <label class="control-label col-sm-3">Plate Number</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" value="">
            <div id="pesan_error_plat_nomor" style="color:red"></div>
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Car Brand</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="merk_mobil" name="merk_mobil">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Car Name</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="nama_mobil" name="nama_mobil">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Owner</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="pemilik" name="pemilik">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Type</label>
         <div class="col-sm-9">
            <select name="jenis" id="jenis" class="form-control">
                <option value="">--Select Type--</option>
                <option value="Umum">General</option>
                <option value="Langganan">Subscriber</option>
            </select>
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Total Wash</label>
         <div class="col-sm-9">
            <input type="number" class="form-control" id="jumlah_cuci" name="jumlah_cuci">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">User Id</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="User_Id" name="User_Id">
            <div id="pesan_error_user_id" style="color:red"></div>
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">E - Mail</label>
         <div class="col-sm-9">
            <input type="email" class="form-control" id="Email" name="Email">
            <div id="pesan_error_email" style="color:red"></div>
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Password</label>
         <div class="col-sm-9">
            <input type="password" class="form-control" id="Password" name="Password">
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
        $(document).ready(function(){
            
            var dataTable=$("#table_mobil").DataTable({
                "processing":true,
                "serverSide":true,
                "order":[],
                "aLengthMenu":[[5,15,15,-1],[5,10,15,"All"]],
                "iDisplayLength":5,
                "ajax":{
                    url:"<?php echo base_url('c_mobil/ambil_data_mobil') ?>",
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

            $("#plat_nomor").keyup(function(){
                plat_nomor=$(this).val();
                $.ajax({
                    url:"<?php echo base_url('c_mobil/validasi_plat_nomor/') ?>"+plat_nomor,
                    method:"GET",
                    dataType:"json",
                    success:function(data){
                        if (data.data=='ada'){
                            $("#pesan_error_plat_nomor").html("Plate Number has already exist");
                        }else{
                            $("#pesan_error_plat_nomor").html("");
                        }
                    },
                    error:function(){

                    }
                });
            });

            $("#Email").keyup(function(){
                email=$(this).val();
                $.ajax({
                    url:"<?php echo base_url('c_mobil/validasi_email/') ?>",
                    method:"POST",
                    dataType:"json",
                    data:{email: email},
                    success:function(data){
                        if(data.data=='ada'){
                            $("#pesan_error_email").html('Email has already exists');
                        }else{
                            $("#pesan_error_email").html('');
                        }
                    },
                    error:function(){

                    }
                })
            });

            $("#User_Id").keyup(function(){
                userId=$(this).val();
                $.ajax({
                    url:"<?php echo base_url('c_mobil/validasi_user_id/') ?>",
                    method:"POST",
                    dataType:"json",
                    data:{User_Id: userId},
                    success:function(data){
                        if(data.data=='ada'){
                            $("#pesan_error_user_id").html('User Id has already exists');
                        }else{
                            $("#pesan_error_user_id").html('');
                        }
                    },
                    error:function(){

                    }
                })
            });

            $("#btn_tambah").click(function(){
                aksi='add';
                $("#form_mobil")[0].reset();
                $("#btn_save").val("Save");
                $("#plat_nomor").attr('readonly', false);
                $("#User_Id").attr('readonly', false);
                $("#Email").attr('readonly', false);
                $("#modal_mobil").modal("show");
            });

            $(document).on('submit','#form_mobil',function(evt){
                evt.preventDefault();

                if (aksi=='add'){
                    url="<?php echo base_url('c_mobil/save') ?>";
                }else{
                    url="<?php echo base_url('c_mobil/update') ?>";
                }

                pesan_error_plat_nomor=$("#pesan_error_plat_nomor").text();
                pesan_error_email=$("#pesan_error_email").text();
                pesan_error_user_id=$("#pesan_error_user_id").text();
                plat_nomor=$("#plat_nomor").val();

                if (plat_nomor != ""){
                    if(pesan_error_plat_nomor == ""){
                        if(pesan_error_email == ""){
                            if(pesan_error_user_id == ""){
                                $.ajax({
                                    url:url,
                                    method:"POST",
                                    dataType:"json",
                                    data:new FormData(this),
                                    contentType:false,
                                    processData:false,
                                    success:function(data){
                                        $("#form_mobil")[0].reset();
                                        $("#modal_mobil").modal("hide");
                                        if (data.status=='simpan'){
                                            alert('data has been saved');
                                        }else{
                                            alert('data has been updated');
                                        }
                                        dataTable.ajax.reload();
                                    }
                                });
                            }else{
                                alert("User Id has already exists");
                            }
                        }else{
                            alert("Email has already exists");
                        }
                    }else{
                        alert("Plate Number has already exists");   
                    }
                }else{
                    alert("Plate Number is required");
                }
            });

            $(document).on('click','.update',function(){
                aksi='update';
                plat_nomor=$(this).attr("id");
                $('#form_mobil')[0].reset();
                $(".modal-title").html('Edit Car Data');
                $("#btn_save").val("Update");
                $('#plat_nomor').val(plat_nomor);
                $("#plat_nomor").attr('readonly', true);
                $("#User_Id").attr('readonly', true);
                $("#Email").attr('readonly', true);
                $.ajax({
                    url:"<?php echo base_url('c_mobil/edit/') ?>" + plat_nomor,
                    method:"GET",
                    dataType:"json",
                    success:function(data){
                        $("#plat_nomor").val(data.plat_nomor);
                        $("#merk_mobil").val(data.merk_mobil);
                        $("#nama_mobil").val(data.nama_mobil);
                        $("#pemilik").val(data.pemilik);
                        $("#jenis").val(data.jenis);
                        $("#jumlah_cuci").val(data.jumlah_cuci);
                        $("#User_Id").val(data.User_Id);
                        $("#Email").val(data.email);

                        $("#modal_mobil").modal("show");
                        $('#btn_add').val('update');
                    },
                    error:function(){
                        // console.log();
                        // alert("gagal");
                    }
                });
            });

            $(document).on('click','.delete',function(){
                plat_nomor=$(this).attr("id");
                if (confirm('Do You want to delete this data?')){
                $.ajax({
                    url:"<?php echo base_url('c_mobil/delete/') ?>"+plat_nomor,
                    method:"POST",
                    dataType:"json",
                    success:function(){
                        alert('data has been deleted');
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
