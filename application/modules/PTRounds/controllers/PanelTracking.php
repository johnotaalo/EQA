<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PanelTracking extends DashboardController {
	function __construct(){
		parent::__construct();

		$this->load->model('PTRounds/M_PanelTracking');
		$this->load->module('Export');
		$this->load->library('Mailer');
	}

	public function details($pt_uuid)
	{
		$data['pt_uuid'] = $pt_uuid;
		$data['stats'] = $this->getStatistics($pt_uuid);
		$this->assets->addCss("plugin/sweetalert/sweetalert.css");
		$this->assets
				->addJs("dashboard/js/libs/jquery.dataTables.min.js")
				->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
				->addJs("plugin/sweetalert/sweetalert.min.js")
				->setJavascript('PTRounds/paneltracking/details_js', ['pt_round_uuid'=>$pt_uuid]);
		$this->template
				->setPartial('PTRounds/paneltracking/details_v', $data)
				->adminTemplate();
	}

	function getStatistics($pt_uuid){
		$statistics = $this->db->query("SELECT
		(SELECT count(pb.id) as batches FROM pt_batches pb
		JOIN pt_round pr ON pb.pt_round_id = pr.id
		WHERE pr.uuid = '{$pt_uuid}') AS batches,
		(SELECT count(readiness_id) FROM pt_ready_participants 
		WHERE pt_round_uuid = '{$pt_uuid}' AND status_code = 1) AS panels_prepared,
		(SELECT count(readiness_id) FROM pt_ready_participants 
		WHERE pt_round_uuid = '{$pt_uuid}' AND status_code = 2) AS enroute,
		(SELECT count(readiness_id) FROM pt_ready_participants 
		WHERE pt_round_uuid = '{$pt_uuid}' AND status_code = 3) AS received")->row();

		return $statistics;
	}
	function batches($pt_uuid){
		$data['pt_uuid'] = $pt_uuid;
		$pt_round = $this->db->get_where('pt_round', ['uuid'=>$pt_uuid])->row();
		if ($pt_round) {
			$no_of_tubes = $this->db->get_where('pt_tubes', ['pt_round_id'=>$pt_round->id])->num_rows();
			if ($no_of_tubes == 0) {
				$this->createTrackingTubes($pt_round->id);
			}

			$data['batch_table'] = $this->createBatchTable($pt_round->id);

			$this->assets->setJavascript('PTRounds/paneltracking/batches_js');
			$this->template
				->setPartial('PTRounds/paneltracking/batches_v', $data)
				->adminTemplate();
		}else{
			show_404();
		}
	}

	private function createTrackingTubes($pt_id){
		$samples = $this->db->get_where('pt_samples', ['pt_round_id'=>$pt_id])->num_rows();
		if($samples != 0){
			$tubes = [];
			$number = 1;
			for ($i=0; $i < $samples; $i++) { 
				$tubes[] = [
					'tube_name'		=>	'Tube ' . $number,
					'pt_round_id'	=>	$pt_id
				];
				$number++;
			}

			$inserted = $this->db->insert_batch('pt_tubes', $tubes);
		}
	}

	private function createBatchTable($pt_id){
		$tubes = $this->db->get_where('pt_tubes', ['pt_round_id'=>$pt_id])->result();
		$batches = $this->db->get_where('pt_batches', ['pt_round_id'=>$pt_id])->result();
		$header = [];
		$header = [
			'#',
			'Batch No',
			"Tubes",
			"Details",
			"Delete"
		];

		$body = [];
		if ($batches) {
			$counter = 1;
			$key_counter = 0;
			foreach ($batches as $batch) {
				$body[$key_counter][] = $counter;
				$body[$key_counter][] = $batch->batch_name;
				$batch_tubes = $this->db->query("SELECT pt.tube_name, ps.sample_name FROM pt_batch_tube ptb
					JOIN pt_tubes pt ON pt.id = ptb.tube_id
					JOIN pt_samples ps ON ps.id = ptb.sample_id
					WHERE ptb.batch_id = {$batch->id};")->result();
				$tubes_list = "<ul>";
				foreach ($batch_tubes as $tube) {
					$tubes_list .= "<li>{$tube->tube_name}: {$tube->sample_name}</li>";
				}
				$tubes_list .= "</ul>";
				$body[$key_counter][] = $tubes_list;
				$body[$key_counter][] = "";
				$body[$key_counter][] = "";
				$key_counter++;
				$counter++;
			}
		}

		$this->load->library('table');
		$this->load->config('table');
		$template = $this->config->item('default');
		$this->table->set_heading($header);
		$this->table->set_template($template);
		return $this->table->generate($body);
	}

	function add($pt_uuid, $batch_uuid = NULL){
		$data['pt_uuid'] = $pt_uuid;
		$pt_round = $this->db->get_where('pt_round', ['uuid'=>$pt_uuid])->row();
		$title = ($batch_uuid == NULL) ? "Create new batch" : "";
		$tubes_list = "";
		if ($batch_uuid == NULL) {
			$tubes = $this->db->get_where('pt_tubes', ['pt_round_id'=>$pt_round->id])->result();
			$batch_name = $this->pt_brand_name($pt_round->id);
			foreach ($tubes as $tube) {
				$tubes_list .= "<div class = 'form-group'>";
				$tubes_list .= "<label>{$tube->tube_name}</label>";
				$tubes_list .= "<select class = 'form-control' name = 'test_{$tube->uuid}'>";
				$samples = $this->db->get_where('pt_samples', ['pt_round_id'=>$pt_round->id])->result();
				foreach ($samples as $sample) {
					$tubes_list .= "<option value = '{$sample->uuid}'>{$sample->sample_name}</option>";
				}
				$tubes_list .= "</select>";
				$tubes_list .= "</div>";
			}
		}
		$data['tubes_list'] = $tubes_list;
		$data['batch_name'] = $batch_name;
		$return_data = [];

		$return_data = [
			'status'	=>	TRUE,
			'title'		=>	$title,
			'page'		=>	$this->load->view('PTRounds/paneltracking/new_batch_v', $data, TRUE)
		];

		return $this->output->set_content_type('application/json')->set_output(json_encode($return_data));
	}

	function pt_brand_name($pt_round_id){
		$this->db->select_max('batch_name');
		$this->db->where('pt_round_id', $pt_round_id);
		$result = $this->db->get('pt_batches')->row();
		if ($result->batch_name) {
			$number = (substr($result->batch_name, strpos($result->batch_name, " ") + 1))+1;
		}else{
			$number = 1;
		}

		return "Batch " . $number;
	}

	function addBatchInfo(){
		if ($this->input->post()) {
			$tube_array = [];
			$pt_round = $this->db->get_where('pt_round', ['uuid'=>$this->input->post('pt_round_uuid')])->row();
			$batch_details = [
				'batch_name' 	=>	$this->input->post('batch_name'),
				'description'	=>	'',
				'pt_round_id'	=>	$pt_round->id
			];

			$this->db->insert('pt_batches', $batch_details);
			$batch_id = $this->db->insert_id();
			foreach ($this->input->post() as $key => $value) {
				if ("test_" == substr($key, 0, 5)) {
					$tube_uuid = str_replace('test_', '', $key);
					$tube = $this->db->get_where('pt_tubes', ['uuid'=>$tube_uuid])->row();
					$sample = $this->db->get_where('pt_samples', ['uuid'=>$value])->row();
					$tube_array[] = [
						'batch_id'	=>	$batch_id,
						'tube_id'	=>	$tube->id,
						'sample_id'	=>	$sample->id
					];
				}
			}
			$this->db->insert_batch('pt_batch_tube', $tube_array);

			$this->session->set_flashdata('success', "Successfully added Batch Information");
			redirect('PTRounds/PanelTracking/batches/' . $this->input->post('pt_round_uuid'));
		}
	}

	function readyFacilities($pt_round_uuid){
		$pt_round = $this->db->get_where('pt_round', ['uuid'=>$pt_round_uuid])->row();
		if ($pt_round) {
			$columns = [];
			$limit = $offset = $search_value = NULL;
			// $columns = [
			// 	0 => "name",
			// 	1 => "participant_email",
			// 	2 => "participant_phonenumber"
			// ];
			$limit = $_REQUEST['length'];
			$offset = $_REQUEST['start'];
			$search_value = $_REQUEST['search']['value'];

			$participants = $this->M_PanelTracking->getReadyFacilities($pt_round_uuid, $search_value, $limit, $offset);
			$data = [];
			if ($participants) {
				foreach ($participants as $participant) {
					$status_temp = "<span class = 'tag tag-%class%'>%text%</span>";
					$search_array = ['%class%', '%text%'];
					$replace_array = [];

					$optional_link = "";
					$track_panel_link = "<a class='dropdown-item' href = '".base_url('PTRounds/PanelTracking/track/' . $participant->readiness_uuid)."'>Track Panel</a>";
					switch ($participant->status_code) {
						case 0:
							$replace_array = ['danger', $participant->status];
							$optional_link = "<a class='dropdown-item' href = '".base_url('PTRounds/PanelTracking/assignBatch/' . $participant->readiness_uuid)."'>Assign Batch</a>";
							$track_panel_link = "";
							break;
						case 1:
							$replace_array = ['warning', $participant->status];
							$optional_link = "<a class='dropdown-item' href = '".base_url('PTRounds/PanelTracking/editBatchAssignment/' . $participant->panel_tracking_uuid)."'>Edit Batch Assignment</a>";
							break;
						case 2:
							$replace_array = ['primary', $participant->status];
							break;
						case 3:
							$replace_array = ['success', $participant->status];
							break;					
						default:
							$replace_array = ['danger', $participant->status];
							break;
					}
					$status = str_replace($search_array, $replace_array, $status_temp);
					$data[] = [
						"$participant->participant_fname $participant->participant_lname",
						$participant->facility_code,
						$participant->facility_name,
						$participant->batch,
						$status,
						"<div class = 'dropdown'>
                        <button class = 'btn btn-secondary dropdown-toggle' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup='true' aria-expanded = 'false'>
                            Quick Actions
                        </button>
                        <div class = 'dropdown-menu' aria-labelledby= = 'dropdownMenuButton'>
                        	$track_panel_link
                        	$optional_link
                        </div>
                        </div>"
					];
				}
			}

			if($this->input->is_ajax_request()){
				$all_participants = $this->M_PanelTracking->getReadyFacilities($pt_round_uuid);
				$total_data = count($all_participants);
				$data_total = count($participants);

				$json_data = [
					"draw"				=>	intval( $_REQUEST['draw']),
					"recordsTotal"		=>	intval($total_data),
					"recordsFiltered"	=>	intval(count($this->M_PanelTracking->getReadyFacilities($pt_round_uuid, $search_value))),
					'data'				=>	$data
				];

				return $this->output->set_content_type('application/json')->set_output(json_encode($json_data));
			}
		}
	}

	function assignBatch($readiness_uuid){
		$readiness = $this->db->get_where('participant_readiness', ['uuid'=>$readiness_uuid])->row();
		if($readiness){
			if ($this->input->post()) {
				$batch_no = $this->input->post('batch_no');
				$batch_preparation_date = $this->input->post('batch_preparation_date');
				$batch_preparation_notes = $this->input->post('batch_preparation_notes');
				$error = "";
				$batch = $this->db->get_where('pt_batches', ['uuid'=>$batch_no])->row();
				if($batch){
					$insert_data = [
						'pt_batch_id'				=>	$batch->id,
						'pt_readiness_id'			=>	$readiness->readiness_id,
						'panel_preparation_date'	=>	date('Y-m-d', strtotime($batch_preparation_date)),
						'panel_preparation_notes'	=>	$batch_preparation_notes
					];

					$insert = $this->db->insert('pt_panel_tracking', $insert_data);
					if($insert != 1){
						$error = "There was a problem inserting your data. Please try again later";
					}
				}else{
					$error = "There was a problem inserting your data. Please try again later";
				}

				if ($error != "") {
					$this->session->set_flashdata('error', $error);
					redirect('PTRounds/PanelTracking/assignBatch/' . $readiness_uuid);
				}else{
					redirect('PTRounds/PanelTracking/details/' . $readiness->pt_round_no, 'refresh');
				}
			}else{
				$pt_round = $this->db->get_where('pt_round', ['uuid'=>$readiness->pt_round_no])->row();

				$this->load->model('Participant/M_Participant');

				$participant_details = $this->M_Participant->findParticipantByIdentifier('uuid', $readiness->participant_id);

				$data = [
					'readiness_uuid'	=>	$readiness_uuid,
					'pt_round_no'		=>	$pt_round->uuid,
					'batches'			=>	$this->batchesDropDown($pt_round->id),
					'participant'		=>	$participant_details,
					'facility'			=>	$this->db->get_where('facility', ['id'	=> $participant_details->participant_facility])->row()
				];

				$this->assets
						->addCss('plugin/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');

				$this->assets
						->addJs('dashboard/js/libs/moment.min.js')
						->addJs('plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js')
						->setJavascript('PTRounds/paneltracking/assignbatch_js', ['from'=>$pt_round->from, 'to'=>$pt_round->to]);
				$this->template
						->setPartial('PTRounds/paneltracking/assign_batch_v', $data)
						->adminTemplate();
			}
		}else{
			redirect('Dashboard', 'refresh');
		}
	}

	function batchesDropDown($pt_round_id, $selected = NULL){
		$batches = $this->db->get_where('pt_batches', ['pt_round_id'=>$pt_round_id])->result();
		$batches_option = "";
		if($batches){
			foreach ($batches as $batch) {
				$selected_val = ($selected != NULL && $selected == $batch->id) ? 'selected' : '';
				$batches_option .= "<option value = '{$batch->uuid}' {$selected_val}>{$batch->batch_name}</option>";
			}
		}

		return $batches_option;
	}

	function editBatchAssignment($panel_tracking_uuid){
		$this->db->where('uuid', $panel_tracking_uuid);
		$tracking = $this->db->get('pt_panel_tracking')->row();

		if($tracking){
			if($this->input->post()){
				$batch_no = $this->input->post('batch_no');
				$batch_preparation_date = $this->input->post('batch_preparation_date');
				$batch_preparation_notes = $this->input->post('batch_preparation_notes');
				$error = "";
				$batch = $this->db->get_where('pt_batches', ['uuid'=>$batch_no])->row();
				if($batch){
					$update_data = [
						'pt_batch_id'				=>	$batch->id,
						'panel_preparation_date'	=>	date('Y-m-d', strtotime($batch_preparation_date)),
						'panel_preparation_notes'	=>	$batch_preparation_notes
					];
					$this->db->where('id', $tracking->id);
					$update = $this->db->update('pt_panel_tracking', $update_data);
					if($update != 1){
						$error = "There was a problem updating your data. Please try again later";
					}
				}else{
					$error = "There was a problem updating your data. Please try again later";
				}

				if ($error != "") {
					$this->session->set_flashdata('error', $error);
				}else{
					$this->session->set_flashdata('success', "Successfully updated the batch assignment");
				}
				redirect('PTRounds/PanelTracking/editBatchAssignment/' . $panel_tracking_uuid);
			}else{
				$readiness = $this->db->get_where('participant_readiness', ['readiness_id' => $tracking->pt_readiness_id])->row();
				$pt_round = $this->db->get_where('pt_round', ['uuid'=>$readiness->pt_round_no])->row();
				$this->load->model('Participant/M_Participant');
				$participant_details = $this->M_Participant->findParticipantByIdentifier('uuid', $readiness->participant_id);
				$data = [
					'panel_tracking_uuid'	=>	$panel_tracking_uuid,
					'pt_round_no'			=>	$readiness->pt_round_no,
					'tracking_data'			=>	$tracking,
					'batches'				=>	$this->batchesDropDown($pt_round->id, $tracking->pt_batch_id),
					'participant'			=>	$participant_details,
					'facility'				=>	$this->db->get_where('facility', ['id'	=> $participant_details->participant_facility])->row()
				];
				$this->assets
						->addCss('plugin/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');

				$this->assets
						->addJs('dashboard/js/libs/moment.min.js')
						->addJs('plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js')
						->setJavascript('PTRounds/paneltracking/assignbatch_js', ['from'=>$pt_round->from, 'to'=>$pt_round->to]);
				$this->template
						->setPartial('PTRounds/paneltracking/assign_batch_v', $data)
						->adminTemplate();
				}
		}else{
			redirect('Dashboard');
		}
	}

	function courierdispatch($pt_round_uuid){
		$pt_round = $this->db->get_where('pt_round', ['uuid'=>$pt_round_uuid])->row();
		if ($pt_round) {
			if ($this->input->post()) {
				$insert_data = [
					'courier_company' => $this->input->post('courier_company'),
					'courier_collection_date' => date('Y-m-d', strtotime($this->input->post('dispatch_date'))),
					'courier_official' => $this->input->post('courier_official'),
					'courier_dispatch_notes' => $this->input->post('dispatch_notes')
				];

				$this->db->where('pt_round_uuid', $pt_round_uuid);
				$this->db->where('status_code', 1);
				$this->db->select('readiness_id,participant_email,panel_tracking_uuid');
				$ready_facilities = $this->db->get('pt_ready_participants')->result();
				foreach ($ready_facilities as $facility) {
					//echo "<pre>";print_r($ready_facilities);echo "</pre>";die();
					$this->db->where('pt_readiness_id', $facility->readiness_id);
					$this->db->update('pt_panel_tracking', $insert_data);


					$data = [
						'panel_tracking_uuid' => $facility->panel_tracking_uuid
					];

					$body = $this->load->view('Template/email/shipment_v', $data, TRUE);
					$sent = $this->mailer->sendMail($facility->participant_email, "Shipment Sent", $body);
				}

				// $this->dispatchList($pt_round_uuid);
				$this->session->set_flashdata('success', "Successfully dispatched the panels to {$insert_data['courier_company']}");
				redirect('PTRounds/PanelTracking/details/' . $pt_round_uuid);
			}else{
				$data = [
					'pt_round_no'	=>	$pt_round_uuid
				];
				$this->assets
						->addCss('plugin/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');

				$this->assets
						->addJs('dashboard/js/libs/moment.min.js')
						->addJs('plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js')
						->setJavascript('PTRounds/paneltracking/dispatch_js');
				$this->template
						->setPartial('PTRounds/paneltracking/courierdispatch_v', $data)
						->adminTemplate();
			}
		}else{
			redirect('Dashboard', 'refresh');
		}
	}

	function dispatchList($pt_round_uuid){
		$table_header = [
			'#',
			'Recepient Name',
			'Recepient Phone',
			'Facility Name',
			'G4S Branch'
		];

		$this->db->where('pt_round_uuid', $pt_round_uuid);
		$this->db->where('status_code', 2);
		$dispatch_ready = $this->db->get('pt_ready_participants')->result();
		$table_body = [];
		if ($dispatch_ready) {
			$counter = 1;
			foreach ($dispatch_ready as $ready) {
				$table_body[] = [
					$counter,
					"$ready->participant_fname $ready->participant_lname",
					$ready->participant_phonenumber,
					$ready->facility_name,
					$ready->G4S_branch_name
				];

				$counter++;
			}
		}

		$this->load->library('table');
		$this->load->config('table');

		$template = $this->config->item('default');

		$this->table->set_heading($table_header);
		$this->table->set_template($template);

		$viewData['dispatch_list'] = $this->table->generate($table_body);
		$pdf_view = $this->load->view('PTRounds/paneltracking/dispatch_list_v', $viewData, TRUE);		
		$data['document_title'] = "Dispatch List - Panel Tracking - " . date('d-m-Y');
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->AddPage("L");
		$stylesheet = file_get_contents('./assets/dashboard/css/style.css');

		$pdf->WriteHTML($stylesheet, 1);
		$pdf->WriteHTML($pdf_view, 2);

		$pdf->output('Dispatch List ' . date('d-m-Y') . '.pdf', 'D');
	}

	function track($readiness_uuid){
		$data = [];
		
		$readiness = $this->db->get_where('participant_readiness', ['uuid' => $readiness_uuid])->row();
		if($readiness){
			$data = [
				'pt_round_no'	=>	$readiness->pt_round_no,
				'tracking'		=>	$this->db->get_where('pt_ready_participants', ['readiness_uuid'	=>	$readiness_uuid, 'pt_round_uuid' => $readiness->pt_round_no])->row()
			];
			$this->template
					->setPartial('PTRounds/paneltracking/track_v', $data)
					->adminTemplate();
		}
		else{
			show_404();
		}
	}

	function getDispatchRatio($pt_round_uuid){
		$this->db->where('status_code', 1);
		$this->db->where('pt_round_uuid', $pt_round_uuid);
		$courier_ready = $this->db->get('pt_ready_participants')->num_rows();

		$this->db->where('verdict', 1);
		$this->db->where('pt_round_no', $pt_round_uuid);
		$total_participants = $this->db->get('participant_readiness')->num_rows();

		$ratio = $courier_ready / $total_participants;

		$response = [
			'ready'	=>	$courier_ready,
			'total'	=>	$total_participants,
			'ratio'	=>	$ratio
		];

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}

/* End of file PanelTracking.php */
/* Location: ./application/modules/PTRounds/controllers/PanelTracking.php */