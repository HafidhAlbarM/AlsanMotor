<?php
 /**
 * 
 */
 class model_karyawan extends CI_Model
 {
	public function __construct()
    {
        parent::__construct();
    }
 	var $table_karyawan="karyawan";
 	var $table_nama_divisi="divisi";
 	
	//  var $select_column=array("kode_karyawan","nama_karyawan","email","jenis_kelamin","alamat","no_telp","tanggal_masuk","nama_divisi","foto","userid");
	 var $select_column=array("kode_karyawan","nama_karyawan","email","foto");
	 //var $order_column=array("kode_karyawan","nama_karyawan","email","jenis_kelamin","alamat","no_telp","tanggal_masuk","nama_divisi","foto","userid");
	 var $order_column=array("kode_karyawan","nama_karyawan","email");

 	//datatable
 	function make_query(){
 		$this->db->select($this->select_column);
 		$this->db->from($this->table_karyawan);
 		$this->db->join($this->table_nama_divisi, 'karyawan.kode_divisi = divisi.kode_divisi');
 		// $this->db->join($this->table_jenis, 'mobil.kode_jenis = jenis.kode_jenis');

 		if (isset($_POST["search"]["value"])) { //jika datatable send data buat searching
 			$this->db->like("kode_karyawan",$_POST["search"]["value"]);
 			$this->db->or_like("nama_karyawan",$_POST["search"]["value"]);
			$this->db->or_like("email",$_POST["search"]["value"]); 
			$this->db->or_like("jenis_kelamin",$_POST["search"]["value"]);
 			$this->db->or_like("alamat",$_POST["search"]["value"]);
 			$this->db->or_like("no_telp",$_POST["search"]["value"]);
 			$this->db->or_like("tanggal_masuk",$_POST["search"]["value"]);
 			$this->db->or_like("nama_divisi",$_POST["search"]["value"]);
 			$this->db->or_like("userid",$_POST["search"]["value"]);
 		}

 		if (isset($_POST['order'])) { //jika datatable request data buat ordering
 			$this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
 		}else{
 			$this->db->order_by('nama_karyawan','ASC');
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
 		$this->db->from($this->table_karyawan);
 		return $this->db->count_all_results();
 	}
 	//akhir datatable

 	function max_code(){
 		$sql="SELECT max(karyawan) as max_code FROM jumlah";
 		$hasil=$this->db->query($sql);
 		return $hasil->row();
 	}
 	function update_kode_karyawan(){
 		$sql="UPDATE jumlah SET karyawan=karyawan+1";
 		$hasil=$this->db->query($sql);
 		return $hasil;
 	}

 	function get_divisi(){
 		$sql="SELECT*FROM divisi";
 		$hasil=$this->db->query($sql);
 		return $hasil->result();
	 }
	 
	 function get_data_profile($user_id){
		 $sql="SELECT 
		 a.kode_karyawan, a.nama_karyawan, a.email, a.jenis_kelamin, a.alamat, a.no_telp, a.tanggal_masuk, b.Nama_Divisi as divisi, a.foto, a.userid 
		 FROM karyawan a LEFT JOIN divisi b ON A.kode_divisi = B.Kode_Divisi WHERE a.userid='".$user_id."'";
		 $hasil=$this->db->query($sql);
		 return $hasil->row();
	 }

 	// function get_mobil($kode_mobil){
 	// 	$sql="SELECT mobil.kode_mobil, mobil.nomor_polisi, mobil.kode_karyawan, merk.merk, mobil.type, mobil.warna, mobil.tahun, mobil.kapasitas_mesin, mobil.transmisi, mobil.bahan_bakar, mobil.kode_jenis, jenis.jenis, mobil.tempat_duduk, mobil.tarif_per_hari, mobil.status, mobil.foto from mobil INNER JOIN jenis on mobil.kode_jenis=jenis.kode_jenis INNER JOIN merk ON mobil.kode_karyawan=merk.kode_karyawan WHERE kode_mobil='$kode_mobil'";
 	// 	$hasil=$this->db->query($sql);
 	// 	return $hasil->row();
 	// }
 }
?>