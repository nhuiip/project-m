<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Detailorders extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->load->model("detailorders_model","detailorders");
	}

	public function index($id, $type){
        $data = array();

        $condition = array();
		$condition['fide']  = "*";
		$condition['where'] = array('orders_id' => $id);
        $listorder = $this->detailorders->listorder($condition);

        $condition = array();
		$condition['fide']  = "*";
		$condition['where'] = array('student_id' => $listorder[0]['student_id']);
        $liststudent = $this->detailorders->liststudent($condition);

        $condition = array();
		$condition['fide']  = "*";
		$condition['where'] = array('fac_id' => $liststudent[0]['fac_id']);
        $listfac = $this->detailorders->listfaculty($condition);
        
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_detailorders.orders_id' => $id);
		$condition['orderby'] = "tb_detailorders.product_id ASC";
        $data['listdatail'] = $this->detailorders->listdetail($condition);


        //getdata bill
        $data['orders_number']  = $listorder[0]['orders_number'];
        $data['orders_date']    = $listorder[0]['orders_date'];
        $data['orders_total']   = $listorder[0]['orders_total'];
        $data['student_id']     = $listorder[0]['student_id'];
        $data['fullname']       = $listorder[0]['name_title'].' '.$listorder[0]['student_fname'].' '.$listorder[0]['student_lname'];
        $data['dept_name']      = $liststudent[0]['dept_name'];
        $data['fac_name']       = $listfac[0]['fac_name'];
        $data['sex_name']       = $liststudent[0]['sex_name'];
        if($liststudent[0]['course_status'] == 1){
            $data['course_status'] = '4ปีปกติ';
        } elseif ($liststudent[0]['course_status'] == 2) {
            $data['course_status'] = '4ปีเทียบโอน';
        }

        $data['type'] = $type;
		$this->template->backend('orders/detailorders/main',$data);
	}
}
