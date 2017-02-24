<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Participant extends CI_Model {
	function getMaxParticipant(){
		$this->db->select_max('id', 'highest');
		$query = $this->db->get('participants');

		return $query->row();
	}

	public function findParticipantByIdentifier($identifier, $value){
        $this->db->where($identifier, $value);
        $query = $this->db->get('participants');

        return $query->row();
    }
}

/* End of file M_Participant.php */
/* Location: ./application/modules/Participant/models/M_Participant.php */