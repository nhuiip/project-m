<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receipt extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("receipt_model","receipt");
		$this->load->helper('fileexist');
	}

	public function index($id){
		$data = array();

		// get datail orders
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_detailorders.orders_id' => $id);
		$data['listdatail'] = $this->receipt->listdetail($condition);

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('orders_id' => $id);
		$orders = $this->receipt->listorder($condition);

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_student.student_id' => $orders[0]['student_id']);
		$student = $this->receipt->liststudent($condition);

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('fac_id' => $student[0]['fac_id']);
		$faculty = $this->receipt->listfaculty($condition);


		//order
		$data['orders_id'] 		= $orders[0]['orders_id'];
		$data['orders_date'] 	= $orders[0]['orders_date'];
		$data['orders_total'] 	= $orders[0]['orders_total'];
		$data['orders_number'] 	= $orders[0]['orders_number'];

		//student
		$data['student_id']		= $student[0]['student_id'];
		$data['fullname']		= $student[0]['name_title'].' '.$student[0]['student_fname'].' '.$student[0]['student_lname'];
		$data['dept_name']		= $student[0]['dept_name'];
		$data['fac_name']		= $faculty[0]['fac_name'];
		$data['sex_name']		= $student[0]['sex_name'];
		if($student[0]['course_status'] == 1){
			$data['course_status'] = '4ปี ปกติ';
		} elseif($student[0]['course_status'] == 2){
			$data['course_status'] = '4ปี เทียบโอน';
		}
		$this->load->view('receipt/receipt',$data); 
	}
}
