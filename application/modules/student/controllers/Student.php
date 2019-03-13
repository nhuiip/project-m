<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->load->model("student_model","student");
		$this->load->library('csvimport');
		
	}

	public function indexfac(){
		$data = array();
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('fac_delete_status' => 1);
		$condition['orderby'] = "fac_id ASC";
		$data['listfac'] = $this->student->listfac($condition);
		$this->template->backend('student/student/mainfac',$data);
	}

	public function indexdept($id){

		$data = array();
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('fac_id' => $id, 'dept_delete_status' => 1);
		$condition['orderby'] = "dept_id ASC";
		$data['listdept'] = $this->student->listdept($condition);

		$this->template->backend('student/student/maindept',$data);
	}

	public function index($id, $course_status){

		$data = array();
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_student.dept_id' => $id, 'course_status' => $course_status);
		$condition['orderby'] = "tb_student.student_id ASC";
		$data['liststudent'] = $this->student->liststudent($condition);

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('dept_id' => $id);
		$listdept = $this->student->listdept($condition);

		$data['dept_id'] = $id;
		$data['dept_name'] = $listdept[0]['dept_name'];
		$data['fac_id'] = $listdept[0]['fac_id'];
		$data['course'] = $course_status;
		$this->template->backend('student/student/main',$data);
	}

	public function form($deptid, $course_status, $id = ""){

		$data = array();
		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('tb_student.student_id' => $id);
			$data['liststudent'] = $this->student->liststudent($condition);
		}
		$condition = array();
		$condition['fide'] = "*";
		$condition['orderby'] = "sex_id ASC";
		$data['listsex'] = $this->student->listsex($condition);

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('dept_id' => $deptid);
		$listdept = $this->student->listdept($condition);
		if(isset($listdept) && count($listdept) != 0){
			foreach ($listdept as $key => $value) {
				$dept_id = $value['dept_id'];
				$dept_name = $value['dept_name'];
			}
		}

		$data['crfstudent'] = $this->tokens->token('crfstudent');
		$data['deptid'] = $dept_id;
		$data['deptname'] = $dept_name;
		$data['coursestatus'] = $course_status;
		$this->template->backend('student/student/form',$data);
	}

	public function create(){

		$student_id 	= $this->input->post('student_id');
		$name_title 	= $this->input->post('name_title');
		$student_fname 	= $this->input->post('student_fname');
		$student_lname 	= $this->input->post('student_lname');
		$dept_id 		= $this->input->post('dept_id');
		$sex_id 		= $this->input->post('sex_id');
		$course_status 	= $this->input->post('course_status');

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_student.student_id' => $student_id);
		$liststudent = $this->student->liststudent($condition);
		if(count($liststudent) != 0){
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' => "มีข้อมูลนี้อยู่แล้ว"
			);
			echo json_encode($result);
		} else {
			if($this->tokens->verify('crfstudent')){
				$data = array();
				$data['student_id']      	= $student_id;
				$data['name_title']      	= $name_title;
				$data['student_fname']     	= $student_fname;
				$data['student_lname']      = $student_lname;
				$data['dept_id']      		= $dept_id;
				$data['sex_id']      		= $sex_id;
				$data['course_status']     	= $course_status;

				$this->student->insertData($data);
				$result = array(
					'error' => false,
					'title' => "เพิ่มข้อมูลเรียบร้อย",
					'url' => site_url('student/student/form/'.$dept_id.'/'.$course_status.'/'.$student_id)
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

		if($this->tokens->verify('crfstudent')){

				$data['student_id']      	= $this->input->post('student_id');
				$data['name_title']      	= $this->input->post('name_title');
				$data['student_fname']     	= $this->input->post('student_fname');
				$data['student_lname']      = $this->input->post('student_lname');
				$data['dept_id']      		= $this->input->post('dept_id');
				$data['sex_id']      		= $this->input->post('sex_id');
				$data['course_status']     	= $this->input->post('course_status');

			$this->student->updateData($data);
			$result = array(
				'error' => false,
				'title' => "แก้ไขข้อมูลเรียบร้อย",
				'url' 	=> site_url('student/student/form/'.$this->input->post('dept_id').'/'.$this->input->post('course_status').'/'.$this->input->post('student_id'))
			);
			echo json_encode($result);
		}
	}

	public function import(){
		$file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
		$data = array();
		for($i=0;$i < count($file_data);$i++){
			$data['student_id'] 	= $file_data[$i]['studentid'];
			$data['name_title'] 	= $file_data[$i]['nametitle'];
			$data['student_fname'] 	= $file_data[$i]['fname'];
			$data['student_lname'] 	= $file_data[$i]['lname'];
			$data['dept_id']      	= $this->input->post('dept_id');
			$data['sex_id']      	= $file_data[$i]['sex'];
			$data['course_status']  = $this->input->post('course_status');

			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('tb_student.student_id' => $file_data[$i]['studentid']);
			$liststudent = $this->student->liststudent($condition);

			if(count($liststudent) == 0){
				$this->student->insertData($data);
			}
		}
		$result = array(
			'error' => false,
			'title' => "เพิ่มข้อมูลเรียบร้อย",
			'url' => site_url('student/student/index/'.$this->input->post('dept_id').'/'.$this->input->post('course_status'))
		);
		echo json_encode($result);
	}

	public function mutidelete($dept_id, $course){

		if($this->input->post('select') != ''){
			$student_id = implode(",", $this->input->post('select'));
			$this->student->mutidelete($student_id);
			header("location:".site_url('student/student/index/'.$dept_id.'/'.$course));
		} else {
			header("location:".site_url('student/student/index/'.$dept_id.'/'.$course));
		}
	}
}
