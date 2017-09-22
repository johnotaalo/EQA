<?php

class M_Facilities extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function search($type = NULL, $search_value = NULL, $limit = NULL, $offset = NULL){
        if($type != NULL){
            $this->db->where('cd4', 1);
        }
        if(isset($search_value)){
            $this->db->where("(facility_code LIKE '%$search_value%' OR facility_name LIKE '%$search_value%' OR county_name LIKE '%$search_value%' OR sub_county_name LIKE '%$search_value%')");
        }

        if(isset($limit) && isset($offset)){
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get("facility_v");

        // echo $this->db->last_query();die;

        return $query->result();
    }

    function get($id = NULL, $query_string = NULL){
        if(isset($id)){
            $this->db->where('id', $id);
        }

        if (isset($query_string)) {
            $this->db->like('facility_name', $query_string);
        }

        $this->db->where('cd4', 1);
        $query = $this->db->get('facility');

        $result = (isset($id)) ? $query->row() : $query->result();
        return $result;
    }
}