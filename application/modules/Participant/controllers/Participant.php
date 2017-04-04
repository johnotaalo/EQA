<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participant extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Participant/M_Participant');
		$this->load->library('Mailer');
	}
	function register(){
		if ($this->input->server('REQUEST_METHOD') == "POST") {
			$facility = $this->input->post('facility');
			$participant_id = $this->generateParticipantID($facility);

			//echo "<pre>";print_r($participant_id);echo "</pre>";die();

			$surname = $this->input->post('surname');
			$firstname = $this->input->post('firstname');
			$emailaddress = $this->input->post('email_address');
			$phonenumber = $this->input->post('phonenumber');
			
			$usertype = $this->input->post('usertype');
			$password = $this->input->post('password');

			$token =  $this->hash->hashPassword(bin2hex(openssl_random_pseudo_bytes(16)));
			$participant_insert = [
				'participant_id'			=>	$participant_id,
				'participant_lname'			=>	$surname,
				'participant_fname'			=>	$firstname,
				'participant_phonenumber'	=>	$phonenumber,
				'participant_email'			=>	$emailaddress,
				'participant_password'		=>	$this->hash->hashPassword($password),
				'confirm_token'				=>	$token,
				'user_type'				=>	$usertype,
				'participant_facility'		=>	$facility
			];

			$encoded_token = urlencode($token);
			$verification_url = $this->config->item('server_url') . 'Auth/verify/' . $emailaddress . '/' . $encoded_token;
			$this->db->insert('participants', $participant_insert);
			$id = $this->db->insert_id();

			$equipment = $this->input->post('equipment');
			$equipment_insert = [];
			foreach ($equipment as $equipment_id) {
				$equipment_insert[] = [
					'participant_id'	=>	$id,
					'equipment_id'		=>	$equipment_id
				];
			}

			$this->db->insert_batch('participant_equipment', $equipment_insert);

			$data = [
				'participant_name'	=>	$surname . " " . $firstname,
				'url'				=>	$verification_url
			];

			$body = $this->load->view('Template/email/signup_v', $data, TRUE);
			$sent = $this->mailer->sendMail($emailaddress, "Registration Complete", $body);
			if ($sent == FALSE) {
				log_message('error', "The system could not send an email to {$emailaddress}. Participant Name: $surname $firstname at " . date('Y-m-d H:i:s'));
			}

			redirect('Auth/completeSignUp/' . $emailaddress);
		}else{
			redirect('Auth/signUp','refresh');
		}
	}

	private function generateParticipantID($facility_id){
		$prefix = $this->M_Participant->getFacilityCode($facility_id)->facility_code;

		$max_id = $this->M_Participant->getMaxParticipant()->highest;
		if (!$max_id) {
			$max_id = 0;
		}

		$next = $max_id + 1;
		//echo "<pre>";print_r($prefix);echo "</pre>";die();

		return $prefix."-".str_pad($next, 3, "0", STR_PAD_LEFT);
		
	}
}

/* End of file Participant.php */
/* Location: ./application/modules/Participant/controllers/Participant.php */