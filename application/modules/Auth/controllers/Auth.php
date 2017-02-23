<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('auth_m');
	}
	
	public function signup()
	{
		$this->assets->addCss('css/signup.css');
		$this->template->setPageTitle('External Quality Assurance Programme')->setPartial('signup')->authTemplate();
	}

	public function signin()
	{
		$this->assets->addCss('css/signin.css');
		$this->template->setPageTitle('External Quality Assurance Programme')->setPartial('signin')->authTemplate();
	}

	public function participantLogin(){
		$participant = $this->auth_m->check_user_exist();
		$this->load->library('Hash');
		if($participant){
			if (password_verify($this->input->post('password'), $participant->password)) {

				$session_data = array(
		                   'id'         			=> $participant ->id , 
		                   'participant_id'    		=> $participant ->participant_id , 
		                   'uuid'    				=> $participant ->uuid , 
		                   'participant_fname'    	=> $participant ->participant_fname ,
		                   'participant_lname'   	=> $participant ->participant_lname ,
		                   'participant_phonenumber'=> $participant ->participant_phonenumber,
		                   'participant_email'   	=> $participant ->participant_email,
		                   'participant_password'   => $participant ->participant_password,
		                   'approved'   			=> $participant ->approved,
		                   'status'   				=> $participant ->status,
		                   'date_registered'   		=> $participant ->date_registered,
		                   'confirm_token'   		=> $participant ->confirm_token
		        );

		        $this->set_session($session_data);
				redirect('Dashboard','refresh');
			}	
		}else{
			echo "User does not exist";die();
		}
	}

	private function set_session($session_data){
       //echo "<pre>";print_r($result);die();
       //echo $session_data['userid'];die();
      $setting_session = array(
                   'id'       => $session_data['id'] , 
                   'participant_id'       => $session_data['participant_id'] , 
                   'uuid'    => $session_data['uuid'] ,
                   'participant_fname'    => $session_data['participant_fname'] ,
                   'participant_lname'    => $session_data['participant_lname'] ,
                   'participant_phonenumber'   => $session_data['participant_phonenumber'] ,
                   'participant_email'       => $session_data['participant_email'] , 
                   'participant_id'       => $session_data['participant_id'] , 
                   'participant_password'    => $session_data['participant_password'] ,
                   'approved'    => $session_data['approved'] ,
                   'status'    => $session_data['status'] ,
                   'date_registered'   => $session_data['date_registered'] ,
                   'confirm_token'   => $session_data['confirm_token'] ,
                   'logged_in'  => 1
      ); 
      // $sess = $this->auth_m->addsession($setting_session);
      $this->session->set_userdata($setting_session);

      //echo "<pre>";print_r($this->session->all_userdata());die();   
        
    }



	public function logout()
    {
        $sess_log = $this->session->userdata('session_id');
        $log = $this->auth_m->logoutparticipant($sess_log);

        $this->session->sess_destroy();
        redirect('/');
    }

    public function checkLogin(){
		if($this->session->userdata('userid') == ""){
			redirect('Auth/signin/','refresh');
		}
	}






}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */