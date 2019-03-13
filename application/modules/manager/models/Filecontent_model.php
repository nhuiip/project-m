<?php
class Filecontent_model extends CI_Model {

	// Get data
	public function listData($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_fileregulation');
		return $query->result_array();
	}

	// Insert data
	public function insertData($data = array()){
		$this->db->insert("tb_fileregulation",$data);
		return $this->db->insert_id();
	}

	// Update data or delete data (status 0 = deactive 1 = active)
	public function updateData($data = array()){
		$this->db->where(array('regu_id' => $data['regu_id']));
		$this->db->update("tb_fileregulation",$data);
		return $data['regu_id'];
	}

}
?>
