<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Size extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->load->model("size_model","size");
		
	}

	public function index(){
		$data = array();

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('size_status' => 1, 'size_delete_status' => 1);
		$condition['orderby'] = "size_id ASC";
		$data['listsize1'] = $this->size->listsize($condition);

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('size_status' => 2, 'size_delete_status' => 1);
		$condition['orderby'] = "size_id ASC";
		$data['listsize2'] = $this->size->listsize($condition);


		$this->template->backend('product/size/main',$data);
	}

	public function form($size_status, $id = ""){

		$data = array();
		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('size_id' => $id, 'size_delete_status' => 1);
			$data['listsize'] = $this->size->listsize($condition);
			if(count($data['listsize']) == 0){
				show_404();
			}
		}
		$data['sizestatus'] = $size_status;
		$data['crfsize'] = $this->tokens->token('crfsize');
		$this->template->backend('product/size/form',$data);
	}

	public function create(){
		$size_name = $this->input->post('size_name');
    $size_status = $this->input->post('size_status');
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('size_name' => $size_name, 'size_status' => $size_status, 'size_delete_status' => 1);
		$listsize = $this->size->listsize($condition);
		if(count($listsize) != 0){
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' => "มีข้อมูลรายการนี้อยู่แล้ว"
			);
			echo json_encode($result);
		} else {
			if($this->tokens->verify('crfsize')){
				$data = array();
				$data['size_name']      		= $this->input->post('size_name');
				$data['size_status']      		= $this->input->post('size_status');
				$data['size_lastedit_name'] 	= $this->encryption->decrypt($this->input->cookie('sysn'));
				$data['size_lastedit_date']	    = date('Y-m-d H:i:s');
				$data['size_delete_status']     = 1;

				$Id = $this->size->insertData($data);
				$result = array(
					'error' => false,
					'title' => "เพิ่มข้อมูลเรียบร้อย",
					'url' 	=> site_url('product/size/form/'.$this->input->post('size_status').'/'.$Id)
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
		$size_name = $this->input->post('size_name');
    $size_status = $this->input->post('size_status');
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('size_name' => $size_name, 'size_status' => $size_status, 'size_delete_status' => 1);
		$listsize = $this->size->listsize($condition);
		if(count($listsize) != 0){
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' => "มีข้อมูลรายการนี้อยู่แล้ว"
			);
			echo json_encode($result);
		} else {
			if($this->tokens->verify('crfsize')){
				$data['size_id'] 			    = $this->input->post('Id');
				$data['size_name']      		= $this->input->post('size_name');
				$data['size_status']      		= $this->input->post('size_status');
				$data['size_lastedit_name'] 	= $this->encryption->decrypt($this->input->cookie('sysn'));
				$data['size_lastedit_date']	    = date('Y-m-d H:i:s');
				$data['size_delete_status']     = 1;

				$this->size->updateData($data);
				$result = array(
					'error' => false,
					'title' => "แก้ไขข้อมูลเรียบร้อย",
					'url' => site_url('product/size/form/'.$this->input->post('size_status').'/'.$this->input->post('Id'))
				);
				echo json_encode($result);
			}
		}
	}

	//check-delete
	public function checkdelete($id){

		//check stock
		$condition = array();
		$condition['fide'] = "size_id";
		$condition['where'] = array('size_id' => $id, 'delete_status' => 1);
		$checkstock = $this->size->liststock($condition);

		//check detail
		$condition = array();
		$condition['fide'] = "size_id";
		$condition['where'] = array('size_id' => $id);
		$checkdetailOD = $this->size->listdetail($condition);
		
		if(isset($checkstock) && count($checkstock) != 0 ){
			$result = array(
				'error' => true,
				'title' => "ไม่สามารถลบได้!",
				'msg' 	=> "ยังมีข้อมูลรายการนี้อยู่ในสต็อกเครื่องแบบ การลบข้อมูลอาจจะทำให้ข้อมูลที่เหลือแสดงผลผิดพลาด",
			);
			echo json_encode($result);
		} elseif(isset($checkdetailOD) && count($checkdetailOD) != 0 ){
			$result = array(
				'error' => true,
				'title' => "ไม่สามารถลบได้!",
				'msg' => "ยังมีข้อมูลรายการนี้อยู่ในใบสั่งซื้อ การลบข้อมูลอาจจะทำให้ข้อมูลที่เหลือแสดงผลผิดพลาด",
			);
			echo json_encode($result);
		} else {
			$result = array(
				'error' => false
			);
			echo json_encode($result);
		}
	}

	// delete คณะ
	public function delete($id){

		$data = array(
			'size_id' => $id,
			'size_delete_status' => 0,
			'size_lastedit_name' => $this->encryption->decrypt($this->input->cookie('sysn')),
			'size_lastedit_date' => date('Y-m-d H:i:s'),
		);
		$this->size->updateData($data);
		header("location:".site_url('product/size/index'));
	}
}
