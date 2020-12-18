<html>
<body>
    <h1>PEMBELIAN BERHASIL</h1>
    <p>Pembelian dengan nomor pemesanan <?= $kode_pemesanan ?> telah berhasil,</p>
    <p>Barang akan segera di antar ke alamat: <?= $alamat ?>. </p>
    Berikut adalah nomor pembelian Anda:</p>
    <p><?= $kode_penjualan ?></p>
    <p><i>simpan email konfirmasi ini sebagai bukti transaksi</i></p>
    <table style="width:100%" border="1">
        <tr>
            <td>Nama Barang</td>
            <td>Harga</td>
            <td>Qty</td>
            <td>Subtotal</td>
        </tr>
        <?php 
            foreach($data_detail_pemesanan as $row){
        ?>
        <tr>
            <td><?= $row->Nama_Product ?></td>
            <td><?= $row->harga ?></td>
            <td><?= $row->qty ?></td>
            <td><?= $row->sub_total ?></td>
        </tr>
        <?php 
            }
        ?>
        <tr>
            <td><?= $row->Nama_Product?></td>
        </tr>
    </table>
    <?php 
        foreach($data_detail_pemesanan as $row){

        }
    ?>
    <p><i>item yang sudah dibeli, tidak dapat dikembalikan</i></p>
    <br><br>
    <p><i>Terimakasi telah berbelanja di Alsan Motor</i></p>
</body>
</html>