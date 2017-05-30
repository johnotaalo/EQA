<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Equipment extends CI_Model {
	function get($id = NULL, $query_string = NULL){
		if (isset($id)) {
			$this->db->where('id', $id);
		}

		if (isset($query_string)) {
			$this->db->like('equipment_name', $query_string);
		}

		$query = $this->db->get('equipment');

		return (isset($id)) ? $query->row() : $query->result();
	}
}

/* End of file M_Equipment.php */
/* Location: ./application/modules/API/models/M_Equipment.php */