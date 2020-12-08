<?php
 class C_transaksipenjualan extends CI_Controller
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

     function save(){
        //Header
        $kode_penjualan=$this->input->post('kode_penjualan');
        $kode_karyawan=$this->session->kode_karyawan;
        $plat_nomor=$this->input->post('plat_nomor');
        $tanggal_penjualan=$this->input->post('tanggal');
        $total_qty=$this->input->post('total_qty_hidden');
        $total=$this->input->post('total_hidden');
        $status='LUNAS';
        $sumber='WEB';

        $data_header=array('kode_penjualan'=>$kode_penjualan,'kode_karyawan'=>$kode_karyawan,'plat_nomor'=>$plat_nomor,'tanggal_penjualan'=>$tanggal_penjualan,'total_qty'=>$total_qty,'total'=>$total,'status'=>$status,'sumber'=>$sumber);
        $this->mymodel->insert('penjualan_h',$data_header);

        $no_array=0;
        //Detail
         foreach($_POST['kode_product'] as $row){
            $kode_product 	= $_POST['kode_product'][$no_array];
            $harga 	      = $_POST['harga'][$no_array];
            $qty         	= $_POST['qty'][$no_array];
            $sub_total 		= $_POST['sub_total'][$no_array];
            
            $insert=$this->model_transaksi->insert_detail_penjualan($kode_penjualan,$kode_product, $harga, $qty, $sub_total);
            if($_POST['kode_product'][$no_array] == 'PR21112018JSA002'){
               $this->model_mobil->update_jumlah_cuci($plat_nomor);
            }

            $no_array++;
         }

         if($insert){
            $this->model_transaksi->update_id_transaksi_penjualan();

            $data_unset=array('kode_penjualan'=>'','tanggal_penjualan'=>'');
            $this->session->unset_userdata($data_unset);
            
            $pesan=array("pesan"=>"Transaction Success");
            $this->session->set_userdata($pesan);
            echo json_encode($pesan);
         }
     }

     function check_session(){
        if(isset($this->session->pesan)){
            $pesan=array("pesan"=>"Transaction Success");
            //pesannya di unset lagi
            $pesan2=array("pesan"=>"");
            $this->session->unset_userdata($pesan2);
            echo json_encode($pesan);
        }
     }

     function cancel(){
            $data_unset=array('kode_penjualan'=>'','tanggal_penjualan'=>'');
            $this->session->unset_userdata($data_unset);
            $this->load->view('admin/transaksi_penjualan');
     }

     function ambil_data_penjualan(){
		$fetch_data=$this->model_transaksi->make_datatables();
		$data=array();
		foreach($fetch_data as $row){
			$sub_array=array();
			$sub_array[]=$row->kode_penjualan;
			$sub_array[]=$row->tanggal_penjualan;
			$sub_array[]=$row->nama_karyawan;
			$sub_array[]=$row->plat_nomor;
			$sub_array[]=$row->nama_mobil;
         $sub_array[]=number_format($row->total);
         $sub_array[]=$row->status;
			$sub_array[]="<button type='button' class='btn btn-info update' name='update' id='".$row->kode_penjualan."' data-url='".base_url('C_transaksipenjualan/penjualan_detail/').$row->kode_penjualan."'><i class='fa fa-archive'></i></button>";
			$data[]=$sub_array;
		}
		$output=array(
			"draw"				=> intval($_POST['draw']),
			"recordsTotal"		=> $this->model_transaksi->get_all_data(),
			"recordsFiltered" 	=> $this->model_transaksi->get_filtered_data(),
			"data"				=> $data
		);
		echo json_encode($output);
   }
   
   function ambil_data_detail_penjualan($kode_penjualan){
      $data_detail = $this->model_transaksi->get_kwitansi_detail($kode_penjualan)->result();
      $data=array(
         'kode_penjualan'=>$kode_penjualan,
         'data_detail'=>$data_detail
      );
      echo json_encode($data);
   }

   function penjualan_detail($kode_penjualan){
      $data_detail_penjualan = $this->model_transaksi->get_kwitansi_detail($kode_penjualan);
      $this->data['data_detail_penjualan'] = $data_detail_penjualan;
      $this->load->view('admin/transaksi_penjualan_detail', $this->data);
   }

   function update_status_penjualan($kode_penjualan, $status){
      $update=$this->model_transaksi->update_status_penjualan($kode_penjualan, urldecode($status));
      $hasil=array('status'=>'berhasil');
      echo json_encode($hasil);
   }

     function generate_report_penjualan(){
      $FromDate=$this->input->post('FromDate');
      $ToDate=$this->input->post('ToDate');
      $session_tanggal=array('FromDate'=>$FromDate,'ToDate'=>$ToDate);
      $this->session->set_userdata($session_tanggal);
      $data_transaksi=$this->model_transaksi->generate_report_penjualan($FromDate,$ToDate);
      $data=array('data_transaksi'=>$data_transaksi,'FromDate'=>$FromDate,'ToDate'=>$ToDate);
      $this->load->view('admin/transaksi_penjualan_laporan',$data);
   }

   function generate_report_penjualan_detail(){
      $FromDate=$this->input->post('FromDate');
      $ToDate=$this->input->post('ToDate');
      $session_tanggal=array('FromDate'=>$FromDate,'ToDate'=>$ToDate);
      $this->session->set_userdata($session_tanggal);
      $data_transaksi=$this->model_transaksi->generate_report_penjualan_detail($FromDate,$ToDate);
      $data=array('data_transaksi'=>$data_transaksi,'FromDate'=>$FromDate,'ToDate'=>$ToDate);
      $this->load->view('admin/transaksi_penjualan_laporan_detail',$data);
   }

   function export_to_pdf(){
      $FromDate=$this->session->FromDate;
      $ToDate=$this->session->ToDate;
      $data_transaksi=$this->model_transaksi->generate_report_penjualan($FromDate,$ToDate);
      if(isset($data_transaksi)){ 
         $total=0;
         $total_qty=0;
         foreach($data_transaksi->result() as $row){
               $total=$total+$row->total;
               $total_qty=$total_qty+$row->total_qty;
         }
         $no=0;

         $pdf=new FPDF('P','mm','A4');
         $pdf->addPage();

         $pdf->SetFont('Arial','',13);
         $title='Selling Report';
         $pdf->SetTitle($title);
         $pdf->SetAuthor('Hafidh');
         $image1 = "assets/img/logo_alsan.jpg";
         $pdf->Cell( 40, 22, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );
         $pdf->Cell(150,10,"ALSAN MOTOR'S SELLING REPORT (".$FromDate." to ".$ToDate.")",0,1,'R');
         $pdf->Ln();$pdf->Ln();

         $pdf->SetFont('Arial','B',6);
         $pdf->Cell(7,5,'NO',1,0,'C');
         $pdf->Cell(35,5,'SELLING CODE',1,0,'C');
         $pdf->Cell(20,5,'DATE',1,0,'C');
         $pdf->Cell(35,5,'EMPLOYEE CODE',1,0,'C');
         $pdf->Cell(35,5,'PLATE NUMBER',1,0,'C');
         $pdf->Cell(20,5,'TOTAL QTY',1,0,'C');
         $pdf->Cell(35,5,'TOTAL',1,1,'C');

         $pdf->SetFont('Arial','',6);
         foreach ($data_transaksi->result() as $row) {
            $no++;
            $pdf->Cell(7,5,$no,1,0,'C');
            $pdf->Cell(35,5,$row->kode_penjualan,1,0,'C');
            $pdf->Cell(20,5,$row->tanggal_penjualan,1,0,'C');
            $pdf->Cell(35,5,$row->kode_karyawan,1,0,'C');
            $pdf->Cell(35,5,$row->plat_nomor,1,0,'C');
            $pdf->Cell(20,5,$row->total_qty,1,0,'R');
            $pdf->Cell(35,5,number_format($row->total,2),1,1,'R');
         }
         
         $pdf->SetFont('Arial','B',6);
         $pdf->Cell(152,5,'Total Qty',1,0,'C');
         $pdf->Cell(35,5,$total_qty,1,1,'R');
         $pdf->Cell(152,5,'Total',1,0,'C');
         $pdf->Cell(35,5,number_format($total,2),1,1,'R');

         $session_tanggal=array('FromDate'=>'','ToDate'=>'');
         $this->session->unset_userdata($session_tanggal);
         $pdf->Output();
      }
   }

   function export_to_pdf_detail(){
      $FromDate=$this->session->FromDate;
      $ToDate=$this->session->ToDate;
      $data_transaksi=$this->model_transaksi->generate_report_penjualan_detail($FromDate,$ToDate);
      if(isset($data_transaksi)){ 
         // $total=0;
         // $total_qty=0;
         // foreach($data_transaksi->result() as $row){
         //       $total=$total+$row->total;
         //       $total_qty=$total_qty+$row->total_qty;
         // }
         $no=0;

         $pdf=new FPDF('P','mm','A4');
         $pdf->addPage();

         $pdf->SetFont('Arial','',13);
         $title='Selling Detail Report';
         $pdf->SetTitle($title);
         $pdf->SetAuthor('Hafidh');
         $image1 = "assets/img/logo_alsan.jpg";
         $pdf->Cell( 40, 22, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );
         $pdf->Cell(150,10,"ALSAN MOTOR'S SELLING DETAIL REPORT",0,1,'R');
         $pdf->Cell(190,10,"(".$FromDate." to ".$ToDate.")",0,1,'R');
         $pdf->Ln();

         $pdf->SetFont('Arial','B',6);
         $pdf->Cell(7,5,'NO',1,0,'C');
         $pdf->Cell(35,5,'SELLING CODE',1,0,'C');
         $pdf->Cell(20,5,'DATE',1,0,'C');
         $pdf->Cell(35,5,'PRODUCT CODE',1,0,'C');
         $pdf->Cell(35,5,'PRICE',1,0,'C');
         $pdf->Cell(20,5,'QTY',1,0,'C');
         $pdf->Cell(35,5,'SUB TOTAL',1,1,'C');

         $pdf->SetFont('Arial','',6);
         foreach ($data_transaksi->result() as $row) {
            $no++;
            $pdf->Cell(7,5,$no,1,0,'C');
            $pdf->Cell(35,5,$row->kode_penjualan,1,0,'C');
            $pdf->Cell(20,5,$row->tanggal_penjualan,1,0,'C');
            $pdf->Cell(35,5,$row->kode_product,1,0,'C');
            $pdf->Cell(35,5,number_format($row->harga,2),1,0,'R');
            $pdf->Cell(20,5,$row->qty,1,0,'R');
            $pdf->Cell(35,5,number_format($row->sub_total,2),1,1,'R');
         }
         
         // $pdf->SetFont('Arial','B',6);
         // $pdf->Cell(152,5,'Total Qty',1,0,'C');
         // $pdf->Cell(35,5,$total_qty,1,1,'R');
         // $pdf->Cell(152,5,'Total',1,0,'C');
         // $pdf->Cell(35,5,number_format($total,2),1,1,'R');

         $session_tanggal=array('FromDate'=>'','ToDate'=>'');
         $this->session->unset_userdata($session_tanggal);
         $pdf->Output();
      }
   }

   function cetak_transaksi_sebelumnya(){
         $data_header=$this->model_transaksi->get_kwitansi_header();
         $kode_penjualan=$data_header->kode_penjualan;
         $data_detail=$this->model_transaksi->get_kwitansi_detail($kode_penjualan);

         $pdf=new FPDF('P','mm','A4');
         $pdf->addPage();

         $pdf->SetFont('Arial','',13);
         $title='Selling Detail Report';
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
         $pdf->Cell(90,5,'Transaction Code',1,0,'L');
         $pdf->Cell(90,5,$data_header->kode_penjualan,1,1,'L');

         $pdf->Cell(90,5,'Transaction Date',1,0,'L');
         $pdf->Cell(90,5,$data_header->tanggal_penjualan,1,1,'L');

         $pdf->Cell(90,5,'Order Code',1,0,'L');
         $pdf->Cell(90,5,$data_header->kode_pemesanan,1,1,'L');
         
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

   function validasi_plat_nomor($plat_nomor){
      $where=array('plat_nomor'=>$plat_nomor);
      $data_mobil=$this->mymodel->GetWhere('mobil',$where);
      $merk_mobil=$data_mobil->merk_mobil;
      $nama_mobil=$data_mobil->nama_mobil;
		$data=$this->mymodel->jumlah_record('mobil',$where);
		if (!empty($data)) {
			$status=array('data'=>'ada','data_mobil'=>$data_mobil,'merk_mobil'=>$merk_mobil,'nama_mobil'=>$nama_mobil);
		}else{
			$status=array('data'=>'tidak ada');
		}
		echo json_encode($status);
	}
     
 }
 
?>
