<?php
 /**
 * 
 */
 class C_beban extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('mymodel');
 		$this->load->model('model_beban');
 	}
	function ambil_data_beban(){
		$fetch_data=$this->model_beban->make_datatables();
		$data=array();
		foreach($fetch_data as $row){
			$sub_array=array();
			$sub_array[]=$row->kode_transaksi_beban;
            $sub_array[]=$row->bulan;
            $sub_array[]=$row->kode_beban;
            $sub_array[]=number_format($row->biaya);
			$sub_array[]=number_format($row->total);
			$sub_array[]="";
			$data[]=$sub_array;
		}
		$output=array(
			"draw"				=> intval($_POST['draw']),
			"recordsTotal"		=> $this->model_beban->get_all_data(),
			"recordsFiltered" 	=> $this->model_beban->get_filtered_data(),
			"data"				=> $data
		);
		echo json_encode($output);
    }
    
    function kode_transaksi_beban(){
		//add
 		$max_code=$this->model_beban->max_code();
 		$new_code='BB'.date("dmY").sprintf("%03s",$max_code->max_code+1);
 		$data=array("kode_transaksi_beban"=>$new_code);
 		echo json_encode($data);
	}

	function save(){
		$data=array(
		 'kode_transaksi_beban'=>$this->input->post('kode_transaksi_beban'),
		 'bulan'=>$this->input->post('bulan'),
		 'total'=>$this->input->post('total'),
		);
        $this->mymodel->insert("beban_h",$data);
        $this->model_beban->update_kode_beban();
        
        for($i=1;$i<=4;$i++){
            $data=array(
                'kode_transaksi_beban'=>$this->input->post('kode_transaksi_beban'),
                'kode_beban'=>$this->input->post('BB00'.$i),
                'biaya'=>$this->input->post('BB00'.$i.'_jml'),
            );
            $this->mymodel->insert("beban_d",$data);
        }

		$status=array("status"=>"simpan");
		echo json_encode($status);
		//echo "Berhasil menambahkan beban";
 	}

 	// function update(){
	// 	$where=array('plat_nomor'=>$this->input->post('plat_nomor'));

	// 	$data=array(
	// 		'merk_beban'=>$this->input->post('merk_beban'),
	// 		'nama_beban'=>$this->input->post('nama_beban'),
	// 		'pemilik'=>$this->input->post('pemilik'),
	// 		'jenis'=>$this->input->post('jenis'),
	// 		'jumlah_cuci'=>$this->input->post('jumlah_cuci')
	// 	);
	// 	$this->mymodel->update("beban",$data,$where);
	// 	$status=array("status"=>"update");
	// 	echo json_encode($status);
	// 	//echo "Berhasil mengupdate beban";
 	// }

    // function delete($plat_nomor){
 	// 	$where=array('plat_nomor'=>$plat_nomor);
 	// 	$this->mymodel->delete('beban',$where);
 	// 	$status=array("status"=>"sukses");
 	// 	echo json_encode($status);
 	// }
	
 }
?>