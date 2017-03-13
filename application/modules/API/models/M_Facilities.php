<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Facilities extends CI_Model {
	function get($id = NULL, $query_string = NULL){
		if(isset($id)){
			$this->db->where('id', $id);
		}

		if (isset($query_string)) {
			$this->db->like('facility_name', $query_string);
		}
		
		$query = $this->db->get('facility');

		$result = (isset($id)) ? $query->row() : $query->result();
		return $result;
	}
}

/* End of file M_Facilities.php */
/* Location: ./application/modules/API/models/M_Facilities.php */