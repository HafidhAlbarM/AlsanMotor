<?php
 /**
 * 
 */
 class model_beban extends CI_Model
 {
	public function __construct()
    {
        parent::__construct();
    }
 	var $table_beban_h="beban_h";
 	var $table_beban_d="beban_d";
 	
 	var $select_column=array("beban_h.kode_transaksi_beban","bulan","kode_beban","biaya","total");
 	var $order_column=array("beban_h.kode_transaksi_beban","bulan","kode_beban","biaya","total");

 	//datatable
 	function make_query(){
 		$this->db->select($this->select_column);
 		$this->db->from($this->table_beban_h);
 		$this->db->join($this->table_beban_d, 'beban_h.kode_transaksi_beban = beban_d.kode_transaksi_beban');
 		// $this->db->join($this->table_jenis, 'beban.kode_jenis = jenis.kode_jenis');

 		if (isset($_POST["search"]["value"])) { //jika datatable send data buat searching
			$this->db->like("beban_h.kode_transaksi_beban",$_POST["search"]["value"]);
			$this->db->or_like("bulan",$_POST["search"]["value"]);
 			$this->db->or_like("total",$_POST["search"]["value"]);
 		}

 		if (isset($_POST['order'])) { //jika datatable request data buat ordering
 			$this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
 		}else{
 			$this->db->order_by('kode_transaksi_beban,kode_beban	','ASC');
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
 		$this->db->from($this->table_beban_h);
 		return $this->db->count_all_results();
     }
     
     function max_code(){
        $sql="SELECT max(beban) as max_code FROM jumlah";
        $hasil=$this->db->query($sql);
        return $hasil->row();
    }

    function update_kode_beban(){
        $sql="UPDATE jumlah SET beban=beban+1";
        $hasil=$this->db->query($sql);
        return $hasil;
    }
	 
 	//akhir datatable
 }
?>