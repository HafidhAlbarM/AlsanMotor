<?php
 /**
 * 
 */
 class model_login extends CI_Model
 {
    public function __construct()
    {
        parent::__construct();
    }
 	function validasi_data_login($User_Id, $Password){
         $sql="SELECT a.User_Id, a.Levell, b.nama_karyawan, b.kode_karyawan, b.foto FROM userr a
         LEFT JOIN karyawan b ON a.User_Id=b.userid
         WHERE User_Id='".$User_Id."' AND Password='".$Password."'";
         $hasil=$this->db->query($sql);
         return $hasil;
     }
 }
?>