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
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Type</th>
                                            <th>Purchasing Price</th>
                                            <th>Selling Price</th>
                                            <th>Stock</th>
                                            <th><button class="btn btn-success"><i class="glyphicon glyphicon-plus" id="btn_tambah"></i></button></th>
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
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">x</button>
            <h4 class="modal-title text-center">Add New Product</h4>
          </div>
          <div class="modal-body">
     <form method="POST" id="form_product" enctype="multipart/form-data">
     <div class="form-horizontal">

        <div class="form-group">
         <label class="control-label col-sm-3">Product Code</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="Kode_Product" name="Kode_Product" readonly="" value="">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Product Name</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="Nama_Product" name="Nama_Product">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Category</label>
         <div class="col-sm-9">
            <select id="Kode_Kategori" name="Kode_Kategori" class="form-control">
                <option value="">-- Choose Category --</option>
                <?php
                 foreach ($kategori as $row) { ?>
                     <option value="<?php echo $row->Kode_Kategori ?>"><?php echo $row->Kategori ?></option>
                <?php } ?>
            </select>
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Brand</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="Merk" name="Merk">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Type</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="Type" name="Type">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Purchasing Price</label>
         <div class="col-sm-9">
            <input type="number" class="form-control" id="Harga_Beli" name="Harga_Beli">
         </div>
        </div>

        <div class="form-group">
         <label class="control-label col-sm-3">Selling Price</label>
         <div class="col-sm-9">
            <input type="number" class="form-control" id="Harga_Jual" name="Harga_Jual">
         </div>
        </div>

        
        <div class="form-group">
         <label class="control-label col-sm-3">Stock</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="Stock" name="Stock" disabled>
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
                    url:"<?php echo base_url('c_product/ambil_data_product') ?>",
                    method:"POST"
                },
                "columnDefs":[
                 {
                  // remove column order
                  "targets":[8], //8 itu kolom ke berapa yang gak boleh di order(diurutkan)
                  "orderable":false
                 }
                ]
            });

            function generate_kode_product(kode_kategori){
                $.ajax({
                    url:"<?php echo base_url('c_product/kode_product/') ?>"+kode_kategori,
                    method:"POST",
                    dataType:"json",
                    success:function(data){
                      $("#Kode_Product").val(data.kode_product);
                    }
                })
            }

            $("#btn_tambah").click(function(){
                aksi='add';
                $("#form_product")[0].reset();
                $("#btn_save").val("Save");
                $("#modal_product").modal("show");
            })

            $("#Kode_Kategori").on("change",function(){
                kode_kategori=$(this).val();
                if (aksi=='add'){
                    generate_kode_product(kode_kategori);
                }
            })

            $(document).on('submit','#form_product',function(evt){
                evt.preventDefault();

                if (aksi=='add'){
                    url="<?php echo base_url('c_product/simpan') ?>";
                }else{
                    url="<?php echo base_url('c_product/update') ?>";
                }

                kode_product=$("#Kode_Product").val();
                nama_product=$("#Nama_Product").val();
                kode_kategori=$("#Kode_Kategori").val();
                merk=$("#Merk").val();
                type=$("#Type").val();
                harga_beli=$("#Harga_Beli").val();
                harga_jual=$("#Harga_Jual").val();
                stock=$("#Stock").val();

                // alert(kode_product);
                // alert(nama_product);
                // alert(kode_kategori);
                // alert(merk);
                // alert(type);
                // alert(harga_beli);
                // alert(harga_jual);
                // alert(stock);

                if (kode_kategori !=""){
                    if (nama_product!=""){
                            $.ajax({
                                url:url,
                                method:"POST",
                                dataType:"json",
                                data:"Kode_Product="+kode_product+"&Nama_Product="+nama_product+"&Kode_Kategori="+kode_kategori+"&Merk="+merk+"&Type="+type+"&Harga_Beli="+harga_beli+"&Harga_Jual="+harga_jual+"&Stock="+stock,
                                // contentType:false,
                                // processData:false,
                                success:function(data){
                                    // console.log(data);
                                    $("#form_product")[0].reset();
                                    $("#modal_product").modal("hide");
                                    if (data.status=='simpan'){
                                        alert('Data has been saved');
                                    }else{
                                        alert('Data has been updated');
                                    }
                                    dataTable.ajax.reload();
                                }
                            });   
                    }else{
                        alert("Product Name is required");
                    }
                }else{
                    alert("Please choose the Category");
                }
        });

        $(document).on('click','.update',function(){
            aksi='update';
            Kode_Product=$(this).attr("id");
            $('#form_product')[0].reset();
            $(".modal-title").html('Edit Product Data');
            $("#btn_save").val("Update");
            $('#Kode_Product').val(Kode_Product);
            $.ajax({
                url:"<?php echo base_url('c_product/edit/') ?>" + Kode_Product,
                method:"GET",
                dataType:"json",
                success:function(data){
                    $("#Kode_Product").val(data.Kode_Product);
                    $("#Nama_Product").val(data.Nama_Product);
                    $("#Kode_Kategori").val(data.Kode_Kategori);
                    $("#Merk").val(data.Merk);
                    $("#Type").val(data.Type);
                    $("#Harga_Beli").val(data.Harga_Beli);
                    $("#Harga_Jual").val(data.Harga_Jual);
                    stock=data.Stock;
                    if(stock<0){
                        stock='-';
                    }else{
                        stock=data.Stock;
                    }
                    $("#Stock").val(stock);

                    $("#modal_product").modal("show");
                    $('#btn_add').val('update');
                },
                error:function(){
                    // console.log();
                    // alert("gagal");
                }
            });
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
