<?php

class PanelTracking extends DashboardController{
	function __construct(){
		parent::__construct();

		$this->load->module('Participant');
		$this->load->model('M_PTRound');
	}

	function confirm($panel_tracking_uuid){
		$data = [];
		$panel_tracking = $this->db->get_where('pt_ready_participants', ['panel_tracking_uuid'=>$panel_tracking_uuid])->row();
		if($panel_tracking){
			if($panel_tracking->status_code == 3){
				$this->session->set_flashdata('success', 'You have successfully submitted your confirmation. Please confirm whether you are able to access the PT Round Submission Form. If not, please contact the NHRL Administrator for further guidance on what next should happen.');
			}
		// echo "<pre>";print_r($this->getSamples($panel_tracking_uuid));echo "</pre>";die();

			$data = [
				'panel_tracking_uuid'	=>	$panel_tracking_uuid,
				'samples'	=>	$this->getSamples($panel_tracking_uuid)
			];

			$this->assets
					->addCss('dashboard/js/libs/icheck/skins/flat/blue.css')
					->addCss('dashboard/js/libs/icheck/skins/flat/green.css')
					->addCss('dashboard/js/libs/icheck/skins/flat/red.css')
					->addCss('plugin/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');

			$this->assets
					->addJs('dashboard/js/libs/moment.min.js')
					->addJs('plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js')
	                ->addJs('dashboard/js/libs/jquery.validate.js')
	                ->addJs('dashboard/js/libs/select2.min.js');

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
		$pt_details = $this->M_PTRound->getPTUuid($panel_tracking_uuid);
		$samples = $this->M_PTRound->getSamples($pt_details->pt_round_uuid,$pt_details->participant_uuid);
		// $pt_details->participant_uuid


		if ($this->input->post()) {

			
				$update_data = [
					'participant_received_date'	=>	date('Y-m-d', strtotime($this->input->post('participant_received_date'))),
					'panel_received_entered'	=>	date('Y-m-d H:i:s'),
					'receipt'	=>	1
				];

				$this->db->where('uuid', $panel_tracking_uuid);
				if($this->db->update('pt_panel_tracking', $update_data)){

					$id = $this->db->get_where('pt_panel_tracking', ['uuid'=>$panel_tracking_uuid])->row()->id;
					
					
					
					$counter = 1;
					foreach ($samples as $sample) {
						$condition_insert = [];
						
						$participant_uuid = $pt_details->participant_uuid;
						$pt_round_uuid = $pt_details->pt_round_uuid;
						$sample_name = $this->input->post('sample_name'.$counter);
						$acceptance = $this->input->post('acceptance'.$counter);
						$tubes_broken = $this->input->post('tubes_broken'.$counter);
						$tubes_leaking = $this->input->post('tubes_leaking'.$counter);
						$tubes_cracked = $this->input->post('tubes_cracked'.$counter);
						$insufficient_volume = $this->input->post('insufficient_volume'.$counter);
						$haemolysed_sample = $this->input->post('haemolysed_sample'.$counter);
						$clotted_sample = $this->input->post('clotted_sample'.$counter);
						$duplicate_sample = $this->input->post('duplicate_sample'.$counter);
						$missing_sample = $this->input->post('missing_sample'.$counter);
						$mismatch = $this->input->post('mismatch'.$counter);
						$condition_comment = $this->input->post('condition_comment'.$counter);
						


						$condition_insert[] = [
							'id'	=>	$id,
							'participant_uuid'		=>	$participant_uuid,
							'sample_name'	=>	$sample_name,
							'pt_round_uuid'	=>	$pt_round_uuid,
							'acceptance' => $acceptance,
							'tubes_broken'		=>	$tubes_broken,
							'tubes_leaking'	=>	$tubes_leaking,
							'tubes_cracked'		=>	$tubes_cracked,
							'insufficient_volume'	=>	$insufficient_volume,
							'haemolysed_sample'		=>	$haemolysed_sample,
							'clotted_sample'	=>	$clotted_sample,
							'duplicate_sample'	=>	$duplicate_sample,
							'missing_sample'		=>	$missing_sample,
							'mismatch'		=>	$mismatch,
							'condition_comment'	=>	$condition_comment
						];

						$this->db->insert_batch('sample_conditions', $condition_insert);
						$counter++;
					}



					$this->session->set_flashdata('success', "You have successfully submitted your confirmation. Please confirm whether you are able to access the PT Round Submission Form. If not, please contact the NHRL Administrator for further guidance on what next should happen.");
			
					redirect('Participant/PanelTracking/confirm/' . $panel_tracking_uuid);


				}

					
		}else{
			$this->session->set_flashdata('error', "There was a problem in submitting the receipt. Please try again");
			redirect('Participant/PanelTracking/confirm/' . $panel_tracking_uuid);
		}
		
	}



	function getSamples($panel_tracking_uuid){
		$sample_view = "";
		$pt_details = $this->M_PTRound->getPTUuid($panel_tracking_uuid);

		
		$samples = $this->M_PTRound->getSamples($pt_details->pt_round_uuid,$pt_details->participant_uuid);
		
		$counter = 1;
		foreach ($samples as $key => $sample) {
			$sample_view .= "<div class = 'card'>
							  	<div class = 'card-header' role='tab' id = 'heading-".$sample->sample_id."'>
							        <h5 class = 'mb-0'>
							            <a data-toggle = 'collapse' data-parent = '#accordion' href = '#collapse".$sample->sample_id."' aria-expanded = 'true' aria-controls = 'collapse".$sample->sample_id."'>Sample ".$counter." : ";

            $sample_view .= $sample->sample_name;


            $sample_view .= "</a>
						        </h5>
						    </div>
						    <div id = 'collapse".$sample->sample_id."' class = 'collapse' role = 'tabpanel' aria-labelledby= 'heading-".$sample->sample_id."'>
						        <div class = 'card-block'>";




        	$sample_view .= "<div class='form-group row'>
					<div class = 'col-sm-6'>
						<p>Is this sample acceptable / good enough to carry out this PT Round ?</p>
						<input type='hidden' value='".$sample->sample_name."' name='sample_name".$counter."' />
					</div>
					<div class = 'col-sm-6'>
						<input type='radio' value = '1' data-type='".$sample->sample_name."' name='acceptance".$counter."' class='acceptance' id= 'yes-".$sample->sample_name."' required />&nbsp;<label for = 'yes-".$sample->sample_name."'>Yes</label>&nbsp;
						<input type='radio' value = '0' data-type='".$sample->sample_name."' name='acceptance".$counter."' class='acceptance' id='no-".$sample->sample_name."' required />&nbsp;<label for = 'no-".$sample->sample_name."'>No</label>&nbsp;
					</div>	
				</div>

<div id='".$sample->sample_name."' style='display: none;'>

					<div class='form-group row'>
			          <label class = 'col-sm-6'>Sample Tube</label>
			          <div class = 'col-sm-6'>

			          	<div class=''>
				          	<label><strong>Broken</strong></label>
					            <input type='radio' name='tubes_broken".$counter."' id = 'tubes_broken_yes_".$sample->sample_id."' value = '1' /> <label for = 'tubes_broken_yes_".$sample->sample_id."'>Yes</label>&nbsp;
					            <input type='radio' name='tubes_broken".$counter."' id = 'tubes_broken_no_".$sample->sample_id."' value = '0' /> <label for = 'tubes_broken_no_".$sample->sample_id."'>No</label>&nbsp;
			          	</div>


			         	<div class=''>
					          <label><strong>Leaking</strong></label>
					            <input type='radio' name='tubes_leaking".$counter."' id = 'tubes_leaking_yes_".$sample->sample_id."' value = '1' /> <label for = 'tubes_leaking_yes_".$sample->sample_id."'>Yes</label>&nbsp;
					            <input type='radio' name='tubes_leaking".$counter."' id = 'tubes_leaking_no_".$sample->sample_id."' value = '0' /> <label for = 'tubes_leaking_no_".$sample->sample_id."'>No</label>&nbsp;
			            </div>


			            <div class=''>
				          	<label for = 'sample_tubes_0'><strong>Cracked</strong></label>
					            <input type='radio' name='tubes_cracked".$counter."' id = 'tubes_cracked_yes_".$sample->sample_id."' value = '1' /> <label for = 'tubes_cracked_yes_".$sample->sample_id."'>Yes</label>&nbsp;
					            <input type='radio' name='tubes_cracked".$counter."' id = 'tubes_cracked_no_".$sample->sample_id."' value = '0' /> <label for = 'tubes_cracked_no_".$sample->sample_id."'>No</label>&nbsp;
				        </div>

				      </div>
			        </div>

			        <div class='form-group row'>
			          <label class = 'col-sm-6'>Insufficient Volume</label>
			          <div class='col-sm-6'>
			            <input type='radio' name='insufficient_volume".$counter."' id = 'insufficient_volume_yes_".$sample->sample_id."' value = '1'  /> <label for = 'insufficient_volume_yes_".$sample->sample_id."'>Yes</label>&nbsp;
			            <input type='radio' name='insufficient_volume".$counter."' id = 'insufficient_volume_no_".$sample->sample_id."' value = '0'  /> <label for = 'insufficient_volume_no_".$sample->sample_id."'>No</label>
			          </div>
			        </div>

			        <div class='form-group row'>
			          <label class = 'col-sm-6'>Haemolysed sample</label>
			          <div class='col-sm-6'>
			            <input type='radio' name='haemolysed_sample".$counter."' id = 'haemolysed_sample_yes_".$sample->sample_id."' value = '1'  /> <label for = 'haemolysed_sample_yes_".$sample->sample_id."'>Yes</label>&nbsp;
			            <input type='radio' name='haemolysed_sample".$counter."' id = 'haemolysed_sample_no_".$sample->sample_id."' value = '0'  /> <label for = 'haemolysed_sample_no_".$sample->sample_id."'>No</label>
			          </div>
			        </div>

			        <div class='form-group row'>
			          <label class = 'col-sm-6'>Clotted sample</label>
			          <div class='col-sm-6'>
			            <input type='radio' name='clotted_sample".$counter."' id = 'clotted_sample_yes_".$sample->sample_id."' value = '1'  /> <label for = 'clotted_sample_yes_".$sample->sample_id."'>Yes</label>&nbsp;
			            <input type='radio' name='clotted_sample".$counter."' id = 'clotted_sample_no_".$sample->sample_id."' value = '0'  /> <label for = 'clotted_sample_no_".$sample->sample_id."'>No</label>
			          </div>
			        </div>

			        <div class='form-group row'>
			          <label class = 'col-sm-6'>Duplicate sample received</label>
			          <div class='col-sm-6'>
			            <input type='radio' name='duplicate_sample".$counter."' id = 'duplicate_sample_yes_".$sample->sample_id."' value = '1'  /> <label for = 'duplicate_sample_yes_".$sample->sample_id."'>Yes</label>&nbsp;
			            <input type='radio' name='duplicate_sample".$counter."' id = 'duplicate_sample_no_".$sample->sample_id."' value = '0'  /> <label for = 'duplicate_sample_no_".$sample->sample_id."'>No</label>
			          </div>
			        </div>

			        <div class='form-group row'>
			          <label class = 'col-sm-6'>Missing sample</label>
			          <div class='col-sm-6'>
			            <input type='radio' name='missing_sample".$counter."' id = 'missing_sample_yes_".$sample->sample_id."' value = '1'  /> <label for = 'missing_sample_yes_".$sample->sample_id."'>Yes</label>&nbsp;
			            <input type='radio' name='missing_sample".$counter."' id = 'missing_sample_no_".$sample->sample_id."' value = '0'  /> <label for = 'missing_sample_no_".$sample->sample_id."'>No</label>
			          </div>
			        </div>

			        <div class='form-group row'>
			          <label class = 'col-sm-6'>Mismatch of information details on introductory letter and sample tube</label>
			          <div class='col-sm-6'>
			            <input type='radio' name='mismatch".$counter."' id = 'mismatch_yes_".$sample->sample_id."' value = '1'  /> <label for = 'mismatch_yes_".$sample->sample_id."'>Yes</label>&nbsp;
			            <input type='radio' name='mismatch".$counter."' id = 'mismatch_no_".$sample->sample_id."' value = '0'  /> <label for = 'mismatch_no_".$sample->sample_id."'>No</label>
			          </div>
			        </div>

					<div class='form-group'>
						<label>Please provide a brief comment on why you chose the response above</label>
						<textarea class = 'form-control' name = 'condition_comment".$counter."' rows = '8'></textarea>
					</div>

				</div>";




            $sample_view .= "</div>
							    </div>
							</div>";
			$counter++;
		}

		
		// echo "<pre>";print_r($sample_view);echo "</pre>";die();
		return $sample_view;
	}


}