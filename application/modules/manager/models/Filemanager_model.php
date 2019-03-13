<?php
class Filemanager_model extends CI_Model {

	// Get data
	public function listData($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where'],NULL,false);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_filemanager');
		return $query->result_array();
	}

	// Insert data
	public function insertData($data = array()){
		$this->db->insert("tb_filemanager",$data);
		return $this->db->insert_id();
	}

	// Delete File
	public function delete($Id){
		$this->db->delete('tb_filemanager', array('file_id' => $Id));
	}

}
?>
