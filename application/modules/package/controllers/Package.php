<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Package extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->load->model("package_model","package");
		
	}

	public function indexfac(){
		$data = array();

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('fac_delete_status' => 1);
		$condition['orderby'] = "fac_id ASC";
		$data['listfac'] = $this->package->listfac($condition);

		$this->template->backend('package/package/mainfac',$data);
	}

	public function indexdept($id){
		$data = array();

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('fac_id' => $id, 'dept_delete_status' => 1);
		$condition['orderby'] = "dept_id ASC";
		$data['listdept'] = $this->package->listdept($condition);

		$this->template->backend('package/package/maindept',$data);
	}
	public function index($id){
		$data = array();

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_package.dept_id' => $id, 'pack_delete_status' => 1);
		$condition['orderby'] = "tb_package.pack_id ASC";
		$data['listpackage'] = $this->package->listpackage($condition);

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('dept_id' => $id);
		$listdept = $this->package->listdept($condition);
		if(isset($listdept) && count($listdept) != 0){
			foreach ($listdept as $key => $value) {
				$fac_id = $value['fac_id'];
			}
		}

		$data['deptid'] = $id;
		$data['facid'] = $fac_id;
		$this->template->backend('package/package/main',$data);
	}

	public function form($deptid, $id = ""){
		$data = array();
		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('tb_package.dept_id' => $deptid, 'tb_package.pack_id' => $id);
			$data['listpackage'] = $this->package->listpackage($condition);
		}
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('dept_id' => $deptid);
		$listdept = $this->package->listdept($condition);
		if(isset($listdept) && count($listdept) != 0){
			foreach ($listdept as $key => $value) {
				$dept_id = $value['dept_id'];
				$dept_name = $value['dept_name'];
			}
		}

		$condition = array();
		$condition['fide'] = "*";
		$condition['orderby'] = "sex_id ASC";
		$data['listsex'] = $this->package->listsex($condition);

		$data['crfpackage'] = $this->tokens->token('crfpackage');
		$data['deptid'] = $dept_id;
		$data['deptname'] = $dept_name;
		$this->template->backend('package/package/form',$data);
	}

	public function create(){
		$dept_id = $this->input->post('dept_id');
		$sex_id = $this->input->post('sex_id');
		$course_status = $this->input->post('course_status');
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_package.dept_id' => $dept_id, 'tb_package.sex_id' => $sex_id,
		'tb_package.course_status' => $course_status, 'tb_package.pack_delete_status' => 1);
		$listpackage = $this->package->listpackage($condition);
		if(count($listpackage) != 0){
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' => "มีข้อมูลนี้อยู่แล้ว"
			);
			echo json_encode($result);
		} else {
			if($this->tokens->verify('crfpackage')){
				$data = array();
				$data['dept_id']      		= $dept_id;
				$data['sex_id']      		= $sex_id;
				$data['course_status']     	= $course_status;
				$data['pack_lastedit_name'] = $this->encryption->decrypt($this->input->cookie('sysn'));
				$data['pack_lastedit_date']	= date('Y-m-d H:i:s');
				$data['pack_delete_status'] = 1;

				$Id = $this->package->insertData($data);
				$result = array(
					'error' => false,
					'title' => "เพิ่มข้อมูลเรียบร้อย",
					'url' => site_url('package/package/form/'.$dept_id.'/'.$Id)
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
	public function update(){
		$dept_id = $this->input->post('dept_id');
		$sex_id = $this->input->post('sex_id');
		$course_status = $this->input->post('course_status');
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_package.dept_id' => $dept_id, 'tb_package.sex_id' => $sex_id,
		'tb_package.course_status' => $course_status, 'tb_package.pack_delete_status' => 1);
		$listpackage = $this->package->listpackage($condition);
		if(count($listpackage) != 0){
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' => "มีข้อมูลนี้อยู่แล้ว"
			);
			echo json_encode($result);
		} else {
			if($this->tokens->verify('crfpackage')){
				$data['pack_id'] 			= $this->input->post('Id');
				$data['sex_id']      		= $sex_id;
				$data['course_status']     	= $course_status;
				$data['pack_lastedit_name'] = $this->encryption->decrypt($this->input->cookie('sysn'));
				$data['pack_lastedit_date']	= date('Y-m-d H:i:s');
				$data['pack_delete_status'] = 1;
				
				$this->package->updateData($data);
				$result = array(
					'error' => false,
					'title' => "แก้ไขข้อมูลเรียบร้อย",
					'url' => site_url('package/package/form/'.$dept_id.'/'.$this->input->post('Id'))
				);
				echo json_encode($result);
			}
		}
	}

	// delete
	public function delete($id, $dept_id){

		$data = array(
			'pack_id' => $id,
			'pack_delete_status' => 0,
			'pack_lastedit_name' => $this->encryption->decrypt($this->input->cookie('sysn')),
			'pack_lastedit_date' => date('Y-m-d H:i:s'),
		);
		$this->package->updateData($data);
		header("location:".site_url('package/package/index/'.$dept_id));
	}
}
