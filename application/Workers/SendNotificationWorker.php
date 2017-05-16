<?php
namespace EQA;

use EQA\SendNotificationWorker;

class SendNotificationWorker{
	protected $ci;
	function __construct(){
		$this->ci =& get_instance();
		$file = fopen(APPPATH . "cache/test.txt","w");
		echo fwrite($file,"Hello World. Testing!");
		fclose($file);
	}
	function perform(){
		$this->ci->load->library('Mailer');
		$users = $this->ci->db->get('users_v')->result();
		if ($users) {
			foreach ($users as $user) {
				$body = $this->ci->load->view('Template/email/signup_v', $data, TRUE);
				$sent = $this->ci->mailer->sendMail($user->email_address, "We Work!", $body);
				$details = new StdClass;

				$details->emailaddress = $user->email_address;
				$details->status = $sent;

				$this->ci->db->insert('queue_results', $details);
			}
		}
	}
}