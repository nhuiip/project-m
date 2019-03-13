<?php
class Student_model extends CI_Model {

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

    // Get data tb_student
    public function liststudent($data = array()){
		$this->db->select($data['fide']);
		$this->db->from('tb_student');
        $this->db->join('tb_department', 'tb_department.dept_id = tb_student.dept_id');
        $this->db->join('tb_sex', 'tb_sex.sex_id = tb_student.sex_id');
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

		// Get data tb_schoolyear
		public function listyear($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_schoolyear');
		return $query->result_array();
    }

	// insert
    public function insertdata($data = array())
    {
        $this->db->set($data)->insert('tb_student');
        if ($this->db->affected_rows() === 1) {
			return 1;
		}
        return null;
	}

	// update
    public function updateData($data)
    {
        $id = $data['student_id'];
        $this->db->set($data)->where('student_id', $id)->update('tb_student');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
	}

	public function mutidelete($student_id)
    	{
        $id = explode(',',$student_id);
        $this->db->where_in('student_id', $id)->delete('tb_student');
        if ($this->db->affected_rows() === 1) {
            return 1;
        }
        return null;
		}

}
?>
