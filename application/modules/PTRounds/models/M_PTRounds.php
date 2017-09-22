<?php

class M_PTRounds extends MY_Model{
    function __construct(){
        parent::__construct();
    }

    function findSamples($round_id = NULL){
        if($round_id != NULL){
            
        }
    }

    function findTesters($round_id = NULL){
        if($round_id != NULL){
            
        }
    }

    function findLabs($round_id = NULL){
        if($round_id != NULL){
            
        }
    }

    function findCalendarDetailsByRound($round_id){
        // $sql = "CALL proc_get_calendar_details($round_id)";
        $sql = "SELECT ci.uuid as calendar_item_id, 
                    ci.item_name as calendar_item, 
                    DATE_FORMAT(ptc.date_from, '%m/%d/%Y') as date_from, 
                    DATE_FORMAT(ptc.date_to, '%m/%d/%Y') as date_to
                FROM calendar_items ci
                LEFT JOIN pt_calendar ptc ON ptc.calendar_item_id = ci.id
                LEFT JOIN pt_round ptr ON ptr.id = ptc.pt_round_id AND ptr.id = $round_id";

        $query = $this->db->query($sql);

        return $query->result();
    }

    function searchFacilityReadiness($round_uuid, $search_value = NULL, $limit = NULL, $offset = NULL){
        $search_value = ($search_value != NULL) ? $search_value : "";
        $limit = ($limit == NULL) ? "NULL" : $limit;
        $offset = ($offset == NULL) ? "NULL" : $offset;
        $query = $this->db->query("CALL get_facility_readiness_data('$round_uuid', '$search_value', $limit, $offset)");
        $result = $query->result();
        $query->next_result();
        $query->free_result();
        return $result;
    }

    function getParticipantRoundReadiness($facility_code, $pt_round_uuid){
        $this->db->select("pr.readiness_id, p.participant_id, p.participant_fname, p.participant_lname, p.participant_email, p.participant_phonenumber, f.facility_code, f.facility_name, f.email, f.telephone, pr.status as readiness_status, pr.verdict as readiness_verdict, pr.comment as readiness_comment");
        $this->db->from("participant_readiness pr");
        $this->db->join("participants p", "p.uuid = pr.participant_id");
        $this->db->join('facility f', 'f.id = p.participant_facility');
        $this->db->where('f.facility_code', $facility_code);
        $this->db->where('pr.pt_round_no', $pt_round_uuid);

        return $this->db->get()->row();
    }

    function getReadinessResponses($readiness_id){
        $this->db->select('q.question, q.question_no, prr.response, prr.extra_comments');
        $this->db->from('questionnairs q');
        $this->db->join('participant_readiness_responses prr', 'q.id = prr.questionnaire_id AND prr.readiness_id = ' . $readiness_id, 'left');
        $this->db->order_by('q.question_no');
        

        return $this->db->get()->result();
    }

    public function getDataSubmission($round){
        $this->db->where('round_id', $round);
        $this->db->where('status', 1);

        $query = $this->db->get('pt_data_submission',1);

        return $query->row();
    }

    public function getFacilityParticipants($round_uuid){
        $this->db->from('data_entry_v dev');
        $this->db->join('pt_ready_participants prp', 'prp.p_id = dev.participant_id');
        $this->db->join('pt_data_submission pds', 'pds.round_id = dev.round_id');
        $this->db->where('dev.round_uuid', $round_uuid);
        $this->db->where('pds.status', 1);
        $this->db->where('prp.lab_result', 1);
        $this->db->group_by('dev.round_uuid, dev.participant_id');
        $this->db->order_by('prp.facility_code','asc');
        

        return $this->db->get()->result();
    }
}