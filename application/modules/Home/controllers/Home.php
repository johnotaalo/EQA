<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('home_m');
	}
	
	// public function index()
	// {
	// 	$this->template->setPageTitle('External Quality Assurance Programme')->setPartial('home_v')->frontEndTemplate();
	// }

	public function index()
	{
		$this->template->setPageTitle('External Quality Assurance Programme')->setPartial('home_v2')->frontEndTemplate2();
	}

    public function FAQ()
    {
        $this->template->setPageTitle('External Quality Assurance Programme')->setPartial('faq')->frontEndTemplate2();
    }


	function sendMessage($round_uuid,$particapant_uuid){
        if($this->input->post()){
            
            $fname = $this->input->post('fname');
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            $email_to = "nhrlcd4eqa@nphls.or.ke";

            $data = [
                'names'  	=>  $fname,
                'email'  	=>  $email,
                'subject'  	=>  $subject,
                'message'  	=>  $message,
                'to'		=>  $email_to
            ];

            $body = $this->load->view('Template/email/message_v', $data, TRUE);
            $this->load->library('Mailer');
            $sent = $this->mailer->sendMail($email_to, $subject, $body);
            if ($sent == FALSE) {
                log_message('error', "The system could not send an email to {$email_to}, from: $fname at " . date('Y-m-d H:i:s'));
            }
                      
            redirect('Home/', 'refresh');
        }
    }

}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */