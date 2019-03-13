<?php
class Product_model extends CI_Model {

    // get data typeproduct
    public function listtypeproduct($data = array()){
        $this->db->select($data['fide']);
        if(!empty($data['where'])){$this->db->where($data['where']);}
        if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
        if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
        $query = $this->db->get('tb_typeproduct');
        return $query->result_array();
    }

    // get data listproduct
    public function listproduct($data = array()){
        $this->db->select($data['fide']);
        if(!empty($data['where'])){$this->db->where($data['where']);}
        if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
        if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
        $query = $this->db->get('tb_product');
        return $query->result_array();
    }

    // get data listproduct
    public function amount($data = array()){
        $this->db->select($data['fide']);
        if(!empty($data['where'])){$this->db->where($data['where']);}
        if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
        if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
        $query = $this->db->get('tb_stockproduct');
        return $query->result_array();
    }

    // get data listdetailpackage
    public function listdetailpackage($data = array()){
        $this->db->select($data['fide']);
        if(!empty($data['where'])){$this->db->where($data['where']);}
        if(!empty($data['where_in'])){
			$this->db->where_in($data['where_in']['filde'],$data['where_in']['value']);
		}
        if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
        if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
        $query = $this->db->get('tb_detailpackage');
        return $query->result_array();
    }

    public function listpackage($data = array()){
        $this->db->select($data['fide']);
        if(!empty($data['where'])){$this->db->where($data['where']);}
        if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
        if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
        $query = $this->db->get('tb_package');
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
        $this->db->set($data)->insert('tb_product');
        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }
        return null;
    }

	// update
    public function updateData($data)
    {
        $id = $data['product_id'];
        $this->db->set($data)->where('product_id', $id)->update('tb_product');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
    }
    
    // insert
    public function insertStock($stock = array())
    {
        $this->db->set($stock)->insert('tb_stockproduct');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
    }
    
    // update
    public function updateStock($stock)
    {
        $product_id = $stock['product_id'];
        $size_id    = $stock['size_id'];
        $arrwhere = array('product_id' => $product_id, 'size_id' => $size_id, 'delete_status', 1);
        $this->db->set($stock)->where($arrwhere)->update('tb_stockproduct');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
	}

  // update
    public function updateTotal($datatatal)
    {
        $id = $datatatal['product_id'];
        $pieces = $datatatal['pieces'];
        $arrwhere = array('product_id' => $id, 'pieces' => $pieces);
        $this->db->set('total_price', $datatatal['total_price'])->where($arrwhere)->update('tb_detailpackage');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
	}

}
?>
