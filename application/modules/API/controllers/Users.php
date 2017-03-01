<?php

class Users extends MY_Controller{
    function __construct(){
        parent::__construct();
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
}