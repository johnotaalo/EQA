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

}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */