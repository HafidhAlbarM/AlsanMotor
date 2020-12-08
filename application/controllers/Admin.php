<?php
 /**
 * 
 */
 class Admin extends CI_Controller
 {
 	
 	function __construct()
 	{
		 parent::__construct();
		 $this->load->model('model_transaksi');
 	}
 	function index(){
		if(isset($this->session->user_id)){
			$month=date("Y-m-d");
			$jumlah_total_penjualan = $this->model_transaksi->jumlah_total_penjualan($month);
			$jumlah_total_product = $this->model_transaksi->jumlah_total_product($month);
			$data_penjualan = $this->model_transaksi->data_penjualan();
			$data=array('jumlah_total_penjualan'=>$jumlah_total_penjualan->total_penjualan,
						'jumlah_total_product'=>$jumlah_total_product->total_product,
						'data_penjualan'=>$data_penjualan);
			$this->load->view('admin/index',$data);
		}else{
			 $this->load->view('admin/login');
		}
 	}
 }
?>