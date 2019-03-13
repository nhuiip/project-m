<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stock extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->load->model("stock_model","stock");
		
	}

	public function index($typeid, $id = ""){
		$data = array();

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_stockproduct.product_id' => $id, 'tb_stockproduct.delete_status' => 1);
		$condition['orderby'] = "tb_stockproduct.size_id ASC";
    $data['liststock'] = $this->stock->liststock($condition);

    $condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('product_id' => $id);
    $data['listproduct'] = $this->stock->listproduct($condition);

		$data['typeproduct'] = $typeid;
		$this->template->backend('product/stock/main',$data);
	}

	public function form($typeid, $id, $sizeid = ""){

		$data = array();
		//Data in case update
		if(!empty($sizeid && $id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('tb_stockproduct.product_id' => $id, 'tb_stockproduct.size_id' => $sizeid, 'delete_status' => 1);
			$data['liststock'] = $this->stock->liststock($condition);
		}
		$this->template->js(array(
			base_url('assets/inspinia/js/customfuntion'),
		));

    $condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('product_id' => $id, 'product_delete_status' => 1);
		$listproduct = $this->stock->listproduct($condition);
		if(isset($listproduct) && count($listproduct) != 0){
			foreach ($listproduct as $key => $value) {
                $product_id = $value['product_id'];
				$product_name = $value['product_name'];
                $type_id = $value['type_id'];
			}
        }
        $condition = array();
        $condition['fide'] = "*";
        $condition['where'] = array('size_status' => 1, 'size_delete_status' => 1);
        $data['listsize1'] = $this->stock->listsize($condition);

        $condition = array();
        $condition['fide'] = "*";
        $condition['where'] = array('size_status' => 2, 'size_delete_status' => 1);
        $data['listsize2'] = $this->stock->listsize($condition);

        $data['productid'] = $product_id;
        $data['productname'] = $product_name;
		$data['typeid'] = $type_id;

		$data['typeproduct'] = $typeid;
		$data['crfstock'] = $this->tokens->token('crfstock');
		$this->template->backend('product/stock/form',$data);
	}

	public function create(){

		$type 		= $this->input->post('type');
		$product_id = $this->input->post('product_id');

		if($this->input->post('status') == '1'){
			$size_id 	= $this->input->post('size_id1');
			$amount		= $this->input->post('amount1');
		} elseif($this->input->post('status') == '2'){
			$size_id 	= $this->input->post('size_id2');
			$amount		= $this->input->post('amount2');
		} else {
			$size_id 	= $this->input->post('size_id');
			$amount		= $this->input->post('amount');
		}
		$condition 	= array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_stockproduct.product_id' => $product_id, 'tb_stockproduct.size_id' => $size_id, 'delete_status' => 1);
		$liststock = $this->stock->liststock($condition);
		if(count($liststock) != 0){
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' 	=> "มีข้อมูลรายการนี้อยู่แล้วกรุณาไปที่รายการแก้ไข",
			);
			echo json_encode($result);
		} else {
			if($this->tokens->verify('crfstock')){
				//data
				$data = array();
				$data['product_id']     = $product_id;
				$data['size_id']      	= $size_id;
				$data['amount']      	= $amount;
				$data['lastedit_name'] 	= $this->encryption->decrypt($this->input->cookie('sysn'));
				$data['lastedit_date']	= date('Y-m-d H:i:s');
				$data['delete_status']  = 1;

				$Id = $this->stock->insertData($data);
				$result = array(
					'error' => false,
					'title' => "เพิ่มข้อมูลเรียบร้อย",
					'url' 	=> site_url('product/stock/form/'.$type.'/'.$product_id.'/'.$size_id)
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
		$type 		= $this->input->post('type');
		$product_id = $this->input->post('product_id');
		$size_id 	= $this->input->post('size_id');
		$amount		= $this->input->post('amount');
		if($this->tokens->verify('crfstock')){
			$data['product_id'] 	= $product_id;
			$data['size_id']      	= $size_id;
			$data['amount']      	= $amount;
			$data['lastedit_name'] 	= $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['lastedit_date']	= date('Y-m-d H:i:s');

			$this->stock->updateData($data);
			$result = array(
				'error' => false,
				'title' => "แก้ไขข้อมูลเรียบร้อย",
				'url' 	=> site_url('product/stock/form/'.$type.'/'.$product_id.'/'.$size_id)
			);
			echo json_encode($result);
		}
	}

	// delete
	public function delete($type, $product_id, $size_id){

		$data = array(
			'product_id' => $product_id,
			'size_id' => $size_id,
			'delete_status' => 0,
			'lastedit_name' => $this->encryption->decrypt($this->input->cookie('sysn')),
			'lastedit_date' => date('Y-m-d H:i:s'),
		);
		$this->stock->updateData($data);
		header("location:".site_url('product/stock/index/'.$type.'/'.$product_id));
	}
}
