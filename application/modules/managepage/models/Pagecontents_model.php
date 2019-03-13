<?php
class Pagecontents_model extends CI_Model {

	// Get data
	public function listData($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_contents');
		return $query->result_array();
	}

	// Insert data
	public function insertData($data = array()){
		$this->db->insert("tb_contents",$data);
		return $this->db->insert_id();
	}

	// Update data
	public function updateData($data){
		$this->db->where(array('con_id' => $data['con_id']));
		$this->db->update("tb_contents",$data);
		return $data['con_id'];
	}

}
?>
