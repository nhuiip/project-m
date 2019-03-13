<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pagecontents extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		// $this->lang->load(array('admin_page_lang','admin_form_lang'), 'english');
		$this->load->model("pagecontents_model","pagecontents");
		
	}

	public function index(){
		
		$data = array();

		//Data in case update
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('con_id' => 1);
		$data['listdata'] = $this->pagecontents->listData($condition);
		if(count($data['listdata']) == 0){
			show_404();
		}
	$this->template->css(array(
		base_url('assets/inspinia/css/plugins/summernote/summernote'),
		base_url('assets/inspinia/css/plugins/codemirror/codemirror'),
		base_url('assets/inspinia/css/plugins/codemirror/ambiance')
	));

	$data['con_id'] = $data['listdata'][0]['con_id'];
	$data['con_detail_th'] = $data['listdata'][0]['con_detail_th'];
	$this->template->backend('managepage/pagecontents/main',$data);
	}	

	public function form(){
		
			$data = array();

			//Data in case update
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('con_id' => 1);
			$data['listdata'] = $this->pagecontents->listData($condition);
			if(count($data['listdata']) == 0){
				show_404();
			}
		$this->template->css(array(
			base_url('assets/inspinia/css/plugins/summernote/summernote'),
			base_url('assets/inspinia/css/plugins/codemirror/codemirror'),
			base_url('assets/inspinia/css/plugins/codemirror/ambiance')
		));

		$data['con_id'] = $data['listdata'][0]['con_id'];
		$data['con_detail_th'] = $data['listdata'][0]['con_detail_th'];
		$data['crfcontents'] = $this->tokens->token('crfcontents');
		$this->template->backend('managepage/pagecontents/form',$data);
	}

	public function update(){

			if($this->tokens->verify('crfcontents')){
				$data = array();
				$data['con_id'] 			= $this->input->post('con_id');
				$data['con_detail_th'] 		= $this->input->post('con_detail_th');

				$this->pagecontents->updateData($data);
				$result = array(
					'error' => false,
					'title' => "แก้ไขข้อมูลเรียบร้อย",
					'url' => site_url('managepage/pagecontents/index/')
				);
				echo json_encode($result);
			}
		
	}

}
