<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Filecontent extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->lang->load(array('admin_page_lang','admin_form_lang'), 'english');
		$this->load->model("Filecontent_model","filecontent");
	}

	public function index($typeFile){
		if($typeFile != 1 or $typeFile != 2 or $typeFile != 3 or $typeFile != 4){
			$data = array();
			$condition = array();
			$condition['fide'] = "*";
			if($typeFile == 1){
				$condition['where'] = array('regu_status !=' => 0,'regu_type' => $typeFile);
			}else{
				$condition['where'] = array(
					'regu_status !=' => 0,
					'regu_type !=' => 1
				);
			}
			$condition['orderby'] = "regu_status DESC,regu_lastedit DESC";
			$data['listdata'] = $this->filecontent->listData($condition);
			$data['typeFile'] = $typeFile;
			$this->template->backend('filecontent/main',$data);
		}else{
			show_404();
		}
	}

	public function form($type,$id = ""){
		$data = array();

		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('regu_id' => $id, 'regu_status !=' => 0);
			$data['listdata'] = $this->filecontent->listData($condition);
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

		$data['crffilecontent'] = $this->tokens->token('crffilecontent');
		$data['typeFile'] = $type;
		$this->template->backend('filecontent/form',$data);

	}

	public function create(){

		if($this->tokens->verify('crffilecontent')){
			$data = $this->_setValable();
			$data['regu_createby'] = $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['regu_datecreate'] = date('Y-m-d H:i:s');
			$Id = $this->filecontent->insertData($data);
			$type = $this->input->post('Text_type');
			$result = array(
				'error' => false,
				'url' => site_url('manager/filecontent/form/'.$type."/".$Id)
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
		if($this->tokens->verify('crffilecontent')){
			$data = $this->_setValable();
			$data['regu_id'] = $this->input->post('Id');
			$Id = $this->filecontent->updateData($data);
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

	private function _setValable(){
			return array(
				'regu_type' => $this->input->post('Text_type'),
				'regu_name_th' => $this->input->post('Text_nameTH'),
				'regu_name_en' => $this->input->post('Text_nameEN'),
				'regu_file' => $this->upfile('File_regu'),
				'regu_sort' => $this->input->post('Text_sort'),
				'regu_editby' => $this->encryption->decrypt($this->input->cookie('sysn')),
				'regu_lastedit' => date('Y-m-d H:i:s'),
				'regu_show' => $this->input->post('Text_eye'),
				'regu_status' => $this->input->post('Text_check')
			);
	}

	public function delete($Id){
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('regu_id' => $Id, 'regu_status !=' => 0);
		$data['listdata'] = $this->filecontent->listData($condition);
		$dataUpdate = array(
			'regu_id' => $Id,
			'regu_status' => 0,
			'regu_editby' => $this->encryption->decrypt($this->input->cookie('sysn')),
			'regu_lastedit' => date('Y-m-d H:i:s')
		);
		$this->filecontent->updateData($dataUpdate);
		header("location:".site_url('manager/filecontent/index/'.$data['listdata'][0]['regu_type']));
	}

	private function upfile($Fild_Name){
		$fileold = $this->input->post($Fild_Name.'_old');
		if(!empty($_FILES[$Fild_Name])){
			$new_name = time();
			$config['upload_path'] = './uploads/fileregulation';
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
