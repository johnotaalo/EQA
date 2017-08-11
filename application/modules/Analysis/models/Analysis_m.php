<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analysis_m extends CI_Model {

	function __construct()
    {
    	
        // Call the Model constructor
        parent::__construct();

    }


    public function Equipments(){
        $sql = "
            SELECT e.id, e.uuid, e.equipment_name FROM equipment e
            WHERE e.equipment_status = 1
        ";

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function absoluteValue($round_id,$equipment_id,$sample_id,$participant_id){

        $this->db->select("cd4_absolute");
        $this->db->from("pt_participant_review_v");
        $this->db->where("round_id",$round_id);
        $this->db->where("equipment_id",$equipment_id);
        $this->db->where("sample_id",$sample_id);
        $this->db->where("participant_id",$participant_id);
        $query = $this->db->get();
        
        return $query->row();
    }


}