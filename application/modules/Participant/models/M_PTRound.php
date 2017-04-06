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

    	$this->db->select('ps.id AS sample_id, ps.uuid AS sample_uuid, ps.sample_name AS sample_name');
    	$this->db->from('pt_panel_tracking ppt');
    	$this->db->join('pt_batches pb', 'pb.id = ppt.pt_batch_id');
    	$this->db->join('pt_batch_tube pbt', 'pbt.batch_id = pb.id');
    	$this->db->join('pt_samples ps', 'ps.id = pbt.sample_id');
    	$this->db->join('participant_readiness par', 'par.readiness_id = ppt.pt_readiness_id');
    	$this->db->join('pt_round pr', 'pr.uuid = par.pt_round_no');

    	$this->db->where('pr.uuid', $round_uuid);
    	$this->db->where('par.participant_id', $participant_id);

    	// $this->db->group_by('ps.id');

        $query = $this->db->get();

        // echo $this->db->last_query();die;

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