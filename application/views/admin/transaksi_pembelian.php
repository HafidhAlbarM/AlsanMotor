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
    <title>Alsan Motor | Purchasing</title></title>
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
                        <h4 class="page-title">Purchasing Transaction <i class="fa fa-shopping-cart fa-fw text-danger"></i></h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <!-- <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro</a> -->
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('c_main/admin_index') ?>">Dashboard</a></li>
                            <li class="active">Purchasing Transaction</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <?php //echo print_r($this->session->all_userdata()); ?><br>
                                          Purchasing Header<br>
                                        </div>
                                        <div class="panel-body">
                                        <form method="POST" action="<?php echo base_url('C_transaksipembelian/save') ?>">
                                            <div class="form-horizonal">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-6">Purchasing Code</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="kode_pembelian" id="kode_pembelian" readonly="" value="<?php echo $this->session->kode_pembelian ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-6">Date</label>
                                                    <div class="col-sm-6">
                                                        <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?php echo $this->session->tanggal_pembelian ?>" readonly="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-6">Distributor Code</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control" name="kode_distributor" id="kode_distributor" value="<?php echo $this->session->kode_distributor ?>" readonly="">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-success btn-md" id="btn_tambah_distributor"><i class="glyphicon glyphicon-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-6">Distributor Name</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="nama_distributor" id="nama_distributor" value="<?php echo $this->session->nama_distributor ?>" readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Purchasing Detail</div>
                                        <div class="panel-body">
                                            <div class="form-horizonal">
                                                <table class="table" id="TabelTransaksi">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Product Code</th>
                                                            <th>Product Name</th>
                                                            <th>Price</th>
                                                            <th style="width: 65px">Qty</th>
                                                            <th>Sub Total</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                <table>
                                                    <tr>
                                                     <td style="width:40px;">
                                                     <button type='button' class='btn btn-info btn-xs' id='btn_tambah_product' title="Search Product"><i class='glyphicon glyphicon-search'></i></button>
                                                     </td>
                                                     <td>
                                                        <button type="button" id='BarisBaru' class='btn btn-primary pull-left btn-xs' title="add new product"><i class='fa fa-shopping-cart'></i></button>
                                                     </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Total</div>
                                        <div class="panel-body">
                                            <div class="col-sm-3">
                                                Total Product
                                                <h2 id="total_qty"></h2>
                                                <input type="hidden" name="total_qty_hidden" id="total_qty_hidden" value="">
                                            </div>
                                            <div class="col-sm-3">
                                                <span id="total_qty"></span>
                                            </div>
                                            <div class="col-sm-3">
                                                Total Amount
                                                <h2><span id="total"></span></h2>
                                                <input type="hidden" name="total_hidden" id="total_hidden" value="">
                                            </div>
                                            <div class="col-sm-3">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Option</div>
                                        <div class="panel-body">
                                            <div class="col-sm-4">
                                                <button class="btn btn-info" id="btn_save">Save Transaction</button>
                                            </div>
                                            <div class="col-sm-4">
                                                <button class="btn btn-danger">Cancel Transaction</button>
                                            </div>
                                            <div class="col-sm-4">
                                                <!-- <button class="btn btn-info">Transaksi Baru</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

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

        <!-- Modal -->
    <div id="Modal_Distributor" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Daftar Distributor</h4>
        </div>
        <div class="modal-body">
            <table class="table" id="table_distributor">
                <thead>
                    <tr>
                        <th>Distributor Code</th>
                        <th>Distributor Name</th>
                        <th>Phone No.</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data_distributor as $row) { ?>
                        <tr>
                        <td><span><?php echo $row->kode_distributor ?></span></td>
                        <td><span><?php echo $row->nama_distributor ?></span></td>
                        <td><?php echo $row->no_telepon ?></td>
                        <td><?php echo $row->alamat ?></td>
                        <td><button type="button" class="btn btn-primary btn_select_distributor">Select</button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>

    </div>
    </div>
    <!-- Akhir modal -->

    <!-- Modal -->
    <div id="Modal_Product" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Daftar Product</h4>
        </div>
        <div class="modal-body">
            <table class="table" id="table_product">
                <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data_product as $row) { 
                    ?>
                        <tr>
                        <td><span><?php echo $row->Kode_Product ?></span></td>
                        <td><span><?php echo $row->Nama_Product ?></span></td>
                        <td><?php echo $row->Kategori ?></td>
                        <td><?php echo $row->Merk ?></td>
                        <td><?php echo $row->Type ?></td>
                        <td style="text-align:right;"><input type="hidden" value="<?php echo $row->Harga_Beli ?>"><span><?php echo number_format($row->Harga_Beli,2) ?></span></td>
                        <td style="text-align:right;"><?php echo $row->Stock ?></td>
                        <td><button type="button" class="btn btn-primary btn_select_product">Select</button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>

    </div>
    </div>
    <!-- Akhir modal -->

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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>

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

        $.ajax({
            url:"<?php echo site_url('C_transaksipembelian/check_session'); ?>",
            type:"POST",
            dataType:"json",
            success:function(respon){
                swal(respon.pesan, "Tank You!", "success");
            },
            error:function(){

            }
        });

        for(B=1; B<=1; B++){
            BarisBaru();
        }   

        $("#btn_tambah_distributor").click(function(){
                $("#Modal_Distributor").modal("show");
        });

        $("#table_distributor").DataTable();

        $(".btn_select_distributor").click(function(){
            index=$(this).parent().parent().index();
            kode_distributor=$("#table_distributor tbody tr:eq("+index+") td:nth-child(1) span").text();
            nama_distributor=$("#table_distributor tbody tr:eq("+index+") td:nth-child(2) span").text();
            $("#kode_distributor").val(kode_distributor);
            $("#nama_distributor").val(nama_distributor);
            $("#Modal_Distributor").modal("hide");
        });

        $("#btn_tambah_product").click(function(){
            $("#Modal_Product").find(".modal-dialog").css({width:'800'});
            $("#Modal_Product").modal("show");
        });

        $("#table_product").DataTable();

        $(".btn_select_product").click(function(){
            index=$(this).parent().parent().index();
            // alert(index);
            kode_product=$("#table_product tbody tr:eq("+index+") td:nth-child(1) span").text();
            nama_product=$("#table_product tbody tr:eq("+index+") td:nth-child(2) span").text();
            harga_jual=$("#table_product tbody tr:eq("+index+") td:nth-child(6) input").val();

            var index2 = $('#TabelTransaksi tbody tr').length;
            index2=index2-1;
            // alert(index2);

            $("#TabelTransaksi tbody tr:eq("+index2+") td:nth-child(2) input").val(kode_product);
            $("#TabelTransaksi tbody tr:eq("+index2+") td:nth-child(2) span").html(kode_product);
            $("#TabelTransaksi tbody tr:eq("+index2+") td:nth-child(3) span").html(nama_product);
            $("#TabelTransaksi tbody tr:eq("+index2+") td:nth-child(4) input").val(harga_jual);
            $("#TabelTransaksi tbody tr:eq("+index2+") td:nth-child(4) span").html(formatAngka(harga_jual)+'.00');
            $("#TabelTransaksi tbody tr:eq("+index2+") td:nth-child(5) input").val(1);
            $("#TabelTransaksi tbody tr:eq("+index2+") td:nth-child(5) input").attr('disabled',false);
            $("#TabelTransaksi tbody tr:eq("+index2+") td:nth-child(6) input").val(harga_jual);
            $("#TabelTransaksi tbody tr:eq("+index2+") td:nth-child(6) span").html(formatAngka(harga_jual)+'.00');

            
            HitungTotalBayar()
            $("#Modal_Product").modal("hide");
        });

        $('#BarisBaru').click(function(){
            BarisBaru();
        });

        function BarisBaru(){
            var Nomor = $('#TabelTransaksi tbody tr').length + 1;
            var Baris = "<tr>";
                Baris += "<td>"+Nomor+"</td>";
                Baris += "<td>";
                    Baris += "<input type='hidden' name='kode_product[]'>";
                    Baris += "<span></span>";
                Baris += "</td>";
                Baris += "<td><span></span></td>";
                Baris += "<td>";
                    Baris += "<input type='hidden' name='harga[]'>";
                    Baris += "<span></span>";
                Baris += "</td>";
                Baris += "<td><input type='text' class='form-control' name='qty[]' id='qty'></td>";
                Baris += "<td>";
                    Baris += "<input type='hidden' name='sub_total[]'>";
                    Baris += "<span></span>";
                Baris += "</td>";
                Baris += "<td><button class='btn btn-danger' id='HapusBaris'><i class='fa fa-trash'></i></button></td>";
                Baris += "</tr>";

            $('#TabelTransaksi tbody').append(Baris);

            $('#TabelTransaksi tbody tr').each(function(){
                $(this).find('td:nth-child(2) input').focus();
            });

            HitungTotalBayar();
        }

        $(document).on('keyup','#qty',function(){
            var Indexnya = $(this).parent().parent().index();
            var Harga = $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) input').val();
            var JumlahBeli = $(this).val();
            var KodeBarang = $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2) input').val();

            // alert(Harga);
            // alert(JumlahBeli);
            var SubTotal = parseInt(Harga) * parseInt(JumlahBeli);
            // alert(SubTotal);

            if(SubTotal > 0){
                var SubTotalVal = SubTotal;
                SubTotal = formatAngka(SubTotal);
            } else {
                SubTotal = '';
                var SubTotalVal = 0;
            }

            $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) input').val(SubTotalVal);
            $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) span').html(SubTotal);
            HitungTotalBayar();
        });

        $(document).on('click', '#HapusBaris', function(e){
            e.preventDefault();
            $(this).parent().parent().remove();

            var Nomor = 1;
            $('#TabelTransaksi tbody tr').each(function(){
                $(this).find('td:nth-child(1)').html(Nomor);
                Nomor++;
            });

            HitungTotalBayar();
        });

        function HitungTotalBayar(){
            var Total = 0;
            var TotalQty=0;

            $('#TabelTransaksi tbody tr').each(function(){
                if($(this).find('td:nth-child(6) input').val() > 0)
                {
                    var SubTotal = $(this).find('td:nth-child(6) input').val();
                    Total = parseInt(Total) + parseInt(SubTotal);
                }
            });

            $('#TabelTransaksi tbody tr').each(function(){
                if($(this).find('td:nth-child(5) input').val() > 0)
                {
                    var Qty = $(this).find('td:nth-child(5) input').val();
                    TotalQty = parseInt(TotalQty) + parseInt(Qty);
                }
            });

            $('#total').html('Rp. '+formatAngka(Total)+'.00');
            $('#total_hidden').val(Total);

            $('#total_qty').html(formatAngka(TotalQty));
            $('#total_qty_hidden').val(TotalQty);
        }


        $("#btn_save").click(function(){
            kode_pembelian=$("#kode_pembelian").val();
            tanggal=$("#tanggal").val();
            kode_distributor=$("#kode_distributor").val();
            total=$("#total_hidden").val();
            total_qty=$("#total_qty_hidden").val();
            
            var FormData = "kode_pembelian="+$('#kode_pembelian').val();
            FormData += "&tanggal="+$('#tanggal').val();
            FormData += "&kode_karyawan="+$('#kode_karyawan').val();
            FormData += "&kode_distributor="+$('#kode_distributor').val();
            FormData += "&" + $('#TabelTransaksi tbody input').serialize();
            FormData += "&total_hidden="+$('#total_hidden').val();
            FormData += "&total_qty_hidden="+$('#total_qty_hidden').val();

            if( kode_distributor != '' ){
                $.ajax({
                    url: "<?php echo site_url('c_transaksipembelian/save'); ?>",
                    type: "POST",
                    //cache: false,
                    data: FormData,
                    dataType:'json',
                    success:function(data){
                        location.reload();
                    },
                    error:function(){

                    }
                });
            }else{
                alert('Please choose distributor');
            }
        });

        
     });
    </script>
</body>

</html>