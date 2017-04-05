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
    	$this->db->where('equipment_status', 1);
        $query = $this->db->get('equipments_v')->result();

        return $query;
    }

    public function getSamples($round_uuid,$participant_id){

    	$this->db->select('pts.id AS sample_id,pts.uuid AS sample_uuid,pts.sample_name AS sample_name');
    	$this->db->from('participant_readiness pr');
    	$this->db->join('pt_round ptr', 'ptr.uuid = pr.pt_round_no');
    	$this->db->join('pt_batches ptb', 'ptb.pt_round_id = ptr.id');
    	$this->db->join('pt_tubes ptt', 'ptt.pt_round_id = ptr.id');
    	$this->db->join('pt_batch_tube pbt', 'pbt.batch_id = ptb.id AND ptt.id = pbt.tube_id');
    	$this->db->join('pt_samples pts', 'pts.id = pbt.sample_id AND ptr.id = pts.pt_round_id');

    	// $this->db->where('ptr.uuid', 'b7f000a3-1386-11e7-a133-080027c30a85');
    	// $this->db->where('pr.participant_id', '3019e45a-1386-11e7-a133-080027c30a85'); 
    	$this->db->where('ptr.uuid', $round_uuid);
    	$this->db->where('pr.participant_id', $participant_id); 

    	$this->db->group_by('pts.id');

        $query = $this->db->get();

		return $query->result();
    }


    public function getDataSubmission($round,$participant,$equipment){
    	$this->db->where('round_id', $round);
    	$this->db->where('participant_id', $participant);
    	$this->db->where('equipment_id', $equipment);
    	$query = $this->db->get('pt_data_submission',1);

    	return $query->row();
    }
}

/* End of file M_Participant.php */
/* Location: ./application/modules/Participant/models/M_PTRound.php */