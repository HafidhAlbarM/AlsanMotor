<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">x</button>
    <h4 class="modal-title text-center">Product Detail</h4>
</div>
<div class="modal-body">
     <form method="POST" id="form_transaksi" enctype="multipart/form-data">
     <div class="form-horizontal">
        <div class="form-group">
         <input type="hidden" id="kode_penjualan" name="kode_penjualan">
         <div class="col-sm-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Product</th>
                        <th>Harga</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data_detail_penjualan->result() as $row){ ?>
                        <tr>
                            <td><?= $row->Nama_Product ?></td>
                            <td><?= $row->harga ?></td>
                            <td><?= $row->qty ?></td>
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
            <!-- <input type="submit" name="action" id="btn_save" class="btn btn-success" value=""> -->
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>