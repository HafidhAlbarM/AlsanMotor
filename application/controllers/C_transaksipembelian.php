<?php
 class C_transaksipembelian extends CI_Controller
 {
     function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('mymodel');
        $this->load->model('model_transaksi');
        $this->load->library('fpdf');
     }

     function save(){
         //Header
         $kode_pembelian=$this->input->post('kode_pembelian');
         $kode_karyawan=$this->session->kode_karyawan;
         $kode_distributor=$this->input->post('kode_distributor');
         $tanggal_pembelian=$this->input->post('tanggal');
         $total_qty=$this->input->post('total_qty_hidden');
         $total=$this->input->post('total_hidden');

         $data_header=array('kode_pembelian'=>$kode_pembelian,'kode_karyawan'=>$kode_karyawan,'kode_distributor'=>$kode_distributor,'tanggal_pembelian'=>$tanggal_pembelian,'total_qty'=>$total_qty,'total'=>$total);
         $this->mymodel->insert('pembelian_h',$data_header);

         $no_array=0;
         //Detail
         foreach($_POST['kode_product'] as $row){
            $kode_product 	= $_POST['kode_product'][$no_array];
            $harga 	      = $_POST['harga'][$no_array];
            $qty         	= $_POST['qty'][$no_array];
            $sub_total 		= $_POST['sub_total'][$no_array];
            
            $insert=$this->model_transaksi->insert_detail_pembelian($kode_pembelian,$kode_product, $harga, $qty, $sub_total);
            $no_array++;
         }

         if($insert){
            $this->model_transaksi->update_id_transaksi_pembelian();

            $data_unset=array('kode_pembelian'=>'','tanggal_pembelian'=>'');
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
         $data_unset=array('kode_pembelian'=>'','tanggal_pembelian'=>'');
         $this->session->unset_userdata($data_unset);
         $this->load->view('admin/transaksi_pembelian');
      }

      function generate_report_pembelian(){
         $FromDate=$this->input->post('FromDate');
         $ToDate=$this->input->post('ToDate');
         $session_tanggal=array('FromDate'=>$FromDate,'ToDate'=>$ToDate);
         $this->session->set_userdata($session_tanggal);
         $data_transaksi=$this->model_transaksi->generate_report_pembelian($FromDate,$ToDate);
         $data=array('data_transaksi'=>$data_transaksi,'FromDate'=>$FromDate,'ToDate'=>$ToDate);
         $this->load->view('admin/transaksi_pembelian_laporan',$data);
      }

      function generate_report_pembelian_detail(){
         $FromDate=$this->input->post('FromDate');
         $ToDate=$this->input->post('ToDate');
         $session_tanggal=array('FromDate'=>$FromDate,'ToDate'=>$ToDate);
         $this->session->set_userdata($session_tanggal);
         $data_transaksi=$this->model_transaksi->generate_report_pembelian_detail($FromDate,$ToDate);
         $data=array('data_transaksi'=>$data_transaksi,'FromDate'=>$FromDate,'ToDate'=>$ToDate);
         $this->load->view('admin/transaksi_pembelian_laporan_detail',$data);
      }

      function export_to_pdf(){
         $FromDate=$this->session->FromDate;
         $ToDate=$this->session->ToDate;
         $data_transaksi=$this->model_transaksi->generate_report_pembelian($FromDate,$ToDate);
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
            $title='Purchasing Report';
            $pdf->SetTitle($title);
            $pdf->SetAuthor('Hafidh');
            $image1 = "assets/img/logo_alsan.jpg";
            $pdf->Cell( 40, 22, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );
            $pdf->Cell(150,10,"ALSAN MOTOR'S PURCHASHING REPORT (".$FromDate." to ".$ToDate.")",0,1,'R');
            $pdf->Ln();$pdf->Ln();

            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(7,5,'NO',1,0,'C');
            $pdf->Cell(35,5,'PURCHASING CODE',1,0,'C');
            $pdf->Cell(20,5,'DATE',1,0,'C');
            $pdf->Cell(35,5,'EMPLOYEE CODE',1,0,'C');
            $pdf->Cell(35,5,'DISTRIBUTOR CODE',1,0,'C');
            $pdf->Cell(20,5,'TOTAL QTY',1,0,'C');
            $pdf->Cell(35,5,'TOTAL',1,1,'C');

            $pdf->SetFont('Arial','',6);
            foreach ($data_transaksi->result() as $row) {
               $no++;
               $pdf->Cell(7,5,$no,1,0,'C');
               $pdf->Cell(35,5,$row->kode_pembelian,1,0,'C');
               $pdf->Cell(20,5,$row->tanggal_pembelian,1,0,'C');
               $pdf->Cell(35,5,$row->kode_karyawan,1,0,'C');
               $pdf->Cell(35,5,$row->kode_distributor,1,0,'C');
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
         $data_transaksi=$this->model_transaksi->generate_report_pembelian_detail($FromDate,$ToDate);
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
            $title='Purchasing Detail Report';
            $pdf->SetTitle($title);
            $pdf->SetAuthor('Hafidh');
            $image1 = "assets/img/logo_alsan.jpg";
            $pdf->Cell( 40, 22, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );
            $pdf->Cell(150,10,"ALSAN MOTOR'S PURCHASHING DETAIL REPORT",0,1,'R');
            $pdf->Cell(190,10,"(".$FromDate." to ".$ToDate.")",0,1,'R');
            $pdf->Ln();

            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(7,5,'NO',1,0,'C');
            $pdf->Cell(35,5,'PURCHASING CODE',1,0,'C');
            $pdf->Cell(20,5,'DATE',1,0,'C');
            $pdf->Cell(35,5,'PRODUCT CODE',1,0,'C');
            $pdf->Cell(35,5,'PRICE',1,0,'C');
            $pdf->Cell(20,5,'QTY',1,0,'C');
            $pdf->Cell(35,5,'SUB TOTAL',1,1,'C');

            $pdf->SetFont('Arial','',6);
            foreach ($data_transaksi->result() as $row) {
               $no++;
               $pdf->Cell(7,5,$no,1,0,'C');
               $pdf->Cell(35,5,$row->kode_pembelian,1,0,'C');
               $pdf->Cell(20,5,$row->tanggal_pembelian,1,0,'C');
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
     
 }
 
?>
