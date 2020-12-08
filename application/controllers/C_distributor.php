<?php
 /**
 * 
 */
 class C_distributor extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('mymodel');
 		$this->load->model('model_distributor');
 	}
	function ambil_data_Distributor(){
		$fetch_data=$this->model_distributor->make_datatables();
		$data=array();
		foreach($fetch_data as $row){
			$sub_array=array();
			$sub_array[]=$row->kode_distributor;
			$sub_array[]=$row->nama_distributor;
			$sub_array[]=$row->no_telepon;
			$sub_array[]=$row->alamat;
			$sub_array[]="<button type='button' class='btn btn-info update' name='update' id='".$row->kode_distributor."'><i class='glyphicon glyphicon-edit'></i></button> <button type='button' class='btn btn-danger delete' name='delete' id='".$row->kode_distributor."'><i class='glyphicon glyphicon-trash'></i></button>";
			$data[]=$sub_array;
		}
		$output=array(
			"draw"				=> intval($_POST['draw']),
			"recordsTotal"		=> $this->model_distributor->get_all_data(),
			"recordsFiltered" 	=> $this->model_distributor->get_filtered_data(),
			"data"				=> $data
		);
		echo json_encode($output);
	}

	function kode_distributor(){
		//add
 		$max_code=$this->model_distributor->max_code();
 		$new_code='DS'.date('dmY').sprintf("%03s",$max_code->max_code+1);
 		$data=array("kode_distributor"=>$new_code);
 		echo json_encode($data);
	}

	function save(){
 			$data=array(
 			 'kode_distributor'=>$this->input->post('kode_distributor'),
 			 'nama_distributor'=>$this->input->post('nama_distributor'),
 			 'no_telepon'=>$this->input->post('no_telepon'),
 			 'alamat'=>$this->input->post('alamat')
 			);
 			$this->mymodel->insert("distributor",$data);
 			$this->model_distributor->update_kode_distributor();
 			$status=array("status"=>"simpan");
 			echo json_encode($status);
 			//echo "Berhasil menambahkan Mobil";
 	}

 	function update(){
 			$where=array('kode_distributor'=>$this->input->post('kode_distributor'));

 			$data=array(
 			 'nama_distributor'=>$this->input->post('nama_distributor'),
 			 'no_telepon'=>$this->input->post('no_telepon'),
 			 'alamat'=>$this->input->post('alamat')
 			);
 			$this->mymodel->update("distributor",$data,$where);
 			$status=array("status"=>"update");
 			echo json_encode($status);
 			//echo "Berhasil mengupdate Mobil";
 	}

 	function edit($kode_distributor){
 		$where=array('kode_distributor'=>$kode_distributor);
 		$data=$this->mymodel->GetWhere('distributor',$where);
 		echo json_encode($data);
 	}

 	function delete($kode_distributor){
 		$where=array('kode_distributor'=>$kode_distributor);
 		$this->mymodel->delete('distributor',$where);
 		$status=array("status"=>"sukses");
 		echo json_encode($status);
 	}

	
 }
?>