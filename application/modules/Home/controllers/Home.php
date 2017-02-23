<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('home_m');
	}
	
	public function index()
	{
		$this->assets->addCss('css/main.css');
		$this->assets->addJs('js/main.js');
		$this->template->setPageTitle('External Quality Assurance Programme')->setPartial('home_v')->frontEndTemplate();
	}

}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */