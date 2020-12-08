<?php
 /**
 * 
 */
 class C_user extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('mymodel');
 		$this->load->model('model_user');
 	}
	function ambil_data_user(){
		$fetch_data=$this->model_user->make_datatables();
		$data=array();
		foreach($fetch_data as $row){
			$sub_array=array();
			$sub_array[]=$row->User_Id;
			$sub_array[]=$row->Email;
			$sub_array[]=$row->Levell;
			$sub_array[]="<button type='button' class='btn btn-info update' name='update' id='".$row->User_Id."'><i class='glyphicon glyphicon-edit'></i></button> <button type='button' class='btn btn-danger delete' name='delete' id='".$row->User_Id."'><i class='glyphicon glyphicon-trash'></i></button>";
			$data[]=$sub_array;
		}
		$output=array(
			"draw"				=> intval($_POST['draw']),
			"recordsTotal"		=> $this->model_user->get_all_data(),
			"recordsFiltered" 	=> $this->model_user->get_filtered_data(),
			"data"				=> $data
		);
		echo json_encode($output);
	}

	function validasi_userid($userid){
 		$where=array('User_Id'=>$userid);
 		$data=$this->mymodel->jumlah_record('userr',$where);
 		if ($data>0) {
 			$status=array('data'=>'ada');
 		}else{
 			$status=array('data'=>'tidak ada');
 		}
 		echo json_encode($status);
 	}

 	function save(){
 			$data=array(
			 'User_Id'=>$this->input->post('User_Id'),
			 'Email'=>$this->input->post('Email'),
 			 'Password'=>md5($this->input->post('Password')),
 			 'Levell'=>$this->input->post('Levell'),
 			);
 			$this->mymodel->insert("userr",$data);
 			$status=array("status"=>"simpan");
 			echo json_encode($status);
 			//echo "Berhasil menambahkan Mobil";
 	}

 	function update(){
 			$where=array('User_Id'=>$this->input->post('User_Id'));

 			$data=array(
			  'Password'=>$this->input->post('Password'),
			  'Email'=>$this->input->post('Email'),
 			  'Levell'=>$this->input->post('Levell'),
 			);
 			$this->mymodel->update("userr",$data,$where);
 			$status=array("status"=>"update");
 			echo json_encode($status);
 			//echo "Berhasil mengupdate Mobil";
 	}

 	function edit($User_Id){
 		$where=array('User_Id'=>$User_Id);
 		$data=$this->mymodel->GetWhere('userr',$where);
 		echo json_encode($data);
 	}

 	function delete($User_Id){
 		$where=array('User_Id'=>$User_Id);
 		$this->mymodel->delete('userr',$where);
 		$status=array("status"=>"sukses");
 		echo json_encode($status);
 	}
	
 }
?>