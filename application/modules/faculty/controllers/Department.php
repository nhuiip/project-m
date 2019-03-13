<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Department extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->load->model("department_model","department");
		
	}
	public function form($facid, $id = ""){
		$data = array();
		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('dept_id' => $id, 'dept_delete_status' => 1);
			$data['listdept'] = $this->department->listdept($condition);
		}
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('fac_id' => $facid, 'fac_delete_status' => 1);
		$listfac = $this->department->listfac($condition);
		if(isset($listfac) && count($listfac) != 0){
			foreach ($listfac as $key => $value) {
				$fac_name = $value['fac_name'];
			}
		}
		$data['facid'] = $facid;
		$data['facname'] = $fac_name;
		// Language
		$data['crfdept'] = $this->tokens->token('crfdept');
		$this->template->backend('faculty/department/form',$data);
	}
	
	// insert data
	public function create(){
		$fac_id = $this->input->post('fac_id');
		$dept_name = $this->input->post('dept_name');
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('dept_name' => $dept_name, 'fac_id' => $fac_id, 'dept_delete_status' => 1);
		$listdept = $this->department->listdept($condition);
		if(count($listdept) != 0){
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' => "มีข้อมูลสาขานี้อยู่แล้ว"
			);
			echo json_encode($result);
		} else {
			if($this->tokens->verify('crfdept')){
				$data = array();
				$data['dept_name']      		= $this->input->post('dept_name');
				$data['fac_id']					= $this->input->post('fac_id');
				$data['dept_lastedit_name'] 	= $this->encryption->decrypt($this->input->cookie('sysn'));
				$data['dept_lastedit_date']		= date('Y-m-d H:i:s');
				$data['dept_delete_status']  	= 1;

				$Id = $this->department->insertData($data);			

				$result = array(
					'error' => false,
					'title' => "เพิ่มข้อมูลเรียบร้อย",
					'url' => site_url('faculty/department/form/'.$this->input->post('fac_id').'/'.$Id)
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
	
	// update data
	public function update(){
		$fac_id = $this->input->post('fac_id');
		$dept_name = $this->input->post('dept_name');
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('dept_name' => $dept_name, 'fac_id' => $fac_id, 'dept_delete_status' => 1);
		$listdept = $this->department->listdept($condition);
		if(count($listdept) != 0){
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' => "มีข้อมูลสาขานี้อยู่แล้ว"
			);
			echo json_encode($result);
		} else {
			if($this->tokens->verify('crfdept')){
				// echo 'in';
				// die;
				$data['dept_id'] 		= $this->input->post('Id');
				$data['dept_name']    	= $this->input->post('dept_name');
				$data['fac_id'] 		= $this->input->post('fac_id');
				$data['dept_lastedit_name'] = $this->encryption->decrypt($this->input->cookie('sysn'));
				$data['dept_lastedit_date']	= date('Y-m-d H:i:s');

				$this->department->updateData($data);
				$result = array(
					'error' => false,
					'title' => "แก้ไขข้อมูลเรียบร้อย",
					'url' => site_url('faculty/department/form/'.$this->input->post('fac_id').'/'.$this->input->post('Id'))
				);
				echo json_encode($result);
			}
		}
	}

	//check-delete
	public function checkdelete($id){

		$condition = array();
		$condition['fide'] = "tb_department.dept_id";
		$condition['where'] = array('tb_package.dept_id' => $id, 'pack_delete_status' => 1);
		$checkpackage = $this->department->listpackage($condition);

		if(isset($checkpackage) && count($checkpackage) != 0 ){
			$result = array(
				'error' => true,
				'title' => "ไม่สามารถลบได้!",
				'msg' => "ยังมีข้อมูลชุดเครื่องแบบในสาขานี้อยู่ การลบข้อมูลอาจจะทำให้ข้อมูลที่เหลือแสดงผลผิดพลาด",
			);
			echo json_encode($result);
		} else {
			$result = array(
				'error' => false
			);
			echo json_encode($result);
		}
	}

	//delete สาขา
	public function delete($id, $fac_id){
		$data = array(
			'dept_id' => $id,
			'dept_delete_status' => 0,
			'dept_lastedit_name' => $this->encryption->decrypt($this->input->cookie('sysn')),
			'dept_lastedit_date' => date('Y-m-d H:i:s'),
		);
		$this->department->updateData($data);
		header("location:".site_url('faculty/faculty/form/'.$fac_id));
	}
}
