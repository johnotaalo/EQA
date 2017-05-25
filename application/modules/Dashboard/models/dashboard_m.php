<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_m extends CI_Model {

	function __construct()
    {
    	
        // Call the Model constructor
        parent::__construct();

    }


    public function pendingParticipants(){
    	$this->db->from('participants');
        $this->db->where('approved', 0);
    	$result = $this->db->count_all_results();

    	return $result;
    }

    public function newEquipments(){
        $this->db->select('equipment_id')->from('participant_equipment')->where('`equipment_id` NOT IN (SELECT id FROM equipment)', NULL, FALSE);

    	$result = $this->db->count_all_results();
    	
    	return $result;
    }

}