<?php

class Users extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->module('Participant');
        // $this->load->model('m_participant');
    }

    function getUserTypes(){
        $roleData = [];
        if($this->input->is_ajax_request()){
            foreach($this->usertypes as $type){
                if($type != "participant"){
                    $roleData['items'][] = [
                        'id'    =>  $type,
                        'text'  =>  ucwords(strtolower($type))
                    ];
                }
            }

            return $this->output->set_content_type('application/json')->set_output(json_encode($roleData));
        }
    }

    function checkExist($username = NULL){
        $username = (!isset($username))?$_REQUEST['username']: $username;
        $this->load->model('Auth/auth_m');

        $user = $this->auth_m->findUser($username);
        if($this->input->is_ajax_request()){
            if($user){
                echo 'false';
            }else{
                echo 'true';
            }
        }else{
            if($user){
                return false;
            }else{
                return true;
            }
        }
        
    }

    function checkPhone(){
        $phone = $_REQUEST['phonenumber'];

        $this->db->where('phone', $phone);
        if($this->session->userdata('uuid')){
            $this->db->where('uuid !=', $this->session->userdata('uuid'));
        }
        $user = $this->db->get('users_v')->row();

        if($user){
            echo 'false';
        }else{
            echo 'true';
        }
    }
    function checkEmail(){
        $email = $_REQUEST['email_address'];

        $this->db->where('email_address', $email);
        if($this->session->userdata('uuid')){
            $this->db->where('uuid !=', $this->session->userdata('uuid'));
        }
        $user = $this->db->get('users_v')->row();

        if($user){
            echo 'false';
        }else{
            echo 'true';
        }
    }

     function participants(){
         $columns = [];
         $limit = $offset = $search_value = NULL;

         if($this->input->is_ajax_request()){
             $columns = [
                 0 => "name",
                 1 => "participant_email",
                 2 => "participant_phonenumber"
             ];

             $limit = $_REQUEST['length'];
             $offset = $_REQUEST['start'];
             $search_value = $_REQUEST['search']['value'];
         }

         $participants = $this->M_Participant->getParticipants($search_value, $limit, $offset);
         $data = [];

         if($participants){
             foreach($participants as $participant){
                 $activation = $status = $details = $approval = "";
                 $facility = $this->db->get_where('facility', ['id'=>$participant->participant_facility])->row();

                 $details = "<a class = 'btn btn-sm btn-warning' href = '".base_url('Users/Participants/details/' . $participant->uuid)."'>Details</a>";

                 if($participant->confirm_token != NULL && $participant->status == 0){
                     $activation = "<span class = 'tag tag-danger'>Not Activated</span>";
                 }else{
                     $activation = "<span class = 'tag tag-success'>Activated</span>";
                 }

                 if($participant->status == 1){
                     $status = "<span class = 'tag tag-success'>Active</span>";
                 }else{
                     $status = "<span class = 'tag tag-danger'>Deactivated</span>";
                 }

                 if($participant->approved == 1){
                     $approval = "<a class = 'btn btn-success btn-sm' href = '".base_url('Users/Participants/approval/' . $participant->uuid)."'>Approved</a>";
                 }else{
                     $approval = "<a class = 'btn btn-danger btn-sm approval' href = '".base_url('Users/Participants/approval/' . $participant->uuid)."'>Not Approved</a>";
                 }
                 $usertype = "Participant";
                if($participant->user_type == "qareviewer"){
                    $usertype = "QA Reviewer";      
                }
                 $data[] = [
                     $participant->name,
                     $facility->facility_name,
                     $participant->participant_email,
                     $participant->participant_phonenumber,
                     $usertype,
                     $activation,
                     $status,
                     $approval ."&nbsp;". $details
                 ];
             }
         }

         if($this->input->is_ajax_request()){
             $all_participants = $this->M_Participant->getAllParticipants();
             $total_data = count($all_participants);
             $data_total = count($participants);

             $json_data = [
                 "draw"				=>	intval( $_REQUEST['draw']),
				"recordsTotal"		=>	intval($total_data),
				"recordsFiltered"	=>	intval(count($this->M_Participant->getParticipants($search_value))),
				'data'				=>	$data
             ];

             return $this->output->set_content_type('application/json')->set_output(json_encode($json_data));
         }
    }
}