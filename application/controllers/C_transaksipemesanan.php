<?php
 class C_transaksipemesanan extends CI_Controller
 {
     function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('array');
        $this->load->model('mymodel');
        $this->load->model('model_transaksi');
        $this->load->model('model_mobil');
        $this->load->library('fpdf');
     }

     function ambil_data_pemesanan(){
		$fetch_data=$this->model_transaksi->make_datatables_pemesanan();
		$data=array();
		foreach($fetch_data as $row){
			$sub_array=array();
			$sub_array[]=$row->kode_pemesanan;
			$sub_array[]=$row->tanggal_pemesanan;
			$sub_array[]=$row->nama_karyawan;
			$sub_array[]=$row->plat_nomor;
			$sub_array[]=$row->nama_mobil;
         $sub_array[]=number_format($row->total);
         $sub_array[]=$row->status;
         $sub_array[]="<button type='button' class='btn btn-info update' name='update' id='".$row->kode_pemesanan."' data-url='".base_url('C_transaksipemesanan/pemesanan_detail/').$row->kode_pemesanan."'><i class='fa fa-archive'></i></button> <a href='".base_url('c_transaksipemesanan/cetak_transaksi_pemesanan')."' class='btn btn-info update' name='cetak'><i class='fa fa-file'></i></a>";
			$data[]=$sub_array;
		}
		$output=array(
			"draw"				=> intval($_POST['draw']),
			"recordsTotal"		=> $this->model_transaksi->get_all_data_pemesanan(),
			"recordsFiltered" 	=> $this->model_transaksi->get_filtered_data_pemesanan(),
			"data"				=> $data
		);
		echo json_encode($output);
   }
   
   function pemesanan_detail($kode_pemesanan){
      $data_header_pemesanan = $this->model_transaksi->get_kwitansi_pemesanan_header($kode_pemesanan);
      $data_detail_pemesanan = $this->model_transaksi->get_kwitansi_pemesanan_detail($kode_pemesanan);
      $this->data['data_header_pemesanan'] = $data_header_pemesanan;
      $this->data['data_detail_pemesanan'] = $data_detail_pemesanan;
      
      $this->load->view('admin/transaksi_pemesanan_detail', $this->data);
   }

   function save_data_penjualan(){
      $kode_pemesanan = $this->input->post('kode_pemesanan');
      $data_header_pemesanan = $this->mymodel->GetWhere('pemesanan_h',array('kode_pemesanan'=>$kode_pemesanan));

      $max_code = $this->model_transaksi->max_code('penjualan');
      $max_code = $max_code->max_code+1;
		$kode_penjualan = "PJ".date('dmY').sprintf("%03s",$max_code);

      $insert_header = array(
         'kode_penjualan' => $kode_penjualan,
         'kode_karyawan' => $data_header_pemesanan->kode_karyawan,
         'plat_nomor' => $data_header_pemesanan->plat_nomor,
         'tanggal_penjualan' => date("Y-m-d"),
         'total_qty' => $data_header_pemesanan->total_qty,
         'total' => $data_header_pemesanan->total,
         'status' => 'LUNAS',
         'sumber' => $data_header_pemesanan->sumber,
         'kode_pemesanan' => $data_header_pemesanan->kode_pemesanan
      );

      $data_detail_pemesanan = $this->model_transaksi->get_kwitansi_pemesanan_detail($kode_pemesanan)->result();

      if($this->mymodel->insert('penjualan_h', $insert_header)){
            foreach($data_detail_pemesanan as $row){
               $insert_detail = array(
                  'kode_penjualan' => $kode_penjualan,
                  'kode_product' => $row->kode_product,
                  'harga' => $row->harga,
                  'qty' => $row->qty,
                  'sub_total' => $row->sub_total
               );
               $this->mymodel->insert('penjualan_d', $insert_detail);
            }

            $this->mymodel->update('pemesanan_h',array('status'=>'LUNAS'),array('kode_pemesanan'=>$kode_pemesanan));
            $data_pemesan = $this->model_transaksi->data_pemesan($data_header_pemesanan->plat_nomor);
            $this->sendEmail($kode_penjualan, $data_header_pemesanan->kode_pemesanan, $data_pemesan);
      }

      // UPDATE JUMLAH TRANSAKSI UTK KODE OTOMATIS
      $this->model_transaksi->update_id_transaksi_penjualan();

      echo json_encode(array('SUCCESS'=>1));

      return;
   }

   public function sendEmail($kode_penjualan, $kode_pemesanan, $data_pemesan)
	{
      $config['protocol']  = 'smtp';
      $config['smtp_host'] = 'ssl://smtp.gmail.com';
    	$config['smtp_port'] = '465'; 
      $config['smtp_user'] = 'alsanskripsi@gmail.com';
      $config['smtp_pass'] = 'buatskripsi123';
		$config['charset']   = 'iso-8859-1';
      
		$data = array(
                  'message' => 'Pembelian atas nomor pemesanan bla bla telah berhasil dan barang akan segera di antar ke rumah Anda',
                  'pemilik' => $data_pemesan->pemilik,
                  'alamat' =>  $data_pemesan->alamat,
                  'kode_penjualan' => $kode_penjualan,
                  'kode_pemesanan' => $kode_pemesanan
              );
		$body = $this->load->view('admin/body_email',$data,TRUE); 
		$this->load->library('email',$config);

		$this->email->set_newline("\r\n");
		$this->email->set_mailtype("html");
      $this->email->from('alsanskripsi@gmail.com', 'ALSAN MOTOR');
      $this->email->to($data_pemesan->email); 
      $this->email->subject('PEMBELIAN SUKSES dan akan segera di antar ke alamat | ALsan Motor');
      $this->email->message($body);  
        
		$this->email->send();
	}

   function cetak_transaksi_pemesanan(){
      $data_header=$this->model_transaksi->get_kwitansi_header();
      $kode_penjualan=$data_header->kode_penjualan;
      $data_detail=$this->model_transaksi->get_kwitansi_detail($kode_penjualan);

      $pdf=new FPDF('P','mm','A4');
      $pdf->addPage();

      $pdf->SetFont('Arial','',13);
      $title='Order Detail Report';
      $pdf->SetTitle($title);
      $pdf->SetAuthor('Hafidh');
      $image1 = "assets/img/logo_alsan.jpg";
      $pdf->Cell( 40, 22, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );
      $pdf->Cell(120,10,"ALSAN MOTOR'S RECEIPT",0,1,'C');
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(200,10,"Body Painting & Body Repair, Car Wash, Body Shop, Audio,",0,1,'C');
      $pdf->Cell(200,10,"Car Salon, Variation & Modification, Oil Changing",0,1,'C');
      $pdf->Cell(200,10,"Jl. Buwek Jaya No.27, Tambun Selatan (021) 88332410, Bekasi 17519",0,1,'C');
      
      $pdf->Ln();

      $pdf->SetFont('Arial','',6);
      $pdf->Cell(90,5,'Order Code',1,0,'L');
      $pdf->Cell(90,5,$data_header->kode_penjualan,1,1,'L');

      $pdf->Cell(90,5,'Order Date',1,0,'L');
      $pdf->Cell(90,5,$data_header->tanggal_penjualan,1,1,'L');
      
      $pdf->Cell(90,5,'Employee  ',1,0,'L');
      $pdf->Cell(90,5,$data_header->nama_karyawan,1,1,'L');

      $pdf->Cell(90,5,'Plate Number',1,0,'L');
      $pdf->Cell(90,5,$data_header->plat_nomor,1,1,'L');

      $pdf->Cell(90,5,'Car',1,0,'L');
      $pdf->Cell(90,5,$data_header->mobil,1,1,'L');

      $pdf->Ln();

      $pdf->Cell(45,5,'Product',1,0,'C');
      $pdf->Cell(45,5,'Price',1,0,'C');
      $pdf->Cell(25,5,'Qty',1,0,'C');
      $pdf->Cell(65,5,'Sub Total',1,1,'C');
      
      foreach($data_detail->result() as $row){
         $pdf->Cell(45,5,$row->Nama_Product,1,0,'L');
         $pdf->Cell(45,5,number_format($row->harga,2),1,0,'R');
         $pdf->Cell(25,5,$row->qty,1,0,'R');
         $pdf->Cell(65,5,number_format($row->sub_total,2),1,1,'R');
      }

      $pdf->SetFont('Arial','B',6);
      
      $pdf->Cell(90,5,'Total',1,0,'C');
      $pdf->Cell(25,5,$data_header->total_qty,1,0,'R');
      $pdf->Cell(65,5,number_format($data_header->total,2),1,1,'R');
      
      $pdf->Output();
   }
     
 }
 
?>
