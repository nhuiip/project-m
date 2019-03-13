<?php
class Detailpackage_model extends CI_Model {

	// Get data tb_detailpackage
    public function listdetailpackage($data = array()){
		$this->db->select($data['fide']);
		$this->db->from('tb_detailpackage');
        $this->db->join('tb_product', 'tb_product.product_id = tb_detailpackage.product_id');
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get();
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

	// Get data sub gallery
	public function listproduct($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_product');
		return $query->result_array();
	}

	// insert 
    public function chooseData($data = array())
    {
        $this->db->set($data)->insert('tb_detailpackage');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
	}

	//updateData 
    public function updateData($data)
    {
        $packid = $data['pack_id'];
		$productid = $data['product_id'];
		$arrwhere = array('product_id' => $productid, 'pack_id' => $packid);
        $this->db->set($data)->where($arrwhere)->update('tb_detailpackage');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
	}

	// Delete 
    public function deleteData($data)
    {
        $packid = $data['pack_id'];
		$productid = $data['product_id'];
		$arrwhere = array('product_id' => $productid, 'pack_id' => $packid);
        $this->db->set($data)->where($arrwhere)->delete('tb_detailpackage');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
	}
}
?>
