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

	function getParticipants($search_value = NULL, $limit = NULL, $offset = NULL){
		if(isset($search_value)){
			$this->db->like("participant_email", $search_value);
			$this->db->or_like("CONCAT(participant_fname, ' ', participant_lname)", $search_value);
			$this->db->or_like("participant_phonenumber", $search_value);
		}

		if(isset($limit) && isset($offset)){
			$this->db->limit($limit, $offset);
		}

		$this->db->select("uuid, CONCAT(participant_fname, ' ', participant_lname) as name, participant_email, participant_phonenumber, confirm_token, status, approved");
		$this->db->from("participants");
		$query = $this->db->get();

		return $query->result();
	}

	function getAllParticipants(){
		$query = $this->db->get("participants");
		return $query->result();
	}
}

/* End of file M_Participant.php */
/* Location: ./application/modules/Participant/models/M_Participant.php */