<?php
class Size_model extends CI_Model {

    // get data typeproduct
    public function listsize($data = array()){
        $this->db->select($data['fide']);
        if(!empty($data['where'])){$this->db->where($data['where']);}
        if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
        if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
        $query = $this->db->get('tb_size');
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
    
    public function listdetail($data = array()){
        $this->db->select($data['fide']);
        if(!empty($data['where'])){$this->db->where($data['where']);}
        if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
        if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
        $query = $this->db->get('tb_detailorders');
        return $query->result_array();
    }

	// insert 
    public function insertdata($data = array())
    {
        $this->db->set($data)->insert('tb_size');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
	}

	// update 
    public function updateData($data)
    {
        $id = $data['size_id'];
        $this->db->set($data)->where('size_id', $id)->update('tb_size');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
	}

}
?>
