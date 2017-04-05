<div class="card">
	<div class="card-header">
		<a class = "btn btn-default"  data-toggle="tooltip" title="Back to Ready Facilities" href = "<?= @base_url('PTRounds/PanelTracking/details/' . $pt_round_no); ?>">
			<i class = "fa fa-arrow-left"></i>
		</a>
		<i class = "fa fa-road"></i>
		&nbsp;Tracking Panel
	</div>
	<div class="card-block">
		<?php $class = $header = $text = ""; ?>
		<?php 
			if($tracking->status_code == 0){
				$class = "danger";
				$header = "Panel Preparation";
				$text = "This participant has not yet been assigned a batch. You can assign one by <a href = '".base_url('PTRounds/PanelTracking/assignBatch/')."{$tracking->readiness_uuid}'>clicking here</a>.";
			}elseif($tracking->status_code == 1){
				$header = "Courier Dispatch";
				$class = "warning";
				$text = "The participant has been assigned a batch number already. Awaiting courier dispatch.";
			}elseif($tracking->status_code == 2){
				$header = "Participant Confirmation";
				$class = "info";
				$text = "The panel is on it way to the participant. Awaiting confirmation from the participant's side";
			}elseif($tracking->status_code == 3){
				$header = "Participant Responses";
				$class = "success";
				$text = "The participant has received the panels and confirmed the status of the panel";
			}
		?>

		<div class="alert alert-<?= @$class; ?>" role = "alert">
			<h4><?= @$header; ?></h4>
			<p><?= @$text; ?></p>
		</div>

		<table class="table table-bordered">
			<tr>
				<td>
					<p>Participant No</p>
					<h4><?= @$tracking->participant_id; ?></h4>
				</td>
				<td colspan = "2">
					<p>Participant Name</p>
					<h4><?= @$tracking->participant_fname . ' ' . $tracking->participant_lname; ?></h4>
				</td>
				<td>
					<p>Participant Phone Number</p>
					<h4><?= @$tracking->participant_phonenumber; ?></h4>
				</td>
			</tr>
			<tr>
				<td>
					<p>Facility MFL Code</p>
					<h4><?= @$tracking->facility_code; ?></h4>
				</td>
				<td colspan="3">
					<p>Facility Name</p>
					<h4><?= @$tracking->facility_name; ?></h4>
				</td>
			</tr>

			<tr>
				<td>
					<p>Panel Preparation</p>
					<h4>
						<?php
							if($tracking->panel_preparation_date != NULL){
								echo date('d/m/Y', strtotime($tracking->panel_preparation_date));
							}else{
								echo "N/A";
							}
						?>
					</h4>
				</td>
				<td>
					<p>Courier Collection Date</p>
					<h4>
						<?php
							if($tracking->courier_collection_date != NULL){
								echo date('d/m/Y', strtotime($tracking->panel_preparation_date));
							}else{
								echo "N/A";
							}
						?>
					</h4>
				</td>
				<td>
					<p>Date Received</p>
					<h4>
						<?php
							if($tracking->participant_received_date != NULL){
								echo date('d/m/Y', strtotime($tracking->panel_preparation_date));
							}else{
								echo "N/A";
							}
						?>
					</h4>
				</td>
				<td>
					<p>Panel Status</p>
					<h4><?= @$tracking->status; ?></h4>
				</td>
			</tr>
		</table>

		<?php if($tracking->status_code == 3){?>
		<table class = "table">
			<tr>
				<th style="width: 30%;">Panel Received on: </th>
				<td><?= @date('dS F, Y', strtotime($tracking->participant_received_date)); ?></td>
			</tr>
			<tr>
				<th style="width: 30%;">Panel Condition</th>
				<td>
					<?php
						if($tracking->panel_condition == 1){
							echo "Good";
						}else{
							echo "Bad";
						}
					?>
				</td>
			</tr>

			<tr>
				<th style="width: 30%;">Participant Comment</th>
				<td>
					<?= @$tracking->panel_condition_comment; ?>
				</td>
			</tr>
		</table>
		<?php } ?>
	</div>
</div>