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
			$data['pt_rounds'] = $this->createPTRoundTable();
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


	function createPTRoundTable(){
        $rounds = $this->db->get('pt_round_v')->result();
        $ongoing = $prevfut = '';
        $round_array = [];
        if ($rounds) {
            foreach ($rounds as $round) {
                $created = date('dS F, Y', strtotime($round->date_of_entry));
                $view = "<a class = 'btn btn-success btn-sm' href = '".base_url('Participant/PTRound/Round/' . $round->uuid)."'><i class = 'fa fa-eye'></i>&nbsp;View</a>";
                $panel_tracking = "<a class = 'btn btn-danger btn-sm' href = '".base_url('Participant/PTRound/Tracking/' . $round->uuid)."'><i class = 'fa fa-truck'></i>&nbsp;Panel Tracking</a>";
                $status = ($round->status == "active") ? '<span class = "tag tag-success">Active</span>' : '<span class = "tag tag-danger">Inactive</span>';
                if ($round->type == "ongoing") {
                    $ongoing .= "<tr>
                    <td>{$round->pt_round_no}</td>
                    <td>{$created}</td>
                    <td>{$status}</td>
                    <td>{$view} {$panel_tracking}</td>
                    </tr>";
                }else{
                    $prevfut .= "<tr>
                    <td>{$round->pt_round_no}</td>
                    <td>{$created}</td>
                    <td>{$status}</td>
                    <td>{$view} {$panel_tracking}</td>
                    </tr>";
                }
            }
        }

        $round_array = [
            'ongoing'   =>  $ongoing,
            'prevfut'   =>  $prevfut
        ];

        return $round_array;
    }

}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */