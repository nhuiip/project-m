<?php
class Orders_model extends CI_Model {

	// // Get data
    public function listOders($data = array()){
		$this->db->select($data['fide']);
		$this->db->from('tb_orders');
        $this->db->join('tb_student', 'tb_student.student_id = tb_orders.student_id');
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get();
		return $query->result_array();
    }

		// update
		public function updateData($data)
		{
			$id = $data['orders_id'];
			$this->db->set($data)->where('orders_id', $id)->update('tb_orders');
			if ($this->db->affected_rows() === 1) {
				return 1;
			}
			return null;
		}

		public function mutidelete($orders_id)
    	{
        $id = explode(',',$orders_id);
        $this->db->set('orders_delete_status', 0)->where_in('orders_id', $id)->update('tb_orders');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
		}
		
		public function mutiactivate($orders_id)
    	{
        $id = explode(',',$orders_id);
        $this->db->set('orders_status', 2)->where_in('orders_id', $id)->update('tb_orders');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
    	}
    


}
?>
