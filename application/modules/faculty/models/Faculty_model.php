<?php
class Faculty_model extends CI_Model {

	// Get data
	public function listfac($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_faculty');
		return $query->result_array();
	}

	// Get data sub gallery
	public function listdept($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_department');
		return $query->result_array();
    }
    
    // Get data listpackage
    public function listpackage($data = array()){
		$this->db->select($data['fide']);
		$this->db->from('tb_package');
        $this->db->join('tb_department', 'tb_department.dept_id = tb_package.dept_id');
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get();
		return $query->result_array();
	}

	// insert 
    public function insertdata($data = array())
    {
        $this->db->set($data)->insert('tb_faculty');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
	}

	// update 
    public function updateData($data)
    {
        $id = $data['fac_id'];
        $this->db->set($data)->where('fac_id', $id)->update('tb_faculty');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
	}

}
?>
