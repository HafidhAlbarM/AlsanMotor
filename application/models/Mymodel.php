<?php
 defined('BASEPATH') OR exit('No direct script access allowed');//tidak pakai tidak apa apa
 
 //MODEL UNIVERSAL BISA DIPAKAI DI BER BAGAI APLIKASI
 class Mymodel extends CI_Model
 {

	public function __construct()
    {
        parent::__construct();
	}
	
 	
 	public function semuadata($tabel)
 	{
 		$mysql="SELECT*FROM ".$tabel;
 		$hasil=$this->db->query($mysql);
 		// $hasil=$this->db->get($tabel);
 		return $hasil->result();//karena menampilkan jadi harus ada hasil (foreach) mau di looping
 	}

 	public function insert($tabel,$data)
 	{
 		$hasil=$this->db->insert($tabel,$data);
 		return $hasil;
 	}

 	public function update($tabel,$data,$where)
 	{
 		$hasil=$this->db->update($tabel,$data,$where);
 		return $hasil;
 	}

 	public function delete($tabel,$data)
 	{
 		$hasil=$this->db->delete($tabel,$data);
 		return $hasil;
 	}

 	public function GetWhere($tabel,$data)
 	{
 		$hasil=$this->db->get_where($tabel,$data);
 		return $hasil->row();//row idak perlu menggunakan foreach krn hanya 1 baris data
 	}

 	public function jumlah_data($tabel)
 	{
 		$hasil=$this->db->get($tabel);
 		return $hasil->num_rows();
 	}

  	public function jumlah_record($tabel,$where)
 	{
 		$hasil=$this->db->get_where($tabel,$where);
 		return $hasil->num_rows();
 	}

 	public function data_pagination($tabel,$banyak,$dari)
 	{
 		$hasil=$this->db->get($tabel,$banyak,$dari);
 		return $hasil->result();
 	}
 	public function combo($tabel,$field1,$field2){
 		$mysql="SELECT ".$field1.",".$field2." FROM ".$tabel;
 		$hasil=$this->db->query($mysql);
 		return $hasil;
 	}
 }
?>