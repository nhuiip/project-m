<?php
class Stock_model extends CI_Model {

    // get data typeproduct
    public function liststock($data = array()){
        $this->db->select($data['fide']);
        $this->db->from('tb_stockproduct');
        $this->db->join('tb_product', 'tb_product.product_id = tb_stockproduct.product_id');
        $this->db->join('tb_size', 'tb_size.size_id = tb_stockproduct.size_id');
        if(!empty($data['where'])){$this->db->where($data['where']);}
        if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
        if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
        $query = $this->db->get();
        return $query->result_array();
    }

    // get data typeproduct
    public function listproduct($data = array()){
        $this->db->select($data['fide']);
        if(!empty($data['where'])){$this->db->where($data['where']);}
        if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
        if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
        $query = $this->db->get('tb_product');
        return $query->result_array();
    }

    // get data typeproduct
    public function listsize($data = array()){
        $this->db->select($data['fide']);
        if(!empty($data['where'])){$this->db->where($data['where']);}
        if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
        if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
        $query = $this->db->get('tb_size');
        return $query->result_array();
    }

	// insert 
    public function insertdata($data = array())
    {
        $this->db->set($data)->insert('tb_stockproduct');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
	}

	// update 
    public function updateData($data)
    {
        $product_id = $data['product_id'];
        $size_id    = $data['size_id'];
        $arrwhere = array('product_id' => $product_id, 'size_id' => $size_id, 'delete_status', 1);
        $this->db->set($data)->where($arrwhere)->update('tb_stockproduct');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
	}

}
?>
