<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('dashboard_m');
		$this->load->module('Auth');
		$this->auth->checkLogin();
	}
	
	public function index()
	{
		$this->assets->addCss('css/main.css');
		$this->assets->addJs('js/main.js');
		$view = "";
		if($this->session->userdata('type') == 'participant'){
			$view = "dashboard_v";
		}
		$this->template->setPageTitle('EQA Dashboard')->setPartial($view)->adminTemplate();
	}

}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */