<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailer
{
	protected $ci;
	protected $transport;

	public function __construct()
	{
        $this->ci =& get_instance();
        $this->ci->load->config('mail');
        $this->transport = Swift_SmtpTransport::newInstance(
        	$this->ci->config->item('server'),
        	$this->ci->config->item('port'),
        	$this->ci->config->item('security'))
        	->setUsername($this->ci->config->item('from'))
        	->setPassword($this->ci->config->item('password'));
        
	}

	public function sendMail($to, $subject, $body){
		$message = Swift_Message::newInstance();

		$message->setSubject($subject)
				->setFrom($this->ci->config->item('from'), $this->ci->config->item('fromName'))
				->setTo($to)
				->setBody($body, 'text/html');
		$mailer = Swift_Mailer::newInstance($this->transport);

		$result = $mailer->send($message);

		if ($result) {
			return true;
		}else{
			return false;
		}
	}

	

}

/* End of file Mailer.php */
/* Location: ./application/libraries/Mailer.php */
