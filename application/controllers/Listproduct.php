<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listproduct extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("listproduct_model","listproduct");
        $this->load->helper('fileexist');
        $this->load->helper('cookie');
    }

    public function index(){

        $data = array();
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('product_delete_status' => 1, 'type_id!=' => 3 );
        $data['listproduct'] = $this->listproduct->listproduct($condition);

        if(isset($_COOKIE['CartData'])){
            $c = count($_COOKIE['CartData']);
            for($i = 0; $i < $c; $i++){
                $tem_data = json_decode($_COOKIE['CartData'][$i], true);
                $data['CartData'][$i] = $tem_data;
            }
        }
        $this->template->js(array(
			base_url('assets/canvas/js/lib/plugins/validate/jquery.validate.min'),
			base_url('assets/canvas/js/methods/app/function'),
        ));
        
        $data['crforders'] = $this->tokens->token('crforders');
        $this->template->frontend('listproduct/main',$data);
    }

    //cookie
    public function cartdata($product_id, $index=null){

        $data = array(
			'product_id'        => $product_id
        );
        $this->set($data,$index);
        redirect('listproduct/index', 'refresh');
    }

    private function set($dataSet,$index=null){
		$data = $dataSet;
		$nameCookie = "CartData[0]";
        if (isset($_COOKIE['CartData'])) {
			if($index != null){
				$nameCookie = "CartData[".$index."]";
			}else{
				$c = count($_COOKIE['CartData']);
				$nameCookie = "CartData[".$c."]";
			}
		}
		$json = json_encode($data);
        $cookie = array(
            'name' => $nameCookie,
            'value' => $json,
            'expire' => '86400'
        );
        set_cookie($cookie);
    }
    
    public function delete($index)
    {
        if (isset($_COOKIE['CartData'])) {
			delete_cookie('CartData['.$index.']');
			redirect('/listproduct/index', 'refresh');
		}
    }

    public function addorder(){

        if(isset($_COOKIE['CartData'])){
            $s = 0;
            $key_delete = array();
            foreach ($_COOKIE['CartData'] as $key => $value) {
                $tem_data = json_decode($value, true);
                array_push($key_delete,$key);
                $CartData[$s] = $tem_data;
                $s++;
            }
		}else{
			show_404();
		}
		if (in_array("", $this->input->post('size_id'))) {
			$result = array(
				'error' => true,
				'title' => "ผิดผลาด",
				'msg' => "กรุณาเลือกขนาดเครื่องแบบให้ครบถ้วน"
			);
            echo json_encode($result);
		} else {
            $total = array();
            for($i = 0;$i < count($this->input->post('product_id'));$i++){
                $total[$i] = $this->input->post('price')[$i]*$this->input->post('pieces')[$i];
            }
            $orders_total = array_sum($total);
			if($this->tokens->verify('crforders')){
				$data 							= array();
				$data['student_id'] 			= $this->input->post('student_id');
				$data['orders_date'] 			= date('Y-m-d');
				$data['orders_total'] 			= $orders_total;
				$data['orders_number'] 			= "RMUTR-".time();
				$data['orders_status'] 			= 1;
				$data['orders_type'] 			= 2;
				$data['orders_delete_status'] 	= 1;
	
				$orders_id = $this->listproduct->insertOrders($data);
	
				$details = array();
				for($i = 0;$i < count($this->input->post('product_id'));$i++){
					$details['orders_id'] 	= $orders_id;
					$details['product_id'] 	= $this->input->post('product_id')[$i];
					$details['size_id'] 	= $this->input->post('size_id')[$i];
					$details['pieces'] 		= $this->input->post('pieces')[$i];
					$details['price'] 		= $this->input->post('pieces')[$i]*$this->input->post('price')[$i];
	
					$this->listproduct->insertDetail($details);
                }

                if (isset($_COOKIE['CartData'])) {
                    for($i = 0;$i < count($key_delete);$i++){
                        delete_cookie('CartData['.$key_delete[$i].']');
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