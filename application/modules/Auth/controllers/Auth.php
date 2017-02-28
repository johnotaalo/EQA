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
		$this->assets
					->addJs('plugin/select2/js/select2.full.min.js');
		$this->assets->setJavascript('Auth/authjs');
		$this->template->setPageTitle('External Quality Assurance Programme')->setPartial('signup')->authTemplate();
	}

	public function signin()
	{
		$this->assets->addCss('css/signin.css');
		$this->template->setPageTitle('External Quality Assurance Programme')->setPartial('signin')->authTemplate();
	}

	public function verify($email, $token){
		$this->load->model('Participant/M_Participant');
		$token = urldecode($token);
		$user = $this->M_Participant->findParticipantByIdentifier('participant_email', $email);
		if($user){
			if ($token == $user->confirm_token) {
				$update_data = [
					'confirm_token'	=>	NULL,
					'status'		=>	1
				];

				$this->db->update('participants', $update_data);
				redirect('Auth/signin','refresh');
			}else{
				echo "Invalid Token";
			}
		}else{
			echo "Email not registered";
		}
	}

	public function participantLogin(){
		$participant = $this->auth_m->check_participant_exist();
		$this->load->library('Hash');
		if($participant){
			if (password_verify($this->input->post('password'), $participant->participant_password)) {
				$session_data = array(
		        	'id'	=>	$participant->uuid
		        );

		        $this->set_session($session_data);
				redirect('Dashboard','refresh');
			}	
		}else{
			$this->session->set_flashdata('error', 'Username or Password is incorrect. Please try again');
			redirect('Auth/signin');
		}
	}

	public function authenticate(){
		$user = $this->auth_m->findUser($this->input->post('username'));
		if ($user) {
			$this->load->library('Hash');
			if (password_verify($this->input->post('password'), $user->password)) {
				$session_data = [
					'uuid'			=>	$user->uuid,
					'type'			=>	$user->user_type,
					'is_logged_in'	=>	true
				];

				$this->set_session($session_data);
				redirect('Dashboard', 'refresh');
			}
		}
		$this->session->set_flashdata('error', 'Username or Password is incorrect. Please try again');
		redirect('Auth/signin', 'refresh');
	}

	private function set_session($session_data){
		$this->session->set_userdata($session_data);        
    }

    public function completeSignUp($email){
    	$data['email'] = $email;
    	$this->template->setPageTitle('Complete Registration')
    					->setPartial('Auth/complete_sign_up_v', $data)
    					->frontEndTemplate();
    }



	public function logout()
    {
        $this->session->sess_destroy();
        redirect('Auth/signin');
    }

    public function checkLogin(){
		if($this->session->userdata('is_logged_in') != true){
			redirect('Auth/signin/','refresh');
		}
	}
}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */