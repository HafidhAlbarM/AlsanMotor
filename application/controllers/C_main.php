<?php
 /**
 * 
 */
 class C_main extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('mymodel');
 		$this->load->model('model_product');
		$this->load->model('model_karyawan');
		$this->load->model('model_transaksi');
	 }
	 
 	function index(){
 		$this->load->view('user/index');
	}

	function login(){
		$this->load->view('admin/login');
	}

 	function admin_index(){
		 if(isset($this->session->user_id)){
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
			$this->login();
		 }
	 }
	 
 	function admin_profile(){
		if(isset($this->session->user_id)){
			$user_id=$this->session->user_id;
			$data_karyawan = $this->model_karyawan->get_data_profile($user_id);
			$data=array('data_karyawan' => $data_karyawan);
			$this->load->view('admin/profile', $data);
		 }else{
			$this->login();
		 }
	 }
	 
 	function admin_product(){
	    if( isset($this->session->user_id ) ){
			if( $this->session->level=='1'){
				$kategori=$this->model_product->get_kategori();
				$data=array("kategori"=>$kategori);
				$this->load->view('admin/product',$data);
			}else{
				$this->admin_index();
			}
	    }else{
			$this->login();
	    }	
	 }
	 
 	function admin_karyawan(){
		if( isset($this->session->user_id) ){
			if( $this->session->level=='1' ){
				$divisi=$this->model_karyawan->get_divisi();
				$data=array("divisi"=>$divisi);
				$this->load->view('admin/karyawan',$data);	
			}else{
				$this->admin_index();
			}
		}else{
			$this->login();
		}
 		
	 }
	 
 	function admin_user(){
		if(isset($this->session->user_id)){
			if( $this->session->level=='1' ){
				$this->load->view('admin/user');	
			}else{
				$this->admin_index();
			}
		}else{
			$this->login();
		}
	 }
	 
 	function admin_mobil(){
		if(isset($this->session->user_id)){
			if( $this->session->level=='1' || $this->session->level=='2'){
				$this->load->view('admin/mobil');
			}else{
				$this->admin_index();
			}
		}else{
			$this->login();
		}
	 }
	 
 	function admin_distributor(){
		if(isset($this->session->user_id)){
			if( $this->session->level=='1' ){
				$this->load->view('admin/distributor');	
			}else{
				$this->admin_index();
			}
		}else{
			$this->login();
		}
	 }
	 
 	function admin_transaksi_penjualan(){
		if(isset($this->session->user_id)){
			if( $this->session->level=='1' || $this->session->level=='2' ){
				$max_code=$this->model_transaksi->max_code('penjualan');
				$max_code=$max_code->max_code+1;
				$kode_penjualan="PJ".date('dmY').sprintf("%03s",$max_code);
				$data_session=array('kode_penjualan'=>$kode_penjualan,'tanggal_penjualan'=>date('Y-m-d'));
				$this->session->set_userdata($data_session);

				
				$data_mobil=$this->mymodel->semuadata('mobil');
				$data_product=$this->model_transaksi->get_list_product_penjualan();
				$data=array('data_mobil'=>$data_mobil,'data_product'=>$data_product);
				$this->load->view('admin/transaksi_penjualan',$data);
			}else{
				$this->admin_index();
			}
		}else{
			$this->login();
		}
	 }

	function admin_transaksi_penjualan_list(){
	    if( isset($this->session->user_id ) ){
			if( $this->session->level=='1' || $this->session->level=='2'){
				$this->load->view('admin/transaksi_penjualan_list');
			}else{
				$this->admin_index();
			}
	    }else{
			$this->login();
	    }	
	}

	function admin_transaksi_pemesanan_list(){
	    if( isset($this->session->user_id ) ){
			if( $this->session->level=='1' || $this->session->level=='2'){
				$this->load->view('admin/transaksi_pemesanan_list');
			}else{
				$this->admin_index();
			}
	    }else{
			$this->login();
	    }	
	}
	 
 	function admin_transaksi_pembelian(){
		if(isset($this->session->user_id)){
			if( $this->session->level=='1' ){
				$max_code=$this->model_transaksi->max_code('pembelian');
				$max_code=$max_code->max_code+1;
				$kode_penjualan="PB".date('dmY').sprintf("%03s",$max_code);
				$data_session=array('kode_pembelian'=>$kode_penjualan,'tanggal_pembelian'=>date('Y-m-d'));
				$this->session->set_userdata($data_session);
				

				$data_distributor=$this->mymodel->semuadata('distributor');
				$data_product=$this->model_transaksi->get_list_product_pembelian();
				$data=array('data_distributor'=>$data_distributor,'data_product'=>$data_product);
				$this->load->view('admin/transaksi_pembelian',$data);
			}else{
				$this->admin_index();
			}	
		}else{
			$this->login();
		}	
	 }

	 function admin_transaksi_beban(){
		if(isset($this->session->user_id)){
			if( $this->session->level=='1' ){
				$data_beban=$this->mymodel->semuadata('beban');
				$data=array('data_beban'=>$data_beban);
				$this->load->view('admin/transaksi_beban',$data);
			}else{
				$this->admin_index();
			}
		}else{
			$this->login();
		}
	 }

	 function admin_transaksi_penjualan_laporan(){
		if(isset($this->session->user_id)){
			if( $this->session->level=='1' ){
				$this->load->view('admin/transaksi_penjualan_laporan');
			}else{
				$this->admin_index();
			}
		}else{
			$this->login();
		}	
	 }

	 function admin_transaksi_penjualan_laporan_detail(){
		if(isset($this->session->user_id)){
			if( $this->session->level=='1' ){
				$this->load->view('admin/transaksi_penjualan_laporan_detail');
			}else{
				$this->admin_index();
			}
		}else{
			$this->login();
		}
	 }

	 function admin_transaksi_pembelian_laporan(){
		if(isset($this->session->user_id)){
			if( $this->session->level=='1' ){
				$this->load->view('admin/transaksi_pembelian_laporan');
			}else{
				$this->admin_index();
			}
		}else{
			$this->login();
		}
	 }

	 function admin_transaksi_pembelian_laporan_detail(){
		if(isset($this->session->user_id)){
			if( $this->session->level=='1' ){
				$this->load->view('admin/transaksi_pembelian_laporan_detail');
			}else{
				$this->admin_index();
			}
		}else{
			$this->login();
		}
	 }

	 function admin_laba_rugi_laporan(){
		if(isset($this->session->user_id)){
			// if( $this->session->level=='2' ){
				$this->load->view('admin/laba_rugi_laporan');
			// }else{
			// 	$this->admin_index();
			// }
		}else{
			$this->login();
		}
	 }
	function admin_google_map(){
		if(isset($this->session->user_id)){
			$this->load->view('admin/map-google');
		}else{
			$this->login();
		}
	}
 }
?>