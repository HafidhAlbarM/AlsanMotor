<?php
 /**
 * 
 */
 class C_login extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
		 $this->load->model('model_login');
		 $this->load->model('model_transaksi');
		$this->load->library('session');
     }
     
 	function login(){
		$User_Id = $this->input->post('User_Id');
		$Password = md5($this->input->post('Password'));
		
		//validasi login ada
		$jumlah_data = $this->model_login->validasi_data_login($User_Id, $Password)->num_rows();
		
		if( $jumlah_data > 0 ){
			$ambil_data_login = $this->model_login->validasi_data_login($User_Id, $Password)->row();
			$user_id = $ambil_data_login->User_Id;
			$level = $ambil_data_login->Levell;
			$kode_karyawan = $ambil_data_login->kode_karyawan;
			$nama_karyawan = $ambil_data_login->nama_karyawan;
			$foto = $ambil_data_login->foto;
			
			$data_user=array('user_id'=>$user_id,'level'=>$level,'kode_karyawan'=>$kode_karyawan,'nama_karyawan'=>$nama_karyawan,'foto'=>$foto);
			$this->session->set_userdata($data_user);

			$month=date("Y-m-d");
			$jumlah_total_penjualan = $this->model_transaksi->jumlah_total_penjualan($month);
			$jumlah_total_product = $this->model_transaksi->jumlah_total_product($month);
			$data_penjualan = $this->model_transaksi->data_penjualan();

			
			if(!empty($jumlah_total_penjualan->total_penjualan)){
				$total_penjualan = $jumlah_total_penjualan->total_penjualan;
			}else{
				$total_penjualan = 0;
			}

			
			if(!empty($jumlah_total_product->total_product)){
				$total_product = $jumlah_total_product->total_product;
			}else{
				$total_product = 0;
			}

			$data=array('jumlah_total_penjualan'=>$total_penjualan,
						'jumlah_total_product'=>$total_product,
						'data_penjualan'=>$data_penjualan);
			$this->load->view('admin/index',$data);
		}else{
			$data=array('pesan'=>'User Id/Password is invalid');
			$this->load->view('admin/login',$data);
		}
	 }
	 
	 function logout(){
		$this->session->sess_destroy();
		$this->load->view('admin/login');
	 }
 }
?>