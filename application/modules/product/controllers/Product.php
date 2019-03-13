<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->load->model("product_model","product");
	}

	public function index($typeid){
		$data = array();

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('type_id' => $typeid, 'product_delete_status' => 1);
		$condition['orderby'] = "product_id ASC";
		$data['listproduct'] = $this->product->listproduct($condition);

		$data['typeproduct'] = $typeid;
		$this->template->backend('product/product/main',$data);
	}

	public function form($typeid, $id = ""){

		$data = array();
		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('product_id' => $id, 'product_delete_status' => 1);
			$data['listproduct'] = $this->product->listproduct($condition);
			if(count($data['listproduct']) == 0){
				show_404();
			}
			if($typeid == 2){
				$condition = array();
				$condition['fide'] = "amount";
				$condition['where'] = array('product_id' => $id, 'size_id' => 1);
				$data['amount'] = $this->product->amount($condition);
				$data['amount'] = $data['amount'][0]['amount'];
			}

		}
		
		$data['typeid'] = $typeid;
		$data['crfproduct'] = $this->tokens->token('crfproduct');
		$this->template->backend('product/product/form',$data);
	}


	public function create(){
		$type_id 		= $this->input->post('type_id');
		$product_name 	= $this->input->post('product_name');
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('product_name' => $product_name, 'type_id' => $type_id, 'product_delete_status' => 1);
		$listproduct = $this->product->listproduct($condition);
		if(count($listproduct) != 0){
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' => "มีข้อมูลรายการนี้อยู่แล้ว"
			);
			echo json_encode($result);
		} else {
			if($this->tokens->verify('crfproduct')){
				$data = array();
				$data['product_name']      		= $this->input->post('product_name');
				$data['product_price']      	= $this->input->post('product_price');
				$data['type_id']      			= $this->input->post('type_id');
				$data['product_lastedit_name'] 	= $this->encryption->decrypt($this->input->cookie('sysn'));
				$data['product_lastedit_date']	= date('Y-m-d H:i:s');
				$data['product_delete_status']  = 1;

				$Id = $this->product->insertData($data);
				if($type_id == 2){
					$stock = array();
					$stock['product_id'] 	= $Id;
					$stock['size_id'] 		= 1;
					$stock['amount'] 		= $this->input->post('amount');
					$stock['lastedit_name']	= $this->encryption->decrypt($this->input->cookie('sysn'));
					$stock['lastedit_date']	= date('Y-m-d H:i:s');
					$stock['delete_status'] = 1;
					$this->product->insertStock($stock);
				}
				$result = array(
					'error' => false,
					'title' => "เพิ่มข้อมูลเรียบร้อย",
					'url' 	=> site_url('product/product/form/'.$this->input->post('type_id').'/'.$Id)
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
		if($this->tokens->verify('crfproduct')){
			$data['product_id'] 			= $this->input->post('Id');
			$data['product_name']      		= $this->input->post('product_name');
			$data['product_price']      	= $this->input->post('product_price');
			$data['type_id']      			= $this->input->post('type_id');
			$data['product_lastedit_name'] 	= $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['product_lastedit_date']	= date('Y-m-d H:i:s');

			$this->product->updateData($data);
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('product_id' => $this->input->post('Id'));
			$listdetailpackage = $this->product->listdetailpackage($condition);
			if(isset($listdetailpackage) && count($listdetailpackage) != 0){
				foreach ($listdetailpackage as $key => $value) {
					$datatatal['product_id']	= $this->input->post('Id');
					$datatatal['pieces']		= $value['pieces'];
					$datatatal['total_price'] 	= $this->input->post('product_price') * $value['pieces'];
					$this->product->updateTotal($datatatal);
				}
			}
			if($this->input->post('type_id') == 2){
				$stock = array();
				$stock['product_id'] 	= $this->input->post('Id');
				$stock['size_id'] 		= 1;
				$stock['amount'] 		= $this->input->post('amount');
				$stock['lastedit_name']	= $this->encryption->decrypt($this->input->cookie('sysn'));
				$stock['lastedit_date']	= date('Y-m-d H:i:s');
				$stock['delete_status'] = 1;
				$this->product->updateStock($stock);
			}
			$result = array(
				'error' => false,
				'title' => "แก้ไขข้อมูลเรียบร้อย",
				'url' => site_url('product/product/form/'.$this->input->post('type_id').'/'.$this->input->post('Id'))
			);
			echo json_encode($result);
		}
	}


	//check-delete
	public function checkdelete($id){

		$condition = array();
		$condition['fide'] = "pack_id";
		$condition['where'] = array('pack_delete_status' => 1);
		$checkpackage = $this->product->listpackage($condition);

		$arrpack = array();
		for($i = 0;$i < count($checkpackage);$i++){
			$arrpack[$i] = $checkpackage[$i]['pack_id'];
		}

		//check package
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('product_id' => $id);
		$condition['where_in']['filde'] = 'pack_id';
        $condition['where_in']['value'] = $arrpack;
		$checkdetailPK = $this->product->listdetailpackage($condition);

		//check stock
		$condition = array();
		$condition['fide'] = "product_id";
		$condition['where'] = array('product_id' => $id, 'delete_status' => 1);
		$checkstock = $this->product->liststock($condition);

		//check detail
		$condition = array();
		$condition['fide'] = "product_id";
		$condition['where'] = array('product_id' => $id);
		$checkdetailOD = $this->product->listdetail($condition);

		if(isset($checkdetailPK) && count($checkdetailPK) != 0 ){
			$result = array(
				'error' => true,
				'title' => "ไม่สามารถลบได้!",
				'msg' => "ยังมีข้อมูลรายการนี้อยู่ในเซตเครื่องแบบ การลบข้อมูลอาจจะทำให้ข้อมูลที่เหลือแสดงผลผิดพลาด",
			);
			echo json_encode($result);
		} elseif(isset($checkstock) && count($checkstock) != 0 ){
			$result = array(
				'error' => true,
				'title' => "ไม่สามารถลบได้!",
				'msg' => "ยังมีข้อมูลรายการนี้อยู่ในสต็อกเครื่องแบบ การลบข้อมูลอาจจะทำให้ข้อมูลที่เหลือแสดงผลผิดพลาด",
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

	// delete
	public function delete($id, $type){

		$data = array(
			'product_id' => $id,
			'product_delete_status' => 0,
			'product_lastedit_name' => $this->encryption->decrypt($this->input->cookie('sysn')),
			'product_lastedit_date' => date('Y-m-d H:i:s'),
		);
		$this->product->updateData($data);
		header("location:".site_url('product/product/index/'.$type));
	}
}
