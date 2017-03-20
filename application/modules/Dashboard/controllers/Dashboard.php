<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends DashboardController {
	public function __construct(){
		parent::__construct();
		$this->load->model('dashboard_m');
		

	}
	
	public function index()
	{

		$data = [];

		$type = $this->session->userdata('type');
		$this->assets->addCss('css/main.css');
		$this->assets->addJs('js/main.js');
		$view = "admin_dashboard";
		if($type == 'participant'){
			$view = "dashboard_v";
			$data = [

			];
		}elseif($type == "admin"){
			$view = "admin_dashboard";
			$data = [
                'pending_participants'    =>  $this->dashboard_m->pendingParticipants(),
                'new_equipments'    =>  $this->dashboard_m->newEquipments()
            ];
			
			//echo'<pre>';print_r($data);echo '</pre>';die();

		}
		$this->template->setPageTitle('EQA Dashboard')->setPartial($view,$data)->adminTemplate();
	}

}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */