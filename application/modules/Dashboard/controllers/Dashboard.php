<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends DashboardController {
	public function __construct(){
		parent::__construct();
		$this->load->model('dashboard_m');
	}
	
	public function index()
	{
		$type = $this->session->userdata('type');
		$this->assets->addCss('css/main.css');
		$this->assets->addJs('js/main.js');
		$view = "admin_dashboard";
		if($type == 'participant'){
			$view = "dashboard_v";
		}elseif($type == "admin"){
			$view = "admin_dashboard";
		}
		$this->template->setPageTitle('EQA Dashboard')->setPartial($view)->adminTemplate();
	}

}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */