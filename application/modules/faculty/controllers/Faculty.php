<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Faculty extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->load->model("faculty_model","faculty");
	}

	public function index(){
		$data = array();

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('fac_delete_status' => 1);
		$condition['orderby'] = "fac_id ASC";
		$data['listfac'] = $this->faculty->listfac($condition);

		$this->template->backend('faculty/faculty/main',$data);
	}

	public function form($id = ""){

		$data = array();
		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('fac_id' => $id, 'fac_delete_status' => 1);
			$data['listfac'] = $this->faculty->listfac($condition);
			if(count($data['listfac']) == 0){
				show_404();
			}

			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('fac_id' => $id, 'dept_delete_status' => 1);
			$condition['orderby'] = "dept_id ASC";
			$data['listdept'] = $this->faculty->listdept($condition);

		}
		$data['crffaculty'] = $this->tokens->token('crffaculty');
		$this->template->backend('faculty/faculty/form',$data);
	}

	public function create(){
		// echo 'in';
		// die;
		$fac_name = $this->input->post('fac_name');
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('fac_name' => $fac_name, 'fac_delete_status' => 1);
		$condition['orderby'] = "fac_id ASC";
		$listfac = $this->faculty->listfac($condition);
		if(count($listfac) != 0){
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' => "มีข้อมูลคณะนี้อยู่แล้ว"
			);
			echo json_encode($result);
		} else {
			if($this->tokens->verify('crffaculty')){
					$data = array();
					$data['fac_name']      		= $this->input->post('fac_name');
					$data['fac_lastedit_name'] 	= $this->encryption->decrypt($this->input->cookie('sysn'));
					$data['fac_lastedit_date']	= date('Y-m-d H:i:s');
					$data['fac_delete_status']  = 1;

					$Id = $this->faculty->insertData($data);
				$result = array(
					'error' => false,
					'title' => "เพิ่มข้อมูลเรียบร้อย",
					'url' => site_url('faculty/faculty/form/'.$Id)
				);
				echo json_encode($result);
			} else {
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' => "No tokens"
			);
			echo json_encode($result);
			}
		}
	}
	//edit
	public function update(){
		$fac_name = $this->input->post('fac_name');
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('fac_name' => $fac_name, 'fac_delete_status' => 1);
		$condition['orderby'] = "fac_id ASC";
		$listfac = $this->faculty->listfac($condition);
		if(count($listfac) != 0){
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' => "มีข้อมูลคณะนี้อยู่แล้ว"
			);
			echo json_encode($result);
		} else {
			if($this->tokens->verify('crffaculty')){
				$data['fac_id'] = $this->input->post('Id');
				$data['fac_name']    = $this->input->post('fac_name');
				$data['fac_lastedit_name'] 	= $this->encryption->decrypt($this->input->cookie('sysn'));
				$data['fac_lastedit_date']	= date('Y-m-d H:i:s');

				$this->faculty->updateData($data);
				$result = array(
					'error' => false,
					'title' => "แก้ไขข้อมูลเรียบร้อย",
					'url' => site_url('faculty/faculty/form/'.$this->input->post('Id'))
				);
				echo json_encode($result);
			}
		}
	}

	//check-delete
	public function checkdelete($id){

		$condition = array();
		$condition['fide'] = "tb_department.fac_id";
		$condition['where'] = array('pack_delete_status' => 1);
		$checkpackage = $this->faculty->listpackage($condition);

		$arrfac = array();
		for($i = 0;$i < count($checkpackage);$i++){
			$arrfac[$i] = $checkpackage[$i]['fac_id'];
		}

		if(in_array($id, $arrfac)){
			$result = array(
				'error' => true,
				'title' => "ไม่สามารถลบได้!",
				'msg' => "ยังมีข้อมูลชุดเครื่องแบบในคณะนี้อยู่ การลบข้อมูลอาจจะทำให้ข้อมูลที่เหลือแสดงผลผิดพลาด",
			);
			echo json_encode($result);
		} else {
			$result = array(
				'error' => false
			);
			echo json_encode($result);
		}
	}

	//delete คณะ
	public function delete($id){

		$data = array(
			'fac_id' => $id,
			'fac_delete_status' => 0,
			'fac_lastedit_name' => $this->encryption->decrypt($this->input->cookie('sysn')),
			'fac_lastedit_date' => date('Y-m-d H:i:s'),
		);
		$this->faculty->updateData($data);
		header("location:".site_url('faculty/faculty/index'));
	}
}
