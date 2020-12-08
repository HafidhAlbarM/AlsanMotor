<?php
 /**
 * 
 */
 class C_product extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('mymodel');
 		$this->load->model('model_product');
 	}
 	function ambil_data_product(){
		$fetch_data=$this->model_product->make_datatables();
		$data=array();
		foreach($fetch_data as $row){
			if($row->kategori<>'Service'){
				$stock=$row->stock;
				$harga_beli=number_format($row->harga_beli);
			}else{
				$stock='-';
				$harga_beli='-';
			}
			$sub_array=array();
			$sub_array[]=$row->kode_product;
			$sub_array[]=$row->nama_product;
			$sub_array[]=$row->kategori;
			$sub_array[]=$row->merk;
			$sub_array[]=$row->type;
			$sub_array[]=$harga_beli;
			$sub_array[]=number_format($row->harga_jual);
			$sub_array[]=$stock;
			$sub_array[]="<button type='button' class='btn btn-info update' name='update' id='".$row->kode_product."'><i class='glyphicon glyphicon-edit'></i></button> <button type='button' class='btn btn-danger delete' name='delete' id='".$row->kode_product."'><i class='glyphicon glyphicon-trash'></i></button>";
			$data[]=$sub_array;
		}
		$output=array(
			"draw"				=> intval($_POST['draw']),
			"recordsTotal"		=> $this->model_product->get_all_data(),
			"recordsFiltered" 	=> $this->model_product->get_filtered_data(),
			"data"				=> $data
		);
		echo json_encode($output);
	}
	function kode_product($kode_kategori){
		//add
 		$max_code=$this->model_product->max_code();
 		$new_code='PR'.date("dmY").$kode_kategori.sprintf("%03s",$max_code->max_code+1);
 		$data=array("kode_product"=>$new_code);
 		echo json_encode($data);
	}

	function simpan(){
		$data=array(
			'Kode_Product'=>$this->input->post('Kode_Product'),
 			 'Nama_Product'=>$this->input->post('Nama_Product'),
 			 'Kode_Kategori'=>$this->input->post('Kode_Kategori'),
 			 'Merk'=>$this->input->post('Merk'),
 			 'Type'=>$this->input->post('Type'),
 			 'Harga_Beli'=>$this->input->post('Harga_Beli'),
 			 'Harga_Jual'=>$this->input->post('Harga_Jual'),
 			 'Stock'=>$this->input->post('Stock')
		);
		$this->mymodel->insert("product",$data);
		$this->model_product->update_kode_product();
		$status=array("status"=>"simpan");
		echo json_encode($status);
		//echo "Berhasil menambahkan Mobil";
	}

 	function update(){
		 $id = array('Kode_Product'=>$this->input->post('Kode_Product'));
 			// $where=array('Kode_Product'=>$this->input->post('Kode_Product'));

 			$data=array(
 			 'Nama_Product' => $this->input->post('Nama_Product'),
 			 'Kode_Kategori' => $this->input->post('Kode_Kategori'),
 			 'Merk' => $this->input->post('Merk'),
 			 'Type' => $this->input->post('Type'),
 			 'Harga_Beli' => $this->input->post('Harga_Beli'),
 			 'Harga_Jual' => $this->input->post('Harga_Jual'),
 			 'Stock' => $this->input->post('Stock')
			 );
			 
			// var_dump($data);
 			$this->mymodel->update("product",$data,$id);
 			$status=array("status"=>"update");
 			echo json_encode($status);
 			//echo "Berhasil mengupdate Mobil";
 	}

 	function edit($Kode_Product){
 		$where=array('Kode_Product'=>$Kode_Product);
 		$data=$this->mymodel->GetWhere('product',$where);
 		echo json_encode($data);
 	}

 	function delete($Kode_Product){
 		$where=array('Kode_Product'=>$Kode_Product);
 		$this->mymodel->delete('product',$where);
 		$status=array("status"=>"sukses");
 		echo json_encode($status);
 	}
 }
?>