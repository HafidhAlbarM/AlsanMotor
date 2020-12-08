<?php
 class model_transaksi extends CI_Model
 {
    public function __construct()
    {
        parent::__construct();
    }
    
    function max_code($kolom){
        $sql="SELECT ".$kolom." AS max_code FROM jumlah";
        $hasil=$this->db->query($sql);
        return $hasil->row();
    }

    function get_list_product_penjualan(){
        $sql="SELECT
        product.Kode_Product,
        product.Nama_Product,
        kategori.Kategori,
        product.Merk,
        product.Type,
        product.Harga_Jual,
        CASE
        WHEN kategori.Kategori='Service' THEN
        ''
        ELSE
        product.Stock
        END AS Stock
        FROM product INNER JOIN kategori ON product.Kode_Kategori=kategori.Kode_Kategori";
        $hasil=$this->db->query($sql);
        return $hasil->result();
    }

    function get_list_product_pembelian(){
        $sql="SELECT product.Kode_Product, product.Nama_Product, kategori.Kategori, product.Merk, product.Type, product.Harga_Beli, product.Stock FROM product INNER JOIN kategori ON product.Kode_Kategori=kategori.Kode_Kategori WHERE product.Kode_Kategori <> 'JSA'";
        $hasil=$this->db->query($sql);
        return $hasil->result();
    }

    

    // ========================================================PEMBELIAN

    function insert_detail_pembelian($kode_pembelian, $kode_product, $harga, $qty, $sub_total)
	{
		$dt = array(
			'kode_pembelian' => $kode_pembelian,
			'kode_product	' => $kode_product,
			'harga' => $harga,
			'qty' => $qty,
			'sub_total' => $sub_total
		);

		return $this->db->insert('pembelian_d', $dt);
    }

    function update_id_transaksi_pembelian(){
        $sql="UPDATE jumlah SET pembelian=pembelian+1";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    function generate_report_pembelian($FromDate,$ToDate){
        $sql="SELECT*FROM pembelian_h WHERE tanggal_pembelian BETWEEN '$FromDate' AND '$ToDate'";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    function generate_report_pembelian_detail($FromDate,$ToDate){
        $sql="SELECT a.kode_pembelian, b.tanggal_pembelian, a.kode_product, a.harga, a.qty, a.sub_total FROM pembelian_d a
        LEFT JOIN pembelian_h b ON a.kode_pembelian = b.kode_pembelian
        WHERE tanggal_pembelian BETWEEN '$FromDate' AND '$ToDate'";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    // ==================================================PENJUALAN

    function insert_detail_penjualan($kode_penjualan, $kode_product, $harga, $qty, $sub_total)
	{
		$dt = array(
			'kode_penjualan' => $kode_penjualan,
			'kode_product	' => $kode_product,
			'harga' => $harga,
			'qty' => $qty,
			'sub_total' => $sub_total
		);

		return $this->db->insert('penjualan_d', $dt);
    }

    function update_id_transaksi_penjualan(){
        $sql="UPDATE jumlah SET penjualan=penjualan+1";
        $hasil=$this->db->query($sql);
        return $hasil;
    }
    
    function data_penjualan_all(){
 	    $hasil=$this->db->get('penjualan_h');
 		return $hasil;
    }

    function generate_report_penjualan($FromDate,$ToDate){
        $sql="SELECT*FROM penjualan_h WHERE tanggal_penjualan BETWEEN '$FromDate' AND '$ToDate'";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    function generate_report_penjualan_detail($FromDate,$ToDate){
        $sql="SELECT a.kode_penjualan, b.tanggal_penjualan, a.kode_product, a.harga, a.qty, a.sub_total FROM penjualan_d a
        LEFT JOIN penjualan_h b ON a.kode_penjualan = b.kode_penjualan
        WHERE tanggal_penjualan BETWEEN '$FromDate' AND '$ToDate'";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    function get_kwitansi_header(){
        $sql="SELECT kode_penjualan, tanggal_penjualan, kode_pemesanan, B.nama_karyawan, A.plat_nomor,
        CONCAT(C.merk_mobil,' ',C.nama_mobil) as mobil, total_qty, total 
        FROM penjualan_h A LEFT JOIN karyawan B ON A.kode_karyawan=B.kode_karyawan
        LEFT JOIN mobil C ON A.plat_nomor=C.plat_nomor 
        ORDER BY tanggal_penjualan DESC LIMIT 1";
        $hasil=$this->db->query($sql);
        return $hasil->row();
    }

    function get_kwitansi_detail($kode_penjualan){
        $sql="SELECT A.kode_penjualan, B.status, A.kode_product, C.Nama_Product, harga, qty, sub_total
        FROM penjualan_d A
        LEFT JOIN penjualan_h B ON A.kode_penjualan=B.kode_penjualan
        LEFT JOIN product C ON A.kode_product=C.kode_product
        WHERE A.kode_penjualan='".$kode_penjualan."'
        ORDER BY tanggal_penjualan DESC"
        ;
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    var $table_penjualan_h="penjualan_h";
    var $table_karyawan="karyawan";
    var $table_mobil="mobil"; 
 	
 	var $select_column=array("kode_penjualan","tanggal_penjualan","nama_karyawan","penjualan_h.plat_nomor","nama_mobil","total","status");
 	var $order_column=array("kode_penjualan","tanggal_penjualan","nama_karyawan","penjualan_h.plat_nomor","nama_mobil","total","status");

 	//datatable
 	function make_query(){
 		$this->db->select($this->select_column);
 		$this->db->from($this->table_penjualan_h);
 		$this->db->join($this->table_karyawan, 'penjualan_h.kode_karyawan = karyawan.kode_karyawan');
 		$this->db->join($this->table_mobil, 'penjualan_h.plat_nomor = mobil.plat_nomor');

 		if (isset($_POST["search"]["value"])) { //jika datatable send data buat searching
            $this->db->like("kode_penjualan",$_POST["search"]["value"]);
            $this->db->or_like("tanggal_penjualan",$_POST["search"]["value"]);
 			$this->db->or_like("nama_karyawan",$_POST["search"]["value"]);
 			$this->db->or_like("penjualan_h.plat_nomor",$_POST["search"]["value"]);
 			$this->db->or_like("nama_mobil",$_POST["search"]["value"]);
 		}

 		if (isset($_POST['order'])) { //jika datatable request data buat ordering
 			$this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
 		}else{
 			$this->db->order_by('tanggal_penjualan DESC');
 		}
 	}


 	function make_datatables(){
 		$this->make_query();
 		if ($_POST['length'] != -1) {
 			$this->db->limit($_POST['length'], $_POST['start']);
 		}

 		$query=$this->db->get();
 		return $query->result();
 	}

 	function get_filtered_data(){
 		$this->make_query();
 		$query=$this->db->get();
 		return $query->num_rows();
 	}


 	function get_all_data(){
 		$this->db->select("*");
 		$this->db->from($this->table_penjualan_h);
 		return $this->db->count_all_results();
 	}
 	//akhir datatable

    // =============================================================================Dashboard

    function jumlah_total_penjualan($tanggal){
        $sql="SELECT tanggal_penjualan, SUM(IFNULL(total,0)) as total_penjualan
        FROM penjualan_h
        GROUP BY tanggal_penjualan
        HAVING MONTH(tanggal_penjualan)=MONTH('".$tanggal."')";
        $hasil=$this->db->query($sql);
        return $hasil->row();
    }

    function jumlah_total_product($tanggal){
        $sql="SELECT tanggal_penjualan, SUM(IFNULL(total_qty,0)) as total_product
        FROM penjualan_h
        GROUP BY tanggal_penjualan
        HAVING MONTH(tanggal_penjualan)=MONTH('".$tanggal."')";
        $hasil=$this->db->query($sql);
        return $hasil->row();
    }

    function data_penjualan(){
        $sql="SELECT * FROM penjualan_h ORDER BY tanggal_penjualan DESC LIMIT 5";
        $hasil=$this->db->query($sql);
        return $hasil->result();
    }

    function update_status_penjualan($kode_penjualan, $status){
        $sql="UPDATE penjualan_h SET status='".$status."' WHERE kode_penjualan='".$kode_penjualan."'";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

    //  ================================================================================ PEMESANAN
    var $table_pemesanan_h="pemesanan_h";

    var $select_column_pemesanan=array("kode_pemesanan","tanggal_pemesanan","nama_karyawan","pemesanan_h.plat_nomor","nama_mobil","total","status");
    var $order_column_pemesanan=array("kode_pemesanan","tanggal_pemesanan","nama_karyawan","pemesanan_h.plat_nomor","nama_mobil","total","status");
    //datatable
    function make_query_pemesanan(){
        $this->db->select($this->select_column_pemesanan);
        $this->db->from($this->table_pemesanan_h);
        $this->db->join($this->table_karyawan, 'pemesanan_h.kode_karyawan = karyawan.kode_karyawan', 'left');
        $this->db->join($this->table_mobil, 'pemesanan_h.plat_nomor = mobil.plat_nomor', 'left');

        if (isset($_POST["search"]["value"])) { //jika datatable send data buat searching
        $this->db->like("kode_pemesanan",$_POST["search"]["value"]);
        $this->db->or_like("tanggal_pemesanan",$_POST["search"]["value"]);
            $this->db->or_like("nama_karyawan",$_POST["search"]["value"]);
            $this->db->or_like("pemesanan_h.plat_nomor",$_POST["search"]["value"]);
            $this->db->or_like("nama_mobil",$_POST["search"]["value"]);
        }

        if (isset($_POST['order'])) { //jika datatable request data buat ordering
            $this->db->order_by($this->order_column_pemesanan[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('tanggal_pemesanan DESC');
        }
    }


    function make_datatables_pemesanan(){
        $this->make_query_pemesanan();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query=$this->db->get();
        return $query->result();
    }

    function get_filtered_data_pemesanan(){
        $this->make_query();
        $query=$this->db->get();
        return $query->num_rows();
    }


    function get_all_data_pemesanan(){
        $this->db->select("*");
        $this->db->from($this->table_pemesanan_h);
        return $this->db->count_all_results();
    }
    //akhir datatable

    function data_pemesan($plat_nomor){
        $sql="SELECT*FROM mobil a LEFT JOIN userr b ON a.User_Id=b.User_Id WHERE plat_nomor='".$plat_nomor."'";
        $hasil=$this->db->query($sql);
        return $hasil->row();
    }

    function get_kwitansi_pemesanan_header($kode_pemesanan){
        $sql="SELECT kode_pemesanan, tanggal_pemesanan, A.plat_nomor,
        CONCAT(C.merk_mobil,' ',C.nama_mobil) as mobil, total_qty, total, status, sumber
        FROM pemesanan_h A LEFT JOIN karyawan B ON A.kode_karyawan=B.kode_karyawan
        LEFT JOIN mobil C ON A.plat_nomor=C.plat_nomor 
        WHERE kode_pemesanan='".$kode_pemesanan."'";
        $hasil=$this->db->query($sql);
        return $hasil->row();
    }

    function get_kwitansi_pemesanan_detail($kode_pemesanan){
        $sql="SELECT A.kode_pemesanan, B.status, A.kode_product, C.Nama_Product, harga, qty, sub_total
        FROM pemesanan_d A
        LEFT JOIN pemesanan_h B ON A.kode_pemesanan=B.kode_pemesanan
        LEFT JOIN product C ON A.kode_product=C.kode_product
        WHERE A.kode_pemesanan='".$kode_pemesanan."'
        ORDER BY tanggal_pemesanan DESC"
        ;
        $hasil=$this->db->query($sql);
        return $hasil;
    }
 }


?>