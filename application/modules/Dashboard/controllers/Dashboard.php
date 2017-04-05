<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends DashboardController {
	public function __construct(){
		parent::__construct();
		$this->load->model('dashboard_m');
	}
	
	public function index()
	{
		$ongoing_pt = $this->db->get_where('pt_round_v', ['type'=>'ongoing'])->row();
		$data = [];

		$type = $this->session->userdata('type');
		$this->assets->addCss('css/main.css');
		$this->assets->addJs('js/main.js');

		$view = "admin_dashboard";
		if($type == 'participant'){
			$this->load->model('participant/M_Participant');
			$view = "dashboard_v";
			$data = [
				'dashboard_data'	=>	$this->getParticipantDashboardData($this->session->userdata('uuid')),
				'participant'		=>	$this->M_Participant->findParticipantByIdentifier('uuid', $this->session->userdata('uuid'))
			];
			$this->assets
				->addJs('dashboard/js/libs/moment.min.js')
				->addJs('dashboard/js/libs/fullcalendar.min.js')
				->addJs('dashboard/js/libs/gcal.js');

			$this->assets->setJavascript('PTRounds/calendar_js');
		}elseif($type == "admin"){
			$view = "admin_dashboard";
			$data = [
                'pending_participants'    =>  $this->dashboard_m->pendingParticipants(),
                'new_equipments'    =>  $this->dashboard_m->newEquipments()
            ];
		}else if($type == "qareviewer"){
            $view = "qa_dashboard";
            $data = [
            
            ];
        }
		$this->template->setPageTitle('EQA Dashboard')->setPartial($view,$data)->adminTemplate();
	}

	private function getParticipantDashboardData($participant_uuid){
		$dashboard_data = new StdClass();
		$dashboard_data->current = "";
		$this->db->where('type', 'ongoing');
		$this->db->where('status', 'active');
		$query = $this->db->get('pt_round_v');

		$dashboard_data->calendar_legend = $this->createCalendarLegend();

		if($query->num_rows() == 1){
			$dashboard_data->rounds = $query->num_rows();
			$pt_round = $query->row();
			$readiness = $this->db->get_where('participant_readiness', ['participant_id'=>$participant_uuid, 'pt_round_no' => $pt_round->uuid])->row();
			$dashboard_data->pt_round = $pt_round;

			$today =  date('Y-m-d');

			$this->db->select('c.item_name, c.colors, ptc.date_from, ptc.date_to');
			$this->db->from('pt_calendar ptc');
			$this->db->join('calendar_items c', 'c.id = ptc.calendar_item_id');
			$this->db->join('pt_round pr', 'pr.id = ptc.pt_round_id');
			$this->db->where('pr.uuid', $pt_round->uuid);
			$this->db->where("ptc.date_from <=", $today);
			$this->db->where("ptc.date_to >=", $today);

			$calendar_query = $this->db->get();
			$dashboard_data->calendar_current = new StdClass();
			$dashboard_data->calendar_current->color = "";
			if($calendar_query->num_rows() > 1){
				$calendar_current_list = "<ul>";
				foreach ($calendar_query->result() as $value) {
					$days_left = $this->calculateDateDifference($value->date_to);

					$calendar_current_list .= "<li>$value->item_name: $days_left Left</li>";
				}
				$calendar_current_list .= "</ul>";
				$dashboard_data->calendar_current->name = $calendar_current_list;
			}elseif($calendar_query->num_rows() == 1){
				$item = $calendar_query->row();
				$days_left = $this->calculateDateDifference($item->date_to);
				$dashboard_data->calendar_current->name = $item->item_name . ": $days_left Left";
				$dashboard_data->calendar_current->color = $item->colors;
			}else{
				$dashboard_data->calendar_current = "No Current Item";
			}

			if($readiness){
				$this->db->where('readiness_uuid', $readiness->uuid);
				$this->db->where('pt_round_uuid', $pt_round->uuid);
				$participant_readiness = $this->db->get('pt_ready_participants')->row();
				$dashboard_data->readiness = $participant_readiness;

				if($participant_readiness->status_code == 2){
					$dashboard_data->current = "enroute";
				}elseif($participant_readiness->status_code == 3){
					if($participant_readiness->panel_condition == 1){
						$dashboard_data->current = "pt_round_submission";
					}else{
						$dashboard_data->current = "bad_panel";
					}
				}
			}else{
				$dashboard_data->current = "readiness";
			}
			
		}else{
			$dashboard_data->rounds = $query->num_rows();
		}

		return $dashboard_data;
	}	

	function calculateDateDifference($date1, $date2 = NULL, $format = NULL){
		$date_time_1 = date_create($date1);
		$date_time_2 = ($date2 == NULL) ? date_create(date('Y-m-d')) : date_create($date2);

		$interval = date_diff($date_time_1, $date_time_2);
		$format = ($format == NULL) ? '%a Days' : $format;
		$difference = $interval->format($format);

		return $difference;
	}

	private function createCalendarLegend(){
		$calendar_items = $this->db->get('calendar_items')->result();
		$calendar_legend = "";
		if ($calendar_items) {
			foreach ($calendar_items as $calendar_item) {
				$calendar_legend .= "<div class = 'm-1 clearfix'>
				<div class = 'pull-left' style = 'width: 30px;height:30px;background-color: {$calendar_item->colors};opacity: .3;'></div>
				<p class = 'pull-left ml-1'>{$calendar_item->item_name}</p>
				</div>";
			}
		}
		
		return $calendar_legend;
	}
}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */