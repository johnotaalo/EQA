<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_m extends CI_Model {

	function __construct()
    {
    	
        // Call the Model constructor
        parent::__construct();

    }


    public function check_participant_exist()
    {
        $username = $this->input->post('username');

        $this->db->where('status', 1);
        $this->db->where('participant_email', $username);
        $query = $this->db->get('participants');

        return $query->row();
    }


    public function logoutuser($sess_log){
    	$data['logged_in'] = 0;

	    $this->db->where('session_id', $sess_log);
	    $update = $this->db->update('usersessions', $data);


	    
     }



}