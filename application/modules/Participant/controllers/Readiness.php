<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Readiness extends MY_Controller {

	public function __construct(){
		parent::__construct();

		
		$this->load->model('M_Readiness');
	}

	public function authenticate()
	{
		$this->assets
			->addJs('dashboard/js/libs/jquery.validate.js')
            ->addJs("plugin/sweetalert/sweetalert.min.js");
        $this->assets->setJavascript('Participant/participant_login_js');
		$this->assets->addCss('css/signin.css');
		$this->template->setPageTitle('Readiness Form')->setPartial('login_v')->authTemplate();
	}

	public function authentication(){
		$user = $this->M_Readiness->findParticipant($this->input->post('usname'));
		//echo "<pre>";print_r($user);echo "</pre>";die();
		if ($user) {
			if($user->status == 1){
			$this->load->library('Hash');
				if (password_verify($this->input->post('passwd'), $user->password)) {
					
					$session_data = [
						'uuid'				=>	$user->uuid,
						'username'			=>	$user->username,
						'firstname'			=>	$user->firstname,
						'lastname'			=>	$user->lastname,
						'phone'				=>	$user->phone,
						'emailaddress'		=>	$user->email_address,
						'facilitycode'		=>	$user->facility_code,
						'facilityname'		=>	$user->facility_name,
						'facilityphone'		=>	$user->telephone,
						'facilityaltphone'	=>	$user->alt_telephone,
						'is_logged_in'		=>	true
					];

					$this->set_session($session_data);
					echo "true";
				}
			}else{
				echo "not_active";
			}
		}else{
			echo "false";
		}
		
		$this->session->set_flashdata('error', 'Username or Password is incorrect. Please try again');
		redirect('Participant/Readiness/authenticate', 'refresh');
	}
	
	private function set_session($session_data){
		$this->session->set_userdata($session_data);        
    }

	public function logout()
    {
        $this->session->sess_destroy();
        redirect('Participant/Readiness/authenticate');
    }

    public function checkLogin(){
		if($this->session->userdata('is_logged_in') != true){
			redirect('Participant/Readiness/authenticate/','refresh');
		}
	}

	public function readinessChecklist(){
		$data = [];

		$user_details = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));
		//echo "<pre>";print_r($user_details);echo "</pre>";die();
        $data = [
            'user'  =>  $user_details
        ];

        $title = "Readiness Form";

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        $this->assets->setJavascript('Participant/readiness_form_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('readiness_form_v', $data)
                ->readinessTemplate();
	}

	
}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */