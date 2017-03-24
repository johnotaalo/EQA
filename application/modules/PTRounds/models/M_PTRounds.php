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
}