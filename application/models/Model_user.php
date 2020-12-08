<?php
 /**
 * 
 */
 class model_user extends CI_Model
 {
	public function __construct()
    {
        parent::__construct();
    }
 	var $table_user="userr";
 	
 	var $select_column=array("User_Id","Email","Password","Levell");
 	var $order_column=array("User_Id","Email","Password","Levell");

 	//datatable
 	function make_query(){
 		$this->db->select($this->select_column);
 		$this->db->from($this->table_user);
 		// $this->db->join($this->table_nama_divisi, 'karyawan.kode_divisi = divisi.kode_divisi');
 		// $this->db->join($this->table_jenis, 'mobil.kode_jenis = jenis.kode_jenis');

 		if (isset($_POST["search"]["value"])) { //jika datatable send data buat searching
			 $this->db->like("User_id",$_POST["search"]["value"]);
			 $this->db->like("Email",$_POST["search"]["value"]);
 			$this->db->or_like("Levell",$_POST["search"]["value"]);
 		}

 		if (isset($_POST['order'])) { //jika datatable request data buat ordering
 			$this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
 		}else{
 			$this->db->order_by('User_Id','ASC');
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
 		$this->db->from($this->table_user);
 		return $this->db->count_all_results();
 	}
 	//akhir datatable
 }
?>