<?php
 /**
 * 
 */
 class C_laba_rugi extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
        $this->load->model('mymodel');
        $this->load->model('model_laba_rugi');
        $this->load->library('session');
        $this->load->library('fpdf');
     }
     
 	function generate_laporan_laba_rugi(){
        $FromDate=$this->input->post('FromDate');
        $ToDate=$this->input->post('ToDate');

        $session_tanggal=array('FromDate'=>$FromDate,'ToDate'=>$ToDate);
        $this->session->set_userdata($session_tanggal);

        //Akumulasi Laba/Rugi
        $data_beban=$this->model_laba_rugi->get_data_beban($FromDate,$ToDate);
        $data_beban_detail=$this->model_laba_rugi->get_data_beban_detail($FromDate,$ToDate);
        $data_pembelian=$this->model_laba_rugi->get_data_pembelian($FromDate,$ToDate);

        $data_penjualan=$this->model_laba_rugi->get_data_penjualan($FromDate,$ToDate);
        
        $lr_data_penjualan=$data_penjualan->data_penjualan;
        $lr_data_beban=$data_beban->data_beban;
        $lr_data_pembelian=$data_pembelian->data_pembelian;

        $lr_data_pengeluaran=$lr_data_beban+$lr_data_pembelian;
        $lrdata_pemasukan=$lr_data_penjualan;
        $laba_rugi=$lrdata_pemasukan-$lr_data_pengeluaran;

        $data=array(
                    'FromDate'=>$FromDate,
                    'ToDate'=>$ToDate,
                    'data_beban_detail'=>$data_beban_detail,
                    'data_beban'=>$lr_data_pengeluaran,
                    'data_pembelian'=>$lr_data_pembelian,
                    'data_penjualan'=>$lr_data_penjualan,
                    'laba_rugi'=>$laba_rugi);

        $this->load->view('admin/laba_rugi_laporan',$data);
     }

     function export_to_pdf(){
        $FromDate=$this->session->FromDate;
        $ToDate=$this->session->ToDate;
        //Akumulasi Laba/Rugi
        $data_beban=$this->model_laba_rugi->get_data_beban($FromDate,$ToDate);
        $data_beban_detail=$this->model_laba_rugi->get_data_beban_detail($FromDate,$ToDate);
        $data_pembelian=$this->model_laba_rugi->get_data_pembelian($FromDate,$ToDate);

        $data_penjualan=$this->model_laba_rugi->get_data_penjualan($FromDate,$ToDate);
        
        $lr_data_penjualan=$data_penjualan->data_penjualan;
        $lr_data_beban=$data_beban->data_beban;
        $lr_data_pembelian=$data_pembelian->data_pembelian;

        $lr_data_pengeluaran=$lr_data_beban+$lr_data_pembelian;
        $lrdata_pemasukan=$lr_data_penjualan;
        $laba_rugi=$lrdata_pemasukan-$lr_data_pengeluaran;

        $data_beban=$lr_data_pengeluaran;
        $data_pembelian=$lr_data_pembelian;
        $data_penjualan=$lr_data_penjualan;


           $pdf=new FPDF('P','mm','A4');
           $pdf->addPage();

           $pdf->SetFont('Arial','',13);
           $title='Profit & Loss Report';
           $pdf->SetTitle($title);
           $pdf->SetAuthor('Hafidh');
           $image1 = "assets/img/logo_alsan.jpg";
           $pdf->Cell( 40, 22, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );
           $pdf->Cell(150,10,"ALSAN MOTOR'S PROFIT & LOSS REPORT (".$FromDate." to ".$ToDate.")",0,1,'R');
           $pdf->Ln();$pdf->Ln();

           $pdf->SetFont('Arial','b',10);
           $pdf->Cell(45,8,'EXPENSES',0,1,'L');
           $pdf->SetFont('Arial','',10);
           foreach($data_beban_detail as $row){
            $pdf->Cell(45,5,$row->nama_beban,0,0,'L');
            $pdf->Cell(10,5,'Rp.',0,0,'L');
            $pdf->Cell(40,5,number_format($row->biaya,2),0,1,'R');
           }

           $pdf->SetFont('Arial','b',10);
           $pdf->Cell(45,5,'Total Expenses',0,0,'R');
           $pdf->Cell(10,5,'',0,0,'L');
           $pdf->Cell(40,5,'Rp.',0,0,'R');
           $pdf->Cell(40,5,number_format($data_pembelian,2),0,1,'R');

           $pdf->SetFont('Arial','b',10);
           $pdf->Cell(45,8,'INCOME',0,1,'L');
           $pdf->SetFont('Arial','',10);
           $pdf->Cell(45,5,'Selling',0,0,'L');
           $pdf->Cell(10,5,'Rp.',0,0,'L');
           $pdf->Cell(40,5,number_format($data_penjualan,2),0,1,'R');

           $pdf->SetFont('Arial','b',10);
           $pdf->Cell(45,5,'Total Income',0,0,'R');
           $pdf->Cell(10,5,'',0,0,'L');
           $pdf->Cell(40,5,'Rp.',0,0,'R');
           $pdf->Cell(40,5,number_format($data_penjualan,2),0,1,'R');

           $pdf->Cell(45,5,'Profit/Loss',0,0,'R');
           $pdf->Cell(10,5,'',0,0,'L');
           $pdf->Cell(40,5,'Rp.',0,0,'R');
           $pdf->Cell(40,5,number_format($laba_rugi,2),0,1,'R');

           
           $session_tanggal=array('FromDate'=>'','ToDate'=>'');
           $this->session->unset_userdata($session_tanggal);
           $pdf->Output();
        
     }
 }
?>