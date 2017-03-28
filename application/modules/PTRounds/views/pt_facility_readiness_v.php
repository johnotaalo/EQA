<div class="container">
	<?php if($this->session->flashdata('error')){?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<?= @$this->session->flashdata('error'); ?>
		</div>
	<?php }elseif($this->session->flashdata('success')){ ?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<?= @$this->session->flashdata('success'); ?>
		</div>
	<?php } ?>
	<div class="card">
		<div class="card-header">
			Participant Responses
			<div class="pull-right">
				<button class = "btn btn-primary" id="assessmentbutton">Assessment Outcome</button>
				<button class = 'btn btn-danger'><i class = "fa fa-file-pdf-o"></i> Download PDF</button>
			</div>
		</div>
		<div class="card-block">
			<table class = "table table-bordered table-condensed">
				<thead>
					<th colspan="3"><center>Participant Details</center></th>
				</thead>
				<tbody>
					<tr>
						<td>
							<p><b>Participant Code:</b></p>
							<?= @$result->participant_id; ?>
						</td>
						<td>
							<p><b>Name:</b></p>
							<?= @$result->participant_fname . " " . $result->participant_lname; ?>
						</td>
						<td>
							<p><b>Tel:</b></p>
							<?= @$result->participant_phonenumber; ?>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<p><b>Site Name:</b></p>
							<?= @$result->facility_name; ?>
						</td>
						<td>
							<p><b>MFL Code:</b></p>
							<?= @$result->facility_code; ?>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<p><b>Email Address:</b></p>
							<?= @$result->participant_email; ?>
						</td>
						<td>
							<p><b>Site Tel:</b></p>
							<?= @$result->telephone; ?>
						</td>
					</tr>
				</tbody>
			</table>
			<table class = "table table-bordered table-condensed">
				<thead>
					<th colspan="3"><center>Questionnaire Response</center></th>
				</thead>
				<tbody>
					<?= @$response_table; ?>
				</tbody>
			</table>
			<form id = "assessement-outcome-form" class = "form-horizontal" method = "POST" action = "<?= @base_url('PTRounds/addReadinessAssessmentOutcome/' . $result->readiness_id); ?>">
				<legend>Assessment Outcome</legend>
				<div class="form-group">
					<label class="control-label col-sm-6" for="status">Allow Participant to participate in this round?</label>
					<input type="radio" name="verdict" value = "1" id = "verdict-yes" <?php if($result->readiness_verdict == 1){ echo "checked";}?>> <label for="verdict-yes">Yes</label>
					<input type="radio" name="verdict" value="0" id = "verdict-no" <?php if($result->readiness_verdict == 0 && $result->readiness_verdict != NULL){ echo "checked";}?>> <label for="verdict-no">No</label>
				</div>
				<div class="form-group">
					<label class = "control-label col-sm-2">Comment</label>
					<textarea class="form-control" rows="8" name = "readiness_comment"><?php if($result->readiness_comment){ echo $result->readiness_comment;}?></textarea>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-6" for="status">Mark as complete</label>
					<input type="checkbox" name="status"  <?php if($result->readiness_status == 1){ echo "checked";}?>>
				</div>

				<button class = "btn btn-primary">Save Details</button>
			</form>
		</div>
	</div>
</div>