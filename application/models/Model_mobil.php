<?php
 /**
 * 
 */
 class model_mobil extends CI_Model
 {
	public function __construct()
    {
        parent::__construct();
    }
 	var $table_mobil="mobil";
 	// var $table_nama_divisi="divisi";
 	
 	var $select_column=array("plat_nomor","merk_mobil","nama_mobil","pemilik","jenis","jumlah_cuci");
 	var $order_column=array("plat_nomor","merk_mobil","nama_mobil","pemilik","jenis","jumlah_cuci");

 	//datatable
 	function make_query(){
 		$this->db->select($this->select_column);
 		$this->db->from($this->table_mobil);
 		// $this->db->join($this->table_nama_divisi, 'mobil.kode_divisi = divisi.kode_divisi');
 		// $this->db->join($this->table_jenis, 'mobil.kode_jenis = jenis.kode_jenis');

 		if (isset($_POST["search"]["value"])) { //jika datatable send data buat searching
			$this->db->like("plat_nomor",$_POST["search"]["value"]);
			$this->db->or_like("merk_mobil",$_POST["search"]["value"]);
 			$this->db->or_like("nama_mobil",$_POST["search"]["value"]);
 			$this->db->or_like("pemilik",$_POST["search"]["value"]);
			$this->db->or_like("jenis",$_POST["search"]["value"]);
			$this->db->or_like("jumlah_cuci",$_POST["search"]["value"]);
			 
 		}

 		if (isset($_POST['order'])) { //jika datatable request data buat ordering
 			$this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
 		}else{
 			$this->db->order_by('plat_nomor','ASC');
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
 		$this->db->from($this->table_mobil);
 		return $this->db->count_all_results();
	 }
	 
	function update_jumlah_cuci($plat_nomor){
		$sql="UPDATE mobil SET jumlah_cuci=jumlah_cuci+1 WHERE plat_nomor='".$plat_nomor."'";
		$hasil=$this->db->query($sql);
		return $hasil;
	}
 	//akhir datatable
 }
?>