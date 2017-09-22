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

        $this->db->where('approved', 1);
        $this->db->where('status', 1);
        $this->db->where('participant_email', $username);
        $query = $this->db->get('participants');

        return $query->row();
    }

    public function findUser($username){
        $this->db->where('email_address', $username);
        $this->db->or_where('username', $username);
        $query = $this->db->get('users_v', 1);

        return $query->row();
    }

    
    public function findUserByIdentifier($identifier, $value){
        $this->db->where($identifier, $value);
        $query = $this->db->get('users_v', 1);

        return $query->row();
    }

    public function getNewMessages($identifier,$value){
        $this->db->where($identifier, $value);
        $this->db->where('status', 0);
        $this->db->order_by('date_sent', 'desc');
        $query = $this->db->get('messages_v', 4);

        return $query->result();
    }


}