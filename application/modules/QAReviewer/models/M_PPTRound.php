<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_PPTRound extends CI_Model {


	public function getFacilityParticipants($round_uuid, $facility_id){

    	$this->db->where('pt_round_uuid', $round_uuid);
    	$this->db->where('facility_id', $facility_id);
        $query = $this->db->get('pt_ready_participants')->result();

        return $query;
    }

    public function getDataSubmission($round,$participant){
    	$this->db->where('round_id',$round);
        $this->db->where('participant_id',$participant);

        $datas = $this->db->get('pt_data_submission')->result();

        return $datas;
    }

    public function getFacilityParticipantsView($facility_code){

        $this->db->where('facility_code', $facility_code);
        $this->db->where('user_type', 'participant');
        $query = $this->db->get('participant_readiness_v')->result();

        return $query;
    }


}

/* End of file M_Participant.php */
/* Location: ./application/modules/QAReviewer/models/M_PTRound.php */