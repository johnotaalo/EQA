<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_PPTRound extends CI_Model {


	public function getFacilityParticipants($round_uuid, $facility_id){

    	$this->db->where('pt_round_uuid', $round_uuid);
    	$this->db->where('facility_id', $facility_id);
        $query = $this->db->get('pt_ready_participants')->result();

        return $query;
    }


}

/* End of file M_Participant.php */
/* Location: ./application/modules/QAReviewer/models/M_PTRound.php */