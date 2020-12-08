<?php
 /**
 * 
 */
 class C_karyawan extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('mymodel');
 		$this->load->model('model_karyawan');
 	}
	function ambil_data_karyawan(){
		$fetch_data=$this->model_karyawan->make_datatables();
		$data=array();
		foreach($fetch_data as $row){
			$sub_array=array();
			$sub_array[]=$row->kode_karyawan;
			$sub_array[]=$row->nama_karyawan;
			$sub_array[]=$row->email;
			// $sub_array[]=$row->jenis_kelamin;
			// $sub_array[]=$row->alamat;
			// $sub_array[]=$row->no_telp;
			// $sub_array[]=$row->tanggal_masuk;
			// $sub_array[]=$row->nama_divisi;
			// $sub_array[]=$row->userid;
			$sub_array[]="<img src='".base_url()."assets/ample-admin-lite/plugins/images/users/".$row->foto."' height='100' width='100'>";
			$sub_array[]="<button type='button' class='btn btn-info update' name='update' id='".$row->kode_karyawan."'><i class='glyphicon glyphicon-edit'></i></button> <button type='button' class='btn btn-danger delete' name='delete' id='".$row->kode_karyawan."'><i class='glyphicon glyphicon-trash'></i></button>";
			$data[]=$sub_array;
		}
		$output=array(
			"draw"				=> intval($_POST['draw']),
			"recordsTotal"		=> $this->model_karyawan->get_all_data(),
			"recordsFiltered" 	=> $this->model_karyawan->get_filtered_data(),
			"data"				=> $data
		);
		echo json_encode($output);
	}

	function kode_karyawan(){
		//add
 		$max_code=$this->model_karyawan->max_code();
 		$new_code='KR'.date("dmY").sprintf("%03s",$max_code->max_code+1);
 		$data=array("kode_karyawan"=>$new_code);
 		echo json_encode($data);
	}

	function save(){
 			$data=array(
 			 'kode_karyawan'=>$this->input->post('kode_karyawan'),
			 'nama_karyawan'=>$this->input->post('nama_karyawan'),
			 'email'=>$this->input->post('email'),
 			 'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
 			 'alamat'=>$this->input->post('alamat'),
 			 'no_telp'=>$this->input->post('no_telp'),
 			 'tanggal_masuk'=>$this->input->post('tanggal_masuk'),
 			 'kode_divisi'=>$this->input->post('kode_divisi'),
 			 'foto'=>$this->upload_gambar(),
 			 'userid'=>$this->input->post('userid')
 			);
 			$this->mymodel->insert("karyawan",$data);
 			$this->model_karyawan->update_kode_karyawan();
 			$status=array("status"=>"simpan");
 			echo json_encode($status);
 			//echo "Berhasil menambahkan Mobil";
 	}

 	function update(){
 			$where=array('kode_karyawan'=>$this->input->post('kode_karyawan'));

 			$data=array(
			 'nama_karyawan'=>$this->input->post('nama_karyawan'),
			 'email'=>$this->input->post('email'),
 			 'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
 			 'alamat'=>$this->input->post('alamat'),
 			 'no_telp'=>$this->input->post('no_telp'),
 			 'tanggal_masuk'=>$this->input->post('tanggal_masuk'),
 			 'kode_divisi'=>$this->input->post('kode_divisi'),
 			 'foto'=>$this->upload_gambar(),
 			 'userid'=>$this->input->post('userid')
 			);
 			$this->mymodel->update("karyawan",$data,$where);
 			$status=array("status"=>"update");
 			echo json_encode($status);
 			//echo "Berhasil mengupdate Mobil";
 	}

 	function upload_gambar(){
 		if (isset($_FILES['foto'])) {

 			if ( $_FILES['foto']['name'] !="" ) {
 				
 				$ekstensi = explode('.',$_FILES['foto']['name']);//ngubah jadi array
 				$nama_baru = rand().'.'.$ekstensi[1];//milih array ke 1
 			
 				$config['file_name']=$nama_baru;
 				$config['upload_path'] = './assets/ample-admin-lite/plugins/images/users';
 				$config['allowed_types'] = 'gif|jpg|jpeg|png';
 				// $config['max_width']='1024';
 				// $config['max_height']='786';
 				$this->load->library('upload',$config);
 				$this->upload->do_upload('foto');

 			return $nama_baru;	
 			}else{
 				$nama_foto=$this->input->post('foto_lama');
 				return($nama_foto);
 			}
 			
 		}
 	}

 	function edit($kode_karyawan){
 		$where=array('kode_karyawan'=>$kode_karyawan);
 		$data=$this->mymodel->GetWhere('karyawan',$where);
 		echo json_encode($data);
 	}

 	function delete($kode_karyawan){
 		$where=array('kode_karyawan'=>$kode_karyawan);
 		$this->mymodel->delete('karyawan',$where);
 		$status=array("status"=>"sukses");
 		echo json_encode($status);
 	}
 	
	
 }
?>