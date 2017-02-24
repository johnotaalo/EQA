<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participant extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Participant/M_Participant');
	}
	function register(){
		if ($this->input->server('REQUEST_METHOD') == "POST") {
			$participant_id = $this->generateParticipantID();
			$surname = $this->input->post('surname');
			$firstname = $this->input->post('firstname');
			$emailaddress = $this->input->post('participantEmail');
			$phonenumber = $this->input->post('phonenumber');
			$facility = $this->input->post('facility');

			$token =  $this->hash->hashPassword(bin2hex(openssl_random_pseudo_bytes(16)));

			$participant_insert = [
				'participant_id'			=>	$participant_id,
				'participant_lname'			=>	$surname,
				'participant_fname'			=>	$firstname,
				'participant_phonenumber'	=>	$phonenumber,
				'participant_email'			=>	$emailaddress,
				'participant_password'		=>	$this->hash->hashPassword('12345'),
				'confirm_token'				=>	$token
			];

			$encoded_token = urlencode($token);
			$verification_url = $this->config->item('server_url') . 'Auth/verify/' . $emailaddress . '/' . $encoded_token;
			echo $token . '<br/>';
			echo $verification_url;
			echo "<br/>";
			echo urldecode($encoded_token);

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
		}else{
			redirect('Auth/signUp','refresh');
		}
	}

	private function generateParticipantID(){
		$prefix = "NHRL-EQA/CD4/";
		$max_id = $this->M_Participant->getMaxParticipant()->highest;
		if (!$max_id) {
			$max_id = 0;
		}

		$next = $max_id + 1;
		return $prefix.str_pad($next, 3, "0", STR_PAD_LEFT);
	}
}

/* End of file Participant.php */
/* Location: ./application/modules/Participant/controllers/Participant.php */