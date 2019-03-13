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
	public function activate($id, $type){
		$data = array(
			'orders_id' 		=> $id,
			'orders_status' 	=> 2,
		);
		$this->orders->updateData($data);
		header("location:".site_url('orders/orders/index/'.$type));
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

		if($this->input->post('select') != ''){
			$odlicen_id = implode(",", $this->input->post('select'));
			$this->orders->mutiactivate($odlicen_id);
			header("location:".site_url('orders/orders/index/'.$type));
		} else {
			header("location:".site_url('orders/orders/index/'.$type));
		}
	}
}
