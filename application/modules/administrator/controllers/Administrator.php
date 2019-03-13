<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Administrator extends MX_Controller {

	function __construct(){
		parent::__construct();
		// $this->lang->load(array('admin_page_lang','admin_form_lang'), 'english');
		$this->load->model("administrator_model","administrator");
	}

	public function index($status = ""){
		$data = array();
		$data['formcrf'] = $this->tokens->token('formcrf');
		$data['msg'] = "";
		if($status == "false"){
			$data['msg'] = '<p class="text-danger">Your username and password are incorrect.</p>';
		}
		$this->load->view('administrators/login',$data);
	}

	public function main(){
		$this->permission->admin();
		$data = array();

		//List data administrators
		$condition = array();
		$condition['fide'] = "ad_id,ad_fullname,position_name,ad_email,ad_lastedit_date,ad_lastedit_name,ad_lastlogin,ad_telnumber";
		$condition['where'] = array('ad_delete_status' => 1);
		$data['listdata'] = $this->administrator->listDataFull($condition);

		$this->template->backend('administrators/main',$data);
	}

	public function form($id = ""){
		$this->permission->admin();
		$data = array();

		// List data position
		$condition = array();
		$condition['fide'] = "position_id,position_name";
		$data['listposition'] = $this->administrator->listDataPosition($condition);

		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('ad_id' => $id, 'ad_delete_status' => 1);
			$data['listdata'] = $this->administrator->listData($condition);
			if(count($data['listdata']) == 0){
				show_404();
			}
		}

		$data['formcrf'] = $this->tokens->token('formcrf');
		$this->template->backend('administrators/form',$data);
	}

	public function formpassword($Id = ""){
		$this->permission->admin();
		if($Id == ""){
			show_404();
		}
		$data['Id'] = $Id;
		$data['formcrf'] = $this->tokens->token('formcrf');
		$this->template->backend('administrators/formpassword',$data);
	}

	public function create(){
		$this->permission->admin();
		if($this->tokens->verify('formcrf')){
			$data = array(
				'ad_fullname' 		=> $this->input->post('Text_fullName'),
				'position_id' 		=> $this->input->post('Select_Positon'),
				'ad_telnumber' 		=> str_replace('-', '', $this->input->post('Text_Tel')),
				'ad_email' 			=> $this->input->post('Text_Email'),
				'ad_password' 		=> md5($this->input->post('Text_passWord')),
				'ad_createby' 		=> $this->encryption->decrypt($this->input->cookie('sysn')),
				'ad_datecreate' 	=> date('Y-m-d H:i:s'),
				'ad_lastedit_name' 	=> $this->encryption->decrypt($this->input->cookie('sysn')),
				'ad_lastedit_date' 	=> date('Y-m-d H:i:s'),
				'ad_delete_status' 	=> 1,
				'ad_datecreate' 	=> date('Y-m-d H:i:s')
			);
			$this->administrator->insertData($data);
			$result = array(
				'error' => false,
				'url' => site_url('administrator/main')
			);
			echo json_encode($result);
		}
	}

	public function update(){
		$this->permission->admin();
		if($this->tokens->verify('formcrf')){
			$data = array(
				'ad_id' 			=> $this->input->post('Id'),
				'ad_fullname' 		=> $this->input->post('Text_fullName'),
				'position_id' 		=> $this->input->post('Select_Positon'),
				'ad_telnumber' 		=> str_replace('-', '', $this->input->post('Text_Tel')),
				'ad_lastedit_name' 	=> $this->encryption->decrypt($this->input->cookie('sysn')),
				'ad_lastedit_date' 	=> date('Y-m-d H:i:s')
			);
			$this->administrator->updateData($data);
			$result = array(
				'error' => false,
				'url' => site_url('administrator/main')
			);
			echo json_encode($result);
		}
	}

	public function delete($Id){
		$this->permission->admin();
		$data = array(
			'ad_id' => $Id,
			'ad_delete_status' => 0,
			'ad_lastedit_date' => date('Y-m-d H:i:s')
		);
		$this->administrator->updateData($data);
		header("location:".site_url('administrator/main'));
	}

	public function checkemail(){
		$this->permission->admin();
		// check email count 0 = true or than 0 = false
		$Text_Email = $this->input->post('Text_Email');
		if(!empty($Text_Email)){
			$condition = array();
			$condition['fide'] = "ad_id";
			$condition['where'] = array('ad_email' => $Text_Email, 'ad_delete_status' => 1);
			$listemail = $this->administrator->listData($condition);
			if(count($listemail) == 0){
				echo "true";
			}else{
				echo "false";
			}
		}
	}

	public function changepassword(){
		$this->permission->admin();

		if($this->tokens->verify('formcrf')){
			$data = array(
				'ad_id' => $this->input->post('Id'),
				'ad_password' => md5($this->input->post('Text_passWord'))
			);
			$this->administrator->updateData($data);
			$result = array(
				'error' => false,
				'url' => site_url('administrator/main')
			);
			echo json_encode($result);
		}
	}

	public function authen(){
		if($this->tokens->verify('formcrf')){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($username != "" && $password != ""){
				$condition = array();
				$condition['fide'] = "ad_id,ad_fullname,position_name";
				$condition['where'] = array('ad_email' => $username, 'ad_password' => md5($password));
				$listdata = $this->administrator->listDataFull($condition);
				if(count($listdata) == 1){
					$data = array(
						'ad_id' => $listdata[0]['ad_id'],
						'ad_lastlogin' => date('Y-m-d H:i:s')
					);
					$this->administrator->updateData($data);
					$l = $this->encryption->encrypt("l1ci");
					$i = $this->encryption->encrypt($listdata[0]['ad_id']);
					$f = $this->encryption->encrypt($listdata[0]['ad_fullname']);
					$p = $this->encryption->encrypt($listdata[0]['position_name']);
					$cookie = array(
									'name'   => 'syslev',
									'value'  => $l,
									'expire' => '86500',
									'path'   => '/'
							 );
					$cookie_id = array(
		 							'name'   => 'sysli',
		 							'value'  => $i,
		 							'expire' => '86500',
		 							'path'   => '/'
		 					);
					$cookie_fullname = array(
		 							'name'   => 'sysn',
		 							'value'  => $f,
		 							'expire' => '86500',
		 							'path'   => '/'
		 					);
					$cookie_position = array(
				 					'name'   => 'sysp',
				 					'value'  => $p,
				 					'expire' => '86500',
				 					'path'   => '/'
				 			);
					$this->input->set_cookie($cookie);
					$this->input->set_cookie($cookie_id);
					$this->input->set_cookie($cookie_fullname);
					$this->input->set_cookie($cookie_position);
					header("location:".site_url('managepage/pagecontents/index'));
				}else{
					header("location:".site_url('administrator/index/false'));
				}
			}
		}
	}

	public function logout(){
		delete_cookie("syslev");
		header("location:".site_url('administrator/index'));
	}

}
