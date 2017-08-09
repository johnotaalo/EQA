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


}