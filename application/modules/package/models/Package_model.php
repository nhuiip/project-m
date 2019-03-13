<?php
class Package_model extends CI_Model {

	// Get data tb_faculty
	public function listfac($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_faculty');
		return $query->result_array();
    }
    
	// Get data tb_department
	public function listdept($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_department');
		return $query->result_array();
    }
    
    // Get data tb_package
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
    
    // Get data tb_sex
	public function listsex($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_sex');
		return $query->result_array();
    }

	// insert 
    public function insertdata($data = array())
    {
        $this->db->set($data)->insert('tb_package');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
	}
	
	// update 
    public function updateData($data)
    {
        $id = $data['pack_id'];
        $this->db->set($data)->where('pack_id', $id)->update('tb_package');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
	}

}
?>
