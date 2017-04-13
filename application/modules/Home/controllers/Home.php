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

}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */