<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">x</button>
    <h4 class="modal-title text-center">Product Detail <?= $data_header_pemesanan->kode_pemesanan ?></h4>
</div>
<div class="modal-body">
     <form method="POST" id="form_transaksi" enctype="multipart/form-data">
     <div class="form-horizontal">
        <div class="form-group">
         <input type="hidden" id="kode_pemesanan" name="kode_pemesanan" value="<?= $data_header_pemesanan->kode_pemesanan ?>">
         <input type="hidden" id="status" name="status" value="<?= $data_header_pemesanan->status ?>">
         <div class="col-sm-12">
            <table class="table" id="table_detail_transaksi_pemesanan">
                <thead>
                    <tr>
                        <th>Nama Product</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Status Product</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data_detail_pemesanan->result() as $row){ 
                        $data_product = $this->mymodel->GetWhere('product', array('Kode_Product'=>$row->kode_product));
                    ?>
                        <tr>
                            <td><?= $row->Nama_Product ?></td>
                            <td><?= $row->harga ?></td>
                            <td><?= $row->qty ?></td>
                            <td><?= ($data_product->Stock > $row->qty) ? ' <span class="text-success" id="status_product">Tersedia</span>' : ' <span class="text-danger" id="status_product">Stock Kurang</span>' ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
         </div>
        </div>
        <div id="list-detail">

        </div>
</div>
        <div class="modal-footer">
            <input type="submit" name="action" id="btn_save" class="btn btn-success" value="Buat Transaksi Penjualan">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    var status_products = [];

    $('#table_detail_transaksi_pemesanan tr').each(function() {
        var status_product = $(this).find("#status_product").html();    
        status_products.push(status_product);
    });

    status_products.shift();

    if(status_products.includes("Stock Kurang") || $("#status").val()=='LUNAS'){
        $(':input[type="submit"]').prop('disabled', true);
        $(':input[type="submit"]').val('Transaction has been paid off');
    }else{
        $(':input[type="submit"]').prop('disabled', false);
        $(':input[type="submit"]').val('Make as selling transaction');
    }
    
    $(document).on('submit','#form_transaksi',function(evt){
        evt.preventDefault();
        
        let kode_pemesanan = $("#kode_pemesanan").val();
        let url="<?php echo base_url('C_transaksipemesanan/save_data_penjualan/') ?>";
        
        $.ajax({
            url:url,
            method:"POST",
            dataType:"json",
            data:{kode_pemesanan: kode_pemesanan},
            // contentType:false,
            // processData:false,
            success:function(data){
                $("#modal_product").modal("hide");
                // if (data.status=='simpan'){
                //     alert('Data has been saved');
                // }else{
                //     alert('Data has been updated');
                // }
                location.reload();
            }
        });          
    });
    
</script>