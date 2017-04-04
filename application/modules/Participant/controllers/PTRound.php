<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PTRound extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Participant/M_PTRound');
		$this->load->library('Mailer');
	}

	public function index(){
		
			$data = [
                'pt_rounds'    =>  $this->createPTRoundTable()
            ];

			$this->template->setPageTitle('EQA Dashboard')->setPartial("pt_view",$data)->adminTemplate();
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

	public function Round($round_uuid){
		$data = [
                'pt_uuid'    =>  $round_uuid,
                'participant_report' => 'participant_report',
                'data_submission' => 'data_submission',
                'equipment_information' => 'equipment_information'
            ];
                
		$this->assets
			->addJs('dashboard/js/libs/jquery.validate.js')
            ->addJs("plugin/sweetalert/sweetalert.min.js");
        $this->assets->setJavascript('Participant/participant_login_js');
		$this->assets->addCss('css/signin.css');
		$this->template->setPageTitle('PT Forms')->setPartial('pt_form_v',$data)->adminTemplate();
	}

	public function Tracking($round_uuid){
		$data['pt_uuid']	=	$round_uuid;
		$this->assets
			->addJs('dashboard/js/libs/jquery.validate.js')
            ->addJs("plugin/sweetalert/sweetalert.min.js");
        $this->assets->setJavascript('Participant/participant_login_js');
		$this->assets->addCss('css/signin.css');
		$this->template->setPageTitle('PT Forms')->setPartial('pt_tracking_v',$data)->adminTemplate();
	}
	

}

/* End of file Participant.php */
/* Location: ./application/modules/Participant/controllers/PTRound.php */