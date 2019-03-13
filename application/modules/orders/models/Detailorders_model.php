<?php
class Detailorders_model extends CI_Model {

    // Get listdetail
	public function listorder($data = array()){
        $this->db->select($data['fide']);
        $this->db->from('tb_orders');
		$this->db->join('tb_student', 'tb_student.student_id = tb_orders.student_id');
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get();
		return $query->result_array();
    }

    // Get listdetail
	public function listdetail($data = array()){
		$this->db->select($data['fide']);
		$this->db->from('tb_detailorders');
		$this->db->join('tb_orders', 'tb_orders.orders_id = tb_detailorders.orders_id');
		$this->db->join('tb_product', 'tb_product.product_id = tb_detailorders.product_id');
		$this->db->join('tb_size', 'tb_size.size_id = tb_detailorders.size_id');
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get();
		return $query->result_array();
    }

    // Get listdetail
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

    public function listfaculty($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_faculty');
		return $query->result_array();
    }
    


}
?>