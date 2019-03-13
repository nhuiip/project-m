<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Filemanager extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		// $this->lang->load(array('admin_page_lang','admin_form_lang'), 'english');
		$this->load->model("filemanager_model","filemanager");
	}

	public function index(){
		$data = array();
		$data['crffilemanager'] = $this->tokens->token('crffilemanager');
		$this->template->backend('filemanager/main',$data);
	}

	public function jsonListdata(){
		$typeFile = $this->input->post('typeFile');
		$Folder = $this->input->post('Folder');
		$Tags = $this->input->post('Tags');

		$data = array();
		$whereData = "file_delete_status != 0";
		if($Folder != ""){
			$whereData.= " AND file_folder = '$Folder'";
		}
		if($typeFile == "Documents"){
			$whereData.= " AND (file_name LIKE '%.pdf' OR file_name LIKE '%.doc' OR file_name LIKE '%.xls' OR file_name LIKE '%.xlsx')";
		}else if($typeFile == "Audio"){
			$whereData.= " AND (file_name LIKE '%.mp3' OR file_name LIKE '%.mp4' OR file_name LIKE '%.mpg4')";
		}else if($typeFile == "Images"){
			$whereData.= " AND (file_name LIKE '%.jpg' OR file_name LIKE '%.png' OR file_name LIKE '%.gif')";
		}
		if($Tags != ""){
			$word = explode(',',$Tags);
			if(count($word) != 0){
				$whereData.= " AND (";
				$whereWord = "";
				foreach ($word as $key => $value) {
					$whereWord.= "file_name LIKE '%$value%' OR ";
				}
				$whereData.= rtrim($whereWord,"OR ");
				$whereData.= ")";
			}
		}
		// $data['listdata'] = $whereData;
		// echo json_encode($data);
		// die;

		// List data filemanager
		$condition = array();
		$condition['fide'] = "file_id,file_name,file_folder,file_lastedit_date";
		$condition['where'] = $whereData;
		$condition['orderby'] = "file_lastedit_date DESC";
		$data['listdata'] = $this->filemanager->listData($condition);
		echo json_encode($data);
		die;

	}

	public function create(){
		if($this->tokens->verify('crffilemanager')){
			$data = array(
				'file_name' => $this->upload(),
				'file_folder' => $this->input->post('Text_Folder'),
				'file_lastedit_name' => $this->encryption->decrypt($this->input->cookie('sysli')),
				'file_lastedit_date' => date('Y-m-d H:i:s'),
				'file_delete_status' => 1
			);
			$this->filemanager->insertData($data);
			$result = array(
				'error' => false,
				'url' => site_url('manager/filemanager/index')
			);
			echo json_encode($result);
		}else{
			show_404();
		}
	}

	public function summernote(){
		$img = $this->upload();
		$data = array(
			'file_name' => $img,
			'file_folder' => 'Pictures',
			'file_lastedit_name' => $this->encryption->decrypt($this->input->cookie('sysli')),
			'file_lastedit_date' => date('Y-m-d H:i:s'),
			'file_delete_status' => 1
		);
		$this->filemanager->insertData($data);
		echo base_url('filemanager/Pictures/'.$img);
	}

	public function delete($Id){

		// List data filemanager
		$condition = array();
		$condition['fide'] = "file_id,file_name,file_folder,file_lastedit_date";
		$condition['where'] = array('file_delete_status' => 1, 'file_id' => $Id);
		$data['listdata'] = $this->filemanager->listData($condition);
		if(count($data['listdata']) != 0){
			foreach ($data['listdata'] as $key => $value) {
				if(file_exists("./filemanager/".$value['file_folder']."/".$value['file_name'])){
					unlink("./filemanager/".$value['file_folder']."/".$value['file_name']);
					$this->filemanager->delete($Id);
					header("location:".site_url('manager/filemanager/index'));
				}
			}
		}else{
			show_404();
		}
	}

	public function upload(){
		if(!empty($_FILES['File_images'])){
			$Fileold = "";
			$Text_Folder = $this->input->post('Text_Folder');
			if(empty($Text_Folder)){
				$Text_Folder = 'Pictures';
			}
			$config['upload_path'] = './filemanager/'.$Text_Folder."/";
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config ,'upload');
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('File_images')){
				echo $this->upload->display_errors();
				die;
				}
			else{
				if(!empty($Fileold)){
					@unlink($config['upload_path'].$Fileold);
				}
				$File_name = $this->upload->data();
				return $File_name['file_name'];
			}
		}else{
			return $Fileold;
		}
	}

}
