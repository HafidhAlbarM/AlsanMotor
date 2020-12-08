<?php
 /**
 * 
 */
 class model_product extends CI_Model
 {
	public function __construct()
    {
        parent::__construct();
    }
 	var $table_product="product";
 	var $table_kategori="kategori";
 	
 	var $select_column=array("kode_product","nama_product","kategori","merk","type","harga_beli","harga_jual","stock");
 	var $order_column=array("kode_product","nama_product","kategori","merk","type","harga_beli","harga_jual","stock");

 	//datatable
 	function make_query(){
 		$this->db->select($this->select_column);
 		$this->db->from($this->table_product);
 		$this->db->join($this->table_kategori, 'product.kode_kategori = kategori.kode_kategori');
 		// $this->db->join($this->table_jenis, 'mobil.kode_jenis = jenis.kode_jenis');

 		if (isset($_POST["search"]["value"])) { //jika datatable send data buat searching
 			$this->db->like("kode_product",$_POST["search"]["value"]);
 			$this->db->or_like("nama_product",$_POST["search"]["value"]);
 			$this->db->or_like("kategori",$_POST["search"]["value"]);
 			$this->db->or_like("merk",$_POST["search"]["value"]);
 			$this->db->or_like("type",$_POST["search"]["value"]);
 			$this->db->or_like("harga_beli",$_POST["search"]["value"]);
 			$this->db->or_like("harga_jual",$_POST["search"]["value"]);
 			$this->db->or_like("stock",$_POST["search"]["value"]);
 		}

 		if (isset($_POST['order'])) { //jika datatable request data buat ordering
 			$this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
 		}else{
 			$this->db->order_by('kategori ASC, nama_product ASC');
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
 		$this->db->from($this->table_product);
 		return $this->db->count_all_results();
 	}
 	//akhir datatable

 	function max_code(){
 		$sql="SELECT max(product) as max_code FROM jumlah";
 		$hasil=$this->db->query($sql);
 		return $hasil->row();
 	}

 	function get_kategori(){
 		$sql="SELECT*FROM kategori";
 		$hasil=$this->db->query($sql);
 		return $hasil->result();
 	}
 	function update_kode_product(){
 		$sql="UPDATE jumlah SET product=product+1";
 		$hasil=$this->db->query($sql);
 		return $hasil;
 	}
 }
?>