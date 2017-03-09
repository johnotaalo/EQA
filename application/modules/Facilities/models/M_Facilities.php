<?php

class M_Facilities extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function search($search_value = NULL, $limit = NULL, $offset = NULL){
        if(isset($search_value)){
            $this->db->like('facility_code', $search_value);
            $this->db->or_like('facility_name', $search_value);
            $this->db->or_like('county_name', $search_value);
            $this->db->or_like('sub_county_name', $search_value);
        }

        if(isset($limit) && isset($offset)){
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get("facility_v");

        return $query->result();
    }
}