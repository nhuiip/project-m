<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Intro extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		// $this->lang->load(array('admin_page_lang','admin_form_lang'), 'english');
		$this->load->model("intro_model","intro");
		
	}

	public function index(){
		
		$data = array();

		//Data in case update
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('intro_id' => 1);
		$data['listdata'] = $this->intro->listData($condition);
		if(count($data['listdata']) == 0){
			show_404();
		}
	$this->template->css(array(
		base_url('assets/inspinia/css/plugins/summernote/summernote'),
		base_url('assets/inspinia/css/plugins/codemirror/codemirror'),
		base_url('assets/inspinia/css/plugins/codemirror/ambiance')
	));

	$data['intro_id'] = $data['listdata'][0]['intro_id'];
	$data['intro_content'] = $data['listdata'][0]['intro_content'];
	$data['intro_show'] = $data['listdata'][0]['intro_show'];
	$this->template->backend('managepage/intro/main',$data);
	}	

	public function form(){
		
			$data = array();

			//Data in case update
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('intro_id' => 1);
			$data['listdata'] = $this->intro->listData($condition);
			if(count($data['listdata']) == 0){
				show_404();
			}
		$this->template->css(array(
			base_url('assets/inspinia/css/plugins/summernote/summernote'),
			base_url('assets/inspinia/css/plugins/codemirror/codemirror'),
			base_url('assets/inspinia/css/plugins/codemirror/ambiance')
		));

		$data['intro_id'] = $data['listdata'][0]['intro_id'];
		$data['intro_content'] = $data['listdata'][0]['intro_content'];
		$data['crfcontents'] = $this->tokens->token('crfcontents');
		$this->template->backend('managepage/intro/form',$data);
	}

	public function update(){
		
			if($this->tokens->verify('crfcontents')){
				
				$data['intro_id'] 				= $this->input->post('intro_id');
				$data['intro_content'] 			= $this->input->post('intro_content');

				$this->intro->updateData($data);
				$result = array(
					'error' => false,
					'title' => "แก้ไขข้อมูลเรียบร้อย",
					'url' => site_url('managepage/intro/index')
				);
				echo json_encode($result);
			}
		
	}

	public function hidedata(){
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('intro_id' => 1);
		$data['listdata'] = $this->intro->listData($condition);
		if(count($data['listdata']) == 0){
			show_404();
		}
		
		if($data['listdata'][0]['intro_show'] == 1){
			$data = array(
				'intro_id' => 1,
				'intro_show' => 0
			);
		} else {
			$data = array(
				'intro_id' => 1,
				'intro_show' => 1
			);
		}
		
		$this->intro->updateData($data);
		header("location:".site_url('managepage/intro/index'));
	}

}
