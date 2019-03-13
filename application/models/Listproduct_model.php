<?php
class Listproduct_model extends CI_Model {

    // get data listproduct
    public function listproduct($data = array()){
        $this->db->select($data['fide']);
        if(!empty($data['where'])){$this->db->where($data['where']);}
        if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
        if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
        $query = $this->db->get('tb_product');
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
    
}