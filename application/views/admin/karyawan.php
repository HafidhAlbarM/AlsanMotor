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
    <title>Alsan Motor | Employee</title>
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
                        <h3 class="page-title"><i class="fa fa-users fa-fw" aria-hidden="true"></i></h3> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <!-- <a href="<?php echo base_url() ?>penjualan/https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro

                        </a> -->
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>c_main/admin_index">Dashboard</a></li>
                            <li class="active">Employee</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Employee Table</h3>
                            <!-- <p class="text-muted">Add class <code>.table</code></p> -->
                            <div class="table-responsive">
                                <table class="table" id="table_karyawan">
                                    <thead>
                                        <tr>
                                            <th>Employee Code</th>
                                            <th>Employee Name</th>
                                            <th>Email</th>
                                            <!-- <th>Gender</th>
                                            <th>Address</th>
                                            <th>Phone Number</th>
                                            <th>Hire Date</th>
                                            <th>Division</th>
                                            <th>User Id</th> -->
                                            <th>Photo</th>
                                            <th><button class="btn btn-success"><i class="glyphicon glyphicon-plus" id="btn_tambah"></i></button></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Modal -->
    <div id="modal_karyawan" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">x</button>
            <h4 class="modal-title text-center">Add New Employee</h4>
          </div>
          <div class="modal-body">
     <form method="POST" id="form_karyawan" enctype="multipart/form-data">
     <div class="form-horizontal">

        <div class="form-group">
         <label class="control-label col-sm-3">Employee Code</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="kode_karyawan" name="kode_karyawan" readonly="" value="">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Employee Name</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">E - Mail</label>
         <div class="col-sm-9">
            <input type="email" class="form-control" id="email" name="email">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Gender</label>
         <div class="col-sm-9">
            <input type="radio" name="jenis_kelamin" id="jenis_kelamin_lk" value="Male">Male
            <input type="radio" name="jenis_kelamin" id="jenis_kelamin_pr" value="Female">Female
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Address</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="alamat" name="alamat">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Phone Number</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="no_telp" name="no_telp">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Hire Date</label>
         <div class="col-sm-9">
            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Division</label>
         <div class="col-sm-9">
            <select name="kode_divisi" id="kode_divisi" class="form-control">
                <option value="">-- Choose Division --</option>
                <?php
                 foreach ($divisi as $row) { ?>
                     <option value="<?php echo $row->Kode_Divisi ?>"><?php echo $row->Nama_Divisi ?></option>
                 <?php } ?>
            </select>
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Photo</label>
         <div class="col-sm-9">
            <input type="file" id="foto" name="foto" accept=".jpeg, .png, .jpg">
            <input type="hidden" id="foto_lama" name="foto_lama">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">User Id</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="userid" name="userid">
         </div>
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

            var dataTable=$("#table_karyawan").DataTable({
                "processing":true,
                "serverSide":true,
                "order":[],
                "aLengthMenu":[[5,15,15,-1],[5,10,15,"All"]],
                "iDisplayLength":5,
                "ajax":{
                    url:"<?php echo base_url('c_karyawan/ambil_data_karyawan') ?>",
                    method:"POST"
                },
                "columnDefs":[
                 {
                  // remove column order
                  "targets":[4], //8 itu kolom ke berapa yang gak boleh di order(diurutkan)
                  "orderable":false
                 }
                ]
            });

            function generate_kode_karyawan(){
                $.ajax({
                    url:"<?php echo base_url('c_karyawan/kode_karyawan') ?>",
                    method:"POST",
                    dataType:"json",
                    success:function(data){
                      $("#kode_karyawan").val(data.kode_karyawan);
                    }
                })
            }

            $("#btn_tambah").click(function(){
                aksi='add';
                $("#form_karyawan")[0].reset();
                $("#btn_save").val("Save");
                generate_kode_karyawan();
                $("#modal_karyawan").modal("show");
            });

            $(document).on('submit','#form_karyawan',function(evt){
                evt.preventDefault();

                if (aksi=='add'){
                    url="<?php echo base_url('c_karyawan/save') ?>";
                }else{
                    url="<?php echo base_url('c_karyawan/update') ?>";
                }

                nama_karyawan=$("#nama_karyawan").val();
                kode_divisi=$("#kode_divisi").val();

                if (nama_karyawan !=""){
                    if (kode_divisi !==""){
                            $.ajax({
                                url:url,
                                method:"POST",
                                dataType:"json",
                                data:new FormData(this),
                                contentType:false,
                                processData:false,
                                success:function(data){
                                    $("#form_karyawan")[0].reset();
                                    $("#modal_karyawan").modal("hide");
                                    if (data.status=='simpan'){
                                        alert('Data has been saved');
                                    }else{
                                        alert('Data has been updated');
                                    }
                                    dataTable.ajax.reload();
                                }
                            });   
                    }else{
                        alert("Please choose the division");
                    }
                }else{
                    alert("Employee Name is required");
                }
            });

            $(document).on('click','.update',function(){
                aksi='update';
                kode_karyawan=$(this).attr("id");
                $('#form_karyawan')[0].reset();
                $(".modal-title").html('Edit Employee Data');
                $("#btn_save").val("Update");
                $('#kode_karyawan').val(kode_karyawan);
                $.ajax({
                    url:"<?php echo base_url('c_karyawan/edit/') ?>" + kode_karyawan,
                    method:"GET",
                    dataType:"json",
                    success:function(data){
                        $("#kode_karyawan").val(data.kode_karyawan);
                        $("#nama_karyawan").val(data.nama_karyawan);
                        $("#email").val(data.email);
                        if (data.jenis_kelamin=="Male"){
                            $("#jenis_kelamin_lk").attr('checked','checked');
                        }else if(data.jenis_kelamin=="Female"){
                            $("#jenis_kelamin_pr").attr('checked','checked');
                        }
                        $("#alamat").val(data.alamat);
                        $("#no_telp").val(data.no_telp);
                        $("#tanggal_masuk").val(data.tanggal_masuk);
                        $("#kode_divisi").val(data.kode_divisi);
                        $("#foto_lama").val(data.foto);
                        $("#userid").val(data.userid);

                        $("#modal_karyawan").modal("show");
                        $('#btn_add').val('update');
                    },
                    error:function(){
                        // console.log();
                        // alert("gagal");
                    }
                });
            });

            $(document).on('click','.delete',function(){
                kode_karyawan=$(this).attr("id");
                if (confirm('Do You want to delete this data?')){
                $.ajax({
                    url:"<?php echo base_url('c_karyawan/delete/') ?>"+kode_karyawan,
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
