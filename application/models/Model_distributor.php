<?php
 /**
 * 
 */
 class model_distributor extends CI_Model
 {
	public function __construct()
    {
        parent::__construct();
    }
 	var $table_distributor="distributor";
 	// var $table_nama_divisi="divisi";
 	
 	var $select_column=array("kode_distributor","nama_distributor","no_telepon","alamat");
 	var $order_column=array("kode_distributor","nama_distributor","no_telepon","alamat");

 	//datatable
 	function make_query(){
 		$this->db->select($this->select_column);
 		$this->db->from($this->table_distributor);
 		// $this->db->join($this->table_nama_divisi, 'distributor.kode_divisi = divisi.kode_divisi');
 		// $this->db->join($this->table_jenis, 'mobil.kode_jenis = jenis.kode_jenis');

 		if (isset($_POST["search"]["value"])) { //jika datatable send data buat searching
 			$this->db->like("kode_distributor",$_POST["search"]["value"]);
 			$this->db->or_like("nama_distributor",$_POST["search"]["value"]);
 			$this->db->or_like("alamat",$_POST["search"]["value"]);
 			$this->db->or_like("no_telepon",$_POST["search"]["value"]);
 		}

 		if (isset($_POST['order'])) { //jika datatable request data buat ordering
 			$this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
 		}else{
 			$this->db->order_by('kode_distributor','ASC');
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
 		$this->db->from($this->table_distributor);
 		return $this->db->count_all_results();
 	}
 	//akhir datatable

 	function max_code(){
 		$sql="SELECT max(distributor) as max_code FROM jumlah";
 		$hasil=$this->db->query($sql);
 		return $hasil->row();
 	}
 	function update_kode_distributor(){
 		$sql="UPDATE jumlah SET distributor=distributor+1";
 		$hasil=$this->db->query($sql);
 		return $hasil;
 	}

 	// function list_mobil(){
 	// 	$sql="SELECT mobil.kode_mobil, mobil.nomor_polisi, merk.merk, mobil.type, mobil.warna, mobil.tahun, mobil.kapasitas_mesin, mobil.transmisi, mobil.bahan_bakar, jenis.jenis, mobil.tempat_duduk, mobil.tarif_per_hari, mobil.status, mobil.foto from mobil INNER JOIN jenis on mobil.kode_jenis=jenis.kode_jenis INNER JOIN merk ON mobil.kode_distributor=merk.kode_distributor order by merk asc";
 	// 	$hasil=$this->db->query($sql);
 	// 	return $hasil->result();
 	// }

 	// function get_mobil($kode_mobil){
 	// 	$sql="SELECT mobil.kode_mobil, mobil.nomor_polisi, mobil.kode_distributor, merk.merk, mobil.type, mobil.warna, mobil.tahun, mobil.kapasitas_mesin, mobil.transmisi, mobil.bahan_bakar, mobil.kode_jenis, jenis.jenis, mobil.tempat_duduk, mobil.tarif_per_hari, mobil.status, mobil.foto from mobil INNER JOIN jenis on mobil.kode_jenis=jenis.kode_jenis INNER JOIN merk ON mobil.kode_distributor=merk.kode_distributor WHERE kode_mobil='$kode_mobil'";
 	// 	$hasil=$this->db->query($sql);
 	// 	return $hasil->row();
 	// }
 }
?>