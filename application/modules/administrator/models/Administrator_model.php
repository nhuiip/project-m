<?php
class Administrator_model extends CI_Model {



	// Get data
	public function listData($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_administrator');
		return $query->result_array();
	}

	// Get full join table
	public function listDataFull($data = array()){
		$this->db->select($data['fide']);
		$this->db->from('tb_administrator');
		$this->db->join('tb_position', 'tb_administrator.position_id = tb_position.position_id');
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get();
		return $query->result_array();
	}

	// Get data position
	public function listDataPosition($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_position');
		return $query->result_array();
	}

	// Insert data
	public function insertData($data = array()){
		//$this->db->db_debug = FALSE;
		$this->db->insert("tb_administrator",$data);
		return $this->db->insert_id();
	}

	// Update data or delete data (status 0 = deactive 1 = active)
	public function updateData($data = array()){
		$this->db->where(array('ad_id' => $data['ad_id']));
		$this->db->update("tb_administrator",$data);
		return $data['ad_id'];
	}

	// Authen data
	public function authen(){
		$this->load->helper('security');
		$email= $this->input->post('email');
        $pass = do_hash($this->input->post('password'), 'md5');
        $this->db->where(array('ad_email' => $email,'ad_pass' => $pass));
        $data = $this->db->get('tb_admin');
        $administrator = $data->result_array();
        if(count($administrator) == 1){
		$ad_id = $administrator[0]['ad_id'];
		   $this->load->helper('cookie');
		   $cookie_administrator = array(
                'name'   => 'NA',
                'value'  => $administrator[0]['ad_name'],
                'expire' => '86500',
                'path'   => '/',
                'prefix' => 'cloud_'
            );
           $cookie_email= array(
                'name'   => 'N',
                'value'  => $administrator[0]['ad_email'],
                'expire' => '86500',
                'path'   => '/',
                'prefix' => 'cloud_'
            );
            $cookie_level = array(
                'name'   => 'L',
                'value'  => 1,
                'expire' => '86500',
                'path'   => '/',
                'prefix' => 'cloud_'
            );
            $cookie_id = array(
                'name'   => 'I',
                'value'  => $administrator[0]['ad_id'],
                'expire' => '86500',
                'path'   => '/',
                'prefix' => 'cloud_'
            );
			$this->input->set_cookie($cookie_administrator);
            $this->input->set_cookie($cookie_email);
            $this->input->set_cookie($cookie_level);
            $this->input->set_cookie($cookie_id);
            header('location:'.site_url('administrator/customers/listdata/month'));
        }else{
            header('location:'.site_url().'/administrator/index/?login=false');
        }
	}

}
?>
