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

    public function Samples(){
  //   	SELECT pts.id AS sample_id, pts.uuid AS sample_uuid, pts.sample_name FROM participant_readiness pr
		// JOIN pt_round ptr ON ptr.uuid = pr.pt_round_no
		// JOIN pt_batches ptb ON ptb.pt_round_id = ptr.id
		// JOIN pt_tubes ptt ON ptt.pt_round_id = ptr.id
		// JOIN pt_batch_tube pbt ON pbt.batch_id = ptb.id AND ptt.id = pbt.tube_id
		// JOIN pt_samples pts ON pts.id = pbt.sample_id AND ptr.id = pts.pt_round_id
		// WHERE pr.participant_id = '3019e45a-1386-11e7-a133-080027c30a85'
		// AND ptr.uuid = 'b7f000a3-1386-11e7-a133-080027c30a85'
		// GROUP BY pts.id
    }
}

/* End of file M_Participant.php */
/* Location: ./application/modules/Participant/models/M_Participant.php */