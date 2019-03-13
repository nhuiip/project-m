<?php
class Main_model extends CI_Model {

	//get intro
	public function listIntor($data = array()){
		$this->db->select($data['fide']);
		if (!empty($data['where'])) {$this->db->where($data['where']);}
		if (!empty($data['orderby'])) {$this->db->order_by($data['orderby']);}
		if (!empty($data['limit'])) {$this->db->limit($data['limit'][0], $data['limit'][1]);}
		$query = $this->db->get('tb_intro');
		return $query->result_array();
	}

	// Get data
	public function listData($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_contents');
		return $query->result_array();
	}

	public function liststock($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_stockproduct');
		return $query->result_array();
	}

	public function listorder($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_orders');
		return $query->result_array();
	}

	// Get liststudent
	public function liststudent($data = array()){
		$this->db->select($data['fide']);
		$this->db->from('tb_student');
		$this->db->join('tb_department', 'tb_department.dept_id = tb_student.dept_id');
		$this->db->join('tb_sex', 'tb_sex.sex_id = tb_student.sex_id');
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Get listpackage
	public function listpackage($data = array()){
		$this->db->select($data['fide']);
		$this->db->from('tb_package');
		$this->db->join('tb_department', 'tb_department.dept_id = tb_package.dept_id');
		$this->db->join('tb_sex', 'tb_sex.sex_id = tb_package.sex_id');
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get();
		return $query->result_array();
	}

	//Get listdetailpack
	public function listdetailpack($data = array()){
		$this->db->select($data['fide']);
		$this->db->from('tb_detailpackage');
		$this->db->join('tb_product', 'tb_product.product_id = tb_detailpackage.product_id');
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get();
		return $query->result_array();
	}

	//addOders
	public function insertOrders($data = array()){
        $this->db->set($data)->insert('tb_orders');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
	}

	public function insertDetail($details = array()) {
        $this->db->set($details)->insert('tb_detailorders');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
	}

	public function updatestock($stock = array()){
        $arrwhere 	= array('product_id' => $stock['product_id'], 'size_id' => $stock['size_id']);
        $this->db->set('amount', $stock['amount'])->where($arrwhere)->update('tb_stockproduct');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
	}

}
?>
