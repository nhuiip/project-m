<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Detailpackage extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->load->model("detailpackage_model","detailpackage");
	}
	public function form($id){
		$data = array();
		//Data in case update
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_detailpackage.pack_id' => $id);
		$condition['orderby'] = "tb_detailpackage.product_id ASC";
		$data['listdetailpackage'] = $this->detailpackage->listdetailpackage($condition);

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('product_delete_status' => 1, 'type_id' => 1);
		$condition['orderby'] = "product_id ASC";
		$data['listproduct1'] = $this->detailpackage->listproduct($condition);

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('product_delete_status' => 1, 'type_id' => 2);
		$condition['orderby'] = "product_id ASC";
		$data['listproduct2'] = $this->detailpackage->listproduct($condition);

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('product_delete_status' => 1, 'type_id' => 3);
		$condition['orderby'] = "product_id ASC";
		$data['listproduct3'] = $this->detailpackage->listproduct($condition);

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_package.pack_id' => $id);
		$listpack = $this->detailpackage->listpackage($condition);


		$data['dept_id'] = $listpack[0]['dept_id'];
		$data['dept_name'] = $listpack[0]['dept_name'];
		$data['sex_name'] = $listpack[0]['sex_name'];
		if($listpack[0]['course_status'] == 1){
			$data['course_status'] = '4ปีปกติ';
		} elseif($listpack[0]['course_status'] == 2){
			$data['course_status'] = '4ปีเทียบโอน';
		}
		$data['pack_id'] = $id;
		$this->template->backend('package/detailpackage/form',$data);
	}

	//choose
	public function choose($packid, $productid){
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('product_id' => $productid);
		$listproduct = $this->detailpackage->listproduct($condition);
		if(isset($listproduct) && count($listproduct) != 0){
			foreach ($listproduct as $key => $value) {
				$total_price = $value['product_price'];
			}
		}
		$data = array(
			'pack_id' => $packid,
			'product_id' => $productid,
			'pieces' => 1,
			'total_price' => $total_price,
			'detail_lastedit_name' => $this->encryption->decrypt($this->input->cookie('sysn')),
			'detail_lastedit_date' => date('Y-m-d H:i:s')
		);
		$this->detailpackage->chooseData($data);
		header("location:".site_url('package/detailpackage/form/'.$packid));
	}

	//checkdelete
	public function checkchoose($packid, $productid){

		//listDetail
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_detailpackage.pack_id' => $packid, 'tb_detailpackage.product_id' => $productid);
		$listcheck = $this->detailpackage->listdetailpackage($condition);

		if(isset($listcheck) && count($listcheck) != 0 ){
			$result = array(
				'error' => true,
				'title' => "Error!",
				'msg' => "รายการข้อมูลนี้นี้มีอยู่แล้ว",
			);
			echo json_encode($result);
		} else {
			$result = array(
				'error' => false
			);
			echo json_encode($result);
		}

	}
	
	// update data
	public function update(){
		$pack_id 	= $this->input->post('pack_id');
		$product_id = $this->input->post('product_id');
		$pieces 	= $this->input->post('pieces');

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('product_id' => $product_id);
		$listproduct = $this->detailpackage->listproduct($condition);
		if(isset($listproduct) && count($listproduct) != 0){
			foreach ($listproduct as $key => $value) {
				$total_price = $value['product_price'] * $pieces;
			}
		}

		$data['pack_id'] 		= $pack_id;
		$data['product_id']    	= $product_id;
		$data['pieces'] 		= $pieces;
		$data['total_price'] 	= $total_price;
		$data['detail_lastedit_name'] 	= $this->encryption->decrypt($this->input->cookie('sysn'));
		$data['detail_lastedit_date']	= date('Y-m-d H:i:s');

		$this->detailpackage->updateData($data);
		$result = array(
			'error' => false,
			'title' => "แก้ไขข้อมูลเรียบร้อย",
			'url' => site_url('package/detailpackage/form/'.$pack_id)
		);
		echo json_encode($result);
	
		
	}

	//deleteData
	public function deleteData($packid, $productid){
		$data = array(
			'pack_id' => $packid,
			'product_id' => $productid,
		);
		$this->detailpackage->deleteData($data);
		header("location:".site_url('package/detailpackage/form/'.$packid));
	}
}
