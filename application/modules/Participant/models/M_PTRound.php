<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_PTRound extends CI_Model {
	public function findRound($rounduuid){
        $this->db->where('email_address', $username);
        $this->db->or_where('username', $username);

        $query = $this->db->get('participant_readiness_v', 1);

        return $query->row();
    }

    public function Equipments(){
    	// $this->db->where('facility_code', $facility_code);

        $query = $this->db->get('equipments_v')->result();

        return $query;
    }
}

/* End of file M_Participant.php */
/* Location: ./application/modules/Participant/models/M_Participant.php */