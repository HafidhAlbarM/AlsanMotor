<?php
 /**
 * 
 */
 class C_mobil extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('mymodel');
 		$this->load->model('model_mobil');
 	}
	function ambil_data_mobil(){
		$fetch_data=$this->model_mobil->make_datatables();
		$data=array();
		foreach($fetch_data as $row){
			$sub_array=array();
			$sub_array[]=$row->plat_nomor;
			$sub_array[]=$row->merk_mobil;
			$sub_array[]=$row->nama_mobil;
			$sub_array[]=$row->pemilik;
			$sub_array[]=$row->jenis;
			$sub_array[]=$row->jumlah_cuci;
			$sub_array[]="<button type='button' class='btn btn-info update' name='update' id='".$row->plat_nomor."'><i class='glyphicon glyphicon-edit'></i></button> <button type='button' class='btn btn-danger delete' name='delete' id='".$row->plat_nomor."'><i class='glyphicon glyphicon-trash'></i></button>";
			$data[]=$sub_array;
		}
		$output=array(
			"draw"				=> intval($_POST['draw']),
			"recordsTotal"		=> $this->model_mobil->get_all_data(),
			"recordsFiltered" 	=> $this->model_mobil->get_filtered_data(),
			"data"				=> $data
		);
		echo json_encode($output);
	}

	function save(){
		$data=array(
		 'plat_nomor'=>$this->input->post('plat_nomor'),
		 'merk_mobil'=>$this->input->post('merk_mobil'),
		 'nama_mobil'=>$this->input->post('nama_mobil'),
		 'pemilik'=>$this->input->post('pemilik'),
		 'jenis'=>$this->input->post('jenis'),
		 'jumlah_cuci'=>$this->input->post('jumlah_cuci'),
		 'User_Id'=>$this->input->post('User_Id')
		);
		$this->mymodel->insert("mobil",$data);

		$User_Id = $this->input->post('User_Id');
		$Email = $this->input->post('Email');
		$Password = $this->input->post('Password');
		if(!empty($User_Id) && !empty($Email) && !empty($Password)){
			$data_user=array(
				'User_Id'=>$User_Id,
				'Email'=>$Email,
				'Password'=>md5($Password),
				'Levell'=>3
			);
			$this->mymodel->insert("userr", $data_user);
		}
		$status=array("status"=>"simpan");
		echo json_encode($status);
		//echo "Berhasil menambahkan mobil";
 	}

 	function update(){
		$where=array('plat_nomor'=>$this->input->post('plat_nomor'));

		$data=array(
			'merk_mobil'=>$this->input->post('merk_mobil'),
			'nama_mobil'=>$this->input->post('nama_mobil'),
			'pemilik'=>$this->input->post('pemilik'),
			'jenis'=>$this->input->post('jenis'),
			'jumlah_cuci'=>$this->input->post('jumlah_cuci'),
			'User_Id'=>$this->input->post('User_Id')
		);
		$this->mymodel->update("mobil",$data,$where);

		$User_Id = $this->input->post('User_Id');
		$Email = $this->input->post('Email');
		$Password = $this->input->post('Password');
		if(!empty($Password)){
			$data_user=array(
				'Password'=>md5($Password)
			);
			$where=array('User_Id'=>$this->input->post('User_Id'));
			$this->mymodel->update("userr", $data_user, $where);
		}
		$status=array("status"=>"update");
		echo json_encode($status);
		//echo "Berhasil mengupdate mobil";
 	}

 	function edit($plat_nomor){
        $where=array('plat_nomor'=>$plat_nomor);
		$data=$this->mymodel->GetWhere('mobil',$where);
		$data_array_mobil = (array) $data;
		// var_dump( (array) $data );
		$data_user=$this->mymodel->GetWhere('userr',array('User_Id'=>$data->User_Id));
		$data_user = (array) $data_user;

		$data = array_merge($data_array_mobil, $data_user);
        echo json_encode($data);
    }

    function delete($plat_nomor){
		$where=array('plat_nomor'=>$plat_nomor);
		$data_mobil = $this->mymodel->GetWhere('mobil',$where);
		if($data_mobil){
			$this->mymodel->delete('mobil',$where);
			$where=array('User_Id'=>$data_mobil->User_Id);
			$jml_user = $this->mymodel->jumlah_record('userr',$where);
			if($jml_user>0){
				$this->mymodel->delete('userr',$where);
			}
			$status=array("status"=>"sukses");
		}else{
			$status=array("status"=>"gagal");
		}
		echo json_encode($data_mobil);
	 }
	 
	 function validasi_plat_nomor($plat_nomor){
		$where=array('plat_nomor'=>$plat_nomor);
		$data=$this->mymodel->jumlah_record('mobil',$where);
		if ($data>0) {
			$status=array('data'=>'ada');
		}else{
			$status=array('data'=>'tidak ada');
		}
		echo json_encode($status);
	}

	function validasi_email(){
		$where=array('email'=>$this->input->post('email'));
		$data=$this->mymodel->jumlah_record('userr',$where);
		if ($data>0){
			$status=array('data'=>'ada');
		}else{
			$status=array('data'=>'tidak ada');
		}
		echo json_encode($status);
	}

	function validasi_user_id(){
		$where=array('User_Id'=>$this->input->post('User_Id'));
		$data=$this->mymodel->jumlah_record('userr',$where);
		if ($data>0){
			$status=array('data'=>'ada');
		}else{
			$status=array('data'=>'tidak ada');
		}
		echo json_encode($status);
	}
	
 }
?>