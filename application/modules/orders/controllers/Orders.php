<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->load->model("orders_model","orders");
	}

	public function index($type = ""){
		if(empty($type)){
			show_404();
		}
		$data = array();

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tb_orders.orders_delete_status' => 1, 'tb_orders.orders_type' => $type);
		$condition['orderby'] = "tb_orders.orders_id ASC";
		$data['listOders'] = $this->orders->listOders($condition);

		$this->template->js(array(
			base_url('assets/inspinia/js/customfuntion'),
		));
		
		$data['type'] = $type;
		$this->template->backend('orders/orders/main',$data);
	}

	// delete
	public function delete($id, $type){
		$data = array(
			'orders_id' 			=> $id,
			'orders_delete_status' 	=> 0,
		);
		$this->orders->updateData($data);
		header("location:".site_url('orders/orders/index/'.$type));
	}

	// delete
	public function activate($id,$orders_status,$type){

		if($orders_status != 2){
			$data = array(
				'orders_id' 		=> $id,
				'orders_status' 	=> 2,
			);
			$this->orders->updateData($data);
			if($type == 2){
				$condition = array();
				$condition['fide'] = "*";
				$condition['where'] = array('orders_id' => $id);
				$detailod = $this->orders->listdetail($condition);

				$stock = array();
				for($i = 0;$i < count($detailod);$i++){
		
					$condition = array();
					$condition['fide'] = "amount";
					$condition['where'] = array(
						'product_id' => $detailod[$i]['product_id'], 
						'size_id'	 => $detailod[$i]['size_id']
					);
					$liststock = $this->orders->liststock($condition);

					if(count($liststock) != 0){
						$stock['product_id'] 	= $detailod[$i]['product_id'];
						$stock['size_id'] 		= $detailod[$i]['size_id'];
						$stock['amount']		= $liststock[0]['amount'] - $detailod[$i]['pieces'];
						$this->orders->updatestock($stock);
					}
				}
			}
			header("location:".site_url('orders/orders/index/'.$type));
		} else {
			header("location:".site_url('orders/orders/index/'.$type));
		}
	}

	public function mutidelete($type){
		if($this->input->post('select') != ''){
			$orders_id = implode(",", $this->input->post('select'));
			$this->orders->mutidelete($orders_id);
			header("location:".site_url('orders/orders/index/'.$type));
		} else {
			header("location:".site_url('orders/orders/index/'.$type));
		}
	}

	public function mutiactivate($type){
		if($this->input->post('select') != '' && in_array(2, $this->input->post('orders_status'))){
			$result = array(
				'error' => true,
				'title' => "ผิดพลาด",
				'msg' => "มีรายการใบสั่งซื้อที่อัพเดตสถานะแล้วในรายการที่เลือก"
			);
			echo json_encode($result);
		} else {
			if($this->input->post('select') != ''){
				$orders_id = implode(",", $this->input->post('select'));
				$this->orders->mutiactivate($orders_id);
				if($type == 2){
					$arrorderid = explode(',',$orders_id);
					$this->mutistock($arrorderid, $type);	
				}
			} else {
				header("location:".site_url('orders/orders/index/'.$type));
			}
		}
	}

	public function mutistock($arrorderid = "", $type){

		for($i=0;$i<count($arrorderid);$i++){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('orders_id' => $arrorderid[$i]);
			$detailod = $this->orders->listdetail($condition);

			$stock = array();
			for($i = 0;$i < count($detailod);$i++){

				$condition = array();
				$condition['fide'] = "amount";
				$condition['where'] = array(
					'product_id' => $detailod[$i]['product_id'], 
					'size_id'	 => $detailod[$i]['size_id']
				);
				$liststock = $this->orders->liststock($condition);

				if(count($liststock) != 0){
					$stock['product_id'] 	= $detailod[$i]['product_id'];
					$stock['size_id'] 		= $detailod[$i]['size_id'];
					$stock['amount']		= $liststock[0]['amount'] - $detailod[$i]['pieces'];
					$this->orders->updatestock($stock);
				}
			}
		}
		header("location:".site_url('orders/orders/index/'.$type));
	}


}
