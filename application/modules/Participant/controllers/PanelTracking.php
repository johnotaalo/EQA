<?php

class PanelTracking extends DashboardController{
	function __construct(){
		parent::__construct();
	}

	function confirm($panel_tracking_uuid){
		$data = [];
		$panel_tracking = $this->db->get_where('pt_ready_participants', ['panel_tracking_uuid'=>$panel_tracking_uuid])->row();
		if($panel_tracking){
			if($panel_tracking->status_code == 3){
				$this->session->set_flashdata('success', 'You have successfully submitted your confirmation. Please confirm whether you are able to access the PT Round Submission Form. If not, please contact the NHRL Administrator for further guidance on what next should happen.');
			}
			$data = [
				'panel_tracking_uuid'	=>	$panel_tracking_uuid
			];

			$this->assets
					->addCss('dashboard/js/libs/icheck/skins/flat/blue.css')
					->addCss('dashboard/js/libs/icheck/skins/flat/green.css')
					->addCss('dashboard/js/libs/icheck/skins/flat/red.css')
					->addCss('plugin/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');

			$this->assets
					->addJs('dashboard/js/libs/moment.min.js')
					->addJs('plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js')
					->addJs('dashboard/js/libs/icheck/icheck.min.js');

			$this->assets
					->setJavascript('Participant/paneltracking/confirm_js');

			$this->template
					->setPageTitle('Participant Confirming Panel')
					->setPartial('Participant/paneltracking/confirm_v', $data)
					->readinessTemplate();
		}else{
			show_404();
		}
	}

	function submitConfirmation($panel_tracking_uuid){
		if ($this->input->post()) {
				$update_data = [
					'participant_received_date'	=>	date('Y-m-d', strtotime($this->input->post('participant_received_date'))),
					'tubes_broken'			=>	$this->input->post('tubes_broken'),
					'tubes_leaking'			=>	$this->input->post('tubes_leaking'),
					'tubes_cracked'			=>	$this->input->post('tubes_cracked'),
					'insufficient_volume'	=>	$this->input->post('insufficient_volume'),
					'haemolysed_sample'	=>	$this->input->post('haemolysed_sample'),
					'clotted_sample'	=>	$this->input->post('clotted_sample'),
					'duplicate_sample'	=>	$this->input->post('duplicate_sample'),
					'missing_sample'	=>	$this->input->post('missing_sample'),
					'mismatch'	=>	$this->input->post('mismatch'),
					'panel_condition_comment'	=>	$this->input->post('condition_comment'),
					'panel_received_entered'	=>	date('Y-m-d H:i:s'),
					'acceptance'	=>	1
				];

				$this->db->where('uuid', $panel_tracking_uuid);
				$this->db->update('pt_panel_tracking', $update_data);
				
				$this->session->set_flashdata('success', "You have successfully submitted your confirmation. Please confirm whether you are able to access the PT Round Submission Form. If not, please contact the NHRL Administrator for further guidance on what next should happen.");
			
			redirect('Participant/PanelTracking/confirm/' . $panel_tracking_uuid);	
		}else{
			$this->session->set_flashdata('error', "There was a problem in submitting the receipt. Please try again");
			redirect('Participant/PanelTracking/confirm/' . $panel_tracking_uuid);
		}
		
	}
}