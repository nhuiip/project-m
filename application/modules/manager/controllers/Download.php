<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Download extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("download_model","download");
		$this->permission->admin();
		$this->load->library('getlanguage');
	}

	public function index(){
		$data = array();

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('download_status !=' => 0);
		$condition['orderby'] = "download_status DESC,download_lastedit DESC";
		$data['listdata'] = $this->download->listData($condition);

		$this->template->backend('download/main',$data);
	}

	public function form($id = ""){
		$data = array();

		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('download_id' => $id, 'download_status !=' => 0);
			$data['listdata'] = $this->download->listData($condition);
			if(count($data['listdata']) == 0){
				show_404();
			}
		}

		$this->template->css(array(
			base_url('assets/inspinia/css/plugins/summernote/summernote'),
			base_url('assets/inspinia/css/plugins/summernote/summernote-bs3'),
			base_url('assets/inspinia/css/plugins/codemirror/codemirror'),
			base_url('assets/inspinia/css/plugins/codemirror/ambiance')
		));

		$data['crfdownload'] = $this->tokens->token('crfdownload');
		$this->template->backend('download/form',$data);
	}

	public function create(){

		if($this->tokens->verify('crfdownload')){
			$data = $this->_setDownload();
			$data['download_createby'] = $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['download_datecreate'] = date('Y-m-d H:i:s');
			$Id = $this->download->insertData($data);
			$result = array(
				'error' => false,
				'url' => site_url('manager/download/form/'.$Id)
			);
			echo json_encode($result);
		}else{
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' => "No tokens"
			);
			echo json_encode($result);
		}

	}

	public function update(){
		if($this->tokens->verify('crfdownload')){
			$data = $this->_setDownload();
			$data['download_id'] = $this->input->post('Id');
			$Id = $this->download->updateData($data);
			$result = array(
				'error' => false,
				'title' => "Update data completed",
				'msg' => ""
			);
			echo json_encode($result);
			die;
		}else{
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' => "No tokens"
			);
			echo json_encode($result);
		}
	}

	private function _setDownload(){
			return array(
				'download_type' => $this->input->post('Text_type'),
				'download_image' => $this->upfileimages('File_images'),
				'download_file' => $this->upfile('File_download'),
				'download_urlvideo' => $this->input->post('Text_urlvideo'),
				'download_title' => $this->input->post('Text_title'),
				'download_description' => $this->input->post('Text_detail'),
				'download_sort' => $this->input->post('Text_sort'),
				'download_editby' => $this->encryption->decrypt($this->input->cookie('sysn')),
				'download_lastedit' => date('Y-m-d H:i:s'),
				'download_show' => $this->input->post('Text_eye'),
				'download_status' => $this->input->post('Text_check')
			);
	}

	public function delete($Id){
		$data = array(
			'download_id' => $Id,
			'download_status' => 0,
			'download_editby' => $this->encryption->decrypt($this->input->cookie('sysn')),
			'download_lastedit' => date('Y-m-d H:i:s')
		);
		$this->download->updateData($data);
		header("location:".site_url('manager/download/index/'));
	}

	private function upfileimages($Fild_Name){
		$fileold = $this->input->post($Fild_Name.'_old');
		if(!empty($_FILES[$Fild_Name])){
			$new_name = time();
			$config['upload_path'] = './uploads/download/img';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = $new_name;
			$config['max_size']	= '3500';
			$this->load->library('upload', $config ,'upbanner');
			$this->upbanner->initialize($config);
			if ( ! $this->upbanner->do_upload($Fild_Name)){
				$result = array(
					'error' => true,
					'title' => "Error",
					'msg' => $this->upbanner->display_errors()
				);
				echo json_encode($result);
				die;
			}else{
				if(!empty($fileold)){
					@unlink($config['upload_path'].$fileold);
				}
				$img = $this->upbanner->data();
				return $img['file_name'];
			}
		}else{
			return $fileold;
		}
	}

	private function upfile($Fild_Name){
		$fileold = $this->input->post($Fild_Name.'_old');
		if(!empty($_FILES[$Fild_Name])){
			$new_name = time();
			$config['upload_path'] = './uploads/download/file';
			$config['allowed_types'] = '*';
			$config['file_name'] = $new_name;
			$config['max_size']	= '350000';
			$this->load->library('upload', $config ,'upbanner');
			$this->upbanner->initialize($config);
			if ( ! $this->upbanner->do_upload($Fild_Name)){
				$result = array(
					'error' => true,
					'title' => "Error",
					'msg' => $this->upbanner->display_errors()
				);
				echo json_encode($result);
				die;
			}else{
				if(!empty($fileold)){
					@unlink($config['upload_path'].$fileold);
				}
				$img = $this->upbanner->data();
				return $img['file_name'];
			}
		}else{
			return $fileold;
		}
	}

}
