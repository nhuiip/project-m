<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("main_model","main");
		$this->load->helper('fileexist');
	}

	public function pageintor()
    {
        $data = array();
        $condition = array();
        $condition['fide'] = "*";
        $condition['where'] = array('intro_show' => 1);
        $data['listdata'] = $this->main->listIntor($condition);
        $this->load->view('main/intor', $data);
    }

	public function index($student_id = ""){
		$data = array();

		// get detail main page
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('con_id' => 1);
		$data['listdata'] = $this->main->listData($condition);

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_student.student_id' => $student_id);
		$data['liststudent'] = $this->main->liststudent($condition);

		if(count($data['liststudent']) != 0){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array(
				'tb_package.dept_id' 		=> $data['liststudent'][0]['dept_id'],
				'tb_package.sex_id' 		=> $data['liststudent'][0]['sex_id'],
				'tb_package.course_status' 	=> $data['liststudent'][0]['course_status']
			);
			$data['listpackage'] = $this->main->listpackage($condition);
	
			if(count($data['listpackage']) != 0){
				$condition = array();
				$condition['fide'] = "*";
				$condition['where'] = array('tb_detailpackage.pack_id' => $data['listpackage'][0]['pack_id']);
				$data['listdetailpack'] = $this->main->listdetailpack($condition);
				
				if(count($data['listdetailpack']) != 0) {
					$total = array();
					for($i = 0;$i < count($data['listdetailpack']);$i++){
						$total[$i] = $data['listdetailpack'][$i]['total_price'];
					}
					$orders_total = array_sum($total);
				} 
			} else {
				$data['typeorder'] = 1;
			}

		}

		$this->template->js(array(
			base_url('assets/canvas/js/lib/plugins/validate/jquery.validate.min'),
			base_url('assets/canvas/js/methods/app/function'),
		));

		if(count($data['liststudent']) != 0 && count($data['listpackage']) != 0 && count($data['listdetailpack']) != 0){
			if($data['liststudent'][0]['course_status'] == 1){
				$course_status = '4ปีปกติ';
			} else {
				$course_status = '4ปีเทียบโอน';
			}
			$data['student_id'] 	= $data['liststudent'][0]['student_id'];
			$data['fullname'] 		= $data['liststudent'][0]['name_title'].' '.$data['liststudent'][0]['student_fname'].' '.$data['liststudent'][0]['student_lname'];
			$data['dept_name'] 		= $data['liststudent'][0]['dept_name'];
			$data['course_status'] 	= $course_status;
			$data['sex_name'] 		= $data['liststudent'][0]['sex_name'];
			$data['orders_total']	= $orders_total;

			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('student_id' => $student_id);
			$statusorder = $this->main->listorder($condition);
				if(count($statusorder) != 0){
					$data['typeorder'] = 0;
				}
		}

		$data['crforders'] = $this->tokens->token('crforders');
		$this->template->frontend('main/main',$data);
	}

	public function finddata(){
        $studentid = $this->input->post('student_id');
        $condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_student.student_id' => $studentid);
		$liststudent = $this->main->liststudent($condition);
        if(count($liststudent) != 0){
			$result = array(
				'error' => false,
				'title' => "Completed!!",
				'msg' => "",
				'url' => site_url('main/index/'.$studentid)
			);
				echo json_encode($result);
		} else {
			$result = array(
				'error' => true,
				'title' => "ผิดพลาด",
				'msg' => "ไม่พบรหัสนักศึกษาที่คุณค้นหา!! กรุณาติดต่อเจ้าหน้าที่.",
				'url' => site_url('main/index/')
			);
				echo json_encode($result);
		}
	}
	
	public function addorder(){
		if (in_array("", $this->input->post('size_id'))) {
			$result = array(
				'error' => true,
				'title' => "ผิดผลาด",
				'msg' => "กรุณาเลือกขนาดเครื่องแบบให้ครบถ้วน"
			);
			echo json_encode($result);
		} else {
			if($this->tokens->verify('crforders')){
				$data 							= array();
				$data['student_id'] 			= $this->input->post('student_id');
				$data['orders_date'] 			= date('Y-m-d');
				$data['orders_total'] 			= $this->input->post('orders_total');
				$data['orders_number'] 			= "RMUTR-".time();
				$data['orders_status'] 			= 1;
				$data['orders_type'] 			= 1;
				$data['orders_delete_status'] 	= 1;
	
				$orders_id = $this->main->insertOrders($data);
	
				$details = array();
				for($i = 0;$i < count($this->input->post('product_id'));$i++){
					$details['orders_id'] 	= $orders_id;
					$details['product_id'] 	= $this->input->post('product_id')[$i];
					$details['size_id'] 	= $this->input->post('size_id')[$i];
					$details['pieces'] 		= $this->input->post('pieces')[$i];
					$details['price'] 		= $this->input->post('price')[$i];
	
					$this->main->insertDetail($details);
				}
	
				$stock = array();
				for($i = 0;$i < count($this->input->post('product_id'));$i++){
	
					$condition = array();
					$condition['fide'] = "amount";
					$condition['where'] = array(
						'product_id' => $this->input->post('product_id')[$i], 
						'size_id'	 => $this->input->post('size_id')[$i]
					);
					$liststock = $this->main->liststock($condition);
					if(count($liststock) != 0){
						$stock['product_id'] 	= $this->input->post('product_id')[$i];
						$stock['size_id'] 		= $this->input->post('size_id')[$i];
						$stock['amount']		= $liststock[0]['amount'] - $this->input->post('pieces')[$i];
						$this->main->updatestock($stock);
					}
				}
	
				$result = array(
					'error' => false,
					'url' => site_url('receipt/index/'.$orders_id)
				);
				echo json_encode($result);
			} else {
				$result = array(
					'error' => true,
					'title' => "Error",
					'msg' => "ผิดพลาด"
				);
				echo json_encode($result);
			}
		}
	}
}
