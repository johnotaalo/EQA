<?php
	$batch_preparation_date = $batch_preparation_notes = $header = "";
	if (isset($panel_tracking_uuid) && isset($tracking_data)) {
		$header = "Editting Batch";
		$url = base_url('PTRounds/PanelTracking/editBatchAssignment/' . $panel_tracking_uuid);
		$batch_preparation_date = date('m/d/Y', strtotime($tracking_data->panel_preparation_date));
		$batch_preparation_notes = $tracking_data->panel_preparation_notes;
	}elseif (isset($readiness_uuid)) {
		$url = base_url('PTRounds/PanelTracking/assignBatch/' . $readiness_uuid);
		$header = "Assigning Batch";
	}
?>

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
<div class="row">
	<div class="card card-accent-primary">
		<div class="card-header">
			<a class = 'btn btn-default' data-toggle="tooltip" title="Back to Ready Facilities" href = "<?= @base_url('PTRounds/PanelTracking/details/' . $pt_round_no); ?>"><i class = 'fa fa-long-arrow-left'></i></a>
			<?= @$header; ?>
		</div>
		<div class="card-block">
			<div class = "form-group">
				<table class = "table table-bordered">
					<tr>
						<td style="width: 30%;">
							<p>Participant Number</p>
							<h4><?= @$participant->participant_id;?></h4>
						</td>
						<td>
							<p>Participant Name</p>
							<h4><?= @$participant->participant_fname . ' ' . $participant->participant_lname;?></h4>
						</td>
						<td>
							<p>Participant Email</p>
							<h4><?= @$participant->participant_email;?></h4>
						</td>
					</tr>
					<tr>
						<td>
							<p>Facility MFL</p>
							<h4><?= @$facility->facility_code;?></h4>
						</td>
						<td colspan="2">
							<p>Facility Name</p>
							<h4><?= @$facility->facility_name;?></h4>
						</td>
					</tr>
				</table>
			</div>
			<form method="POST" action="<?= @$url; ?>" class = "form-horizontal">
				<div class="form-group row">
					<label class="col-md-3 form-control-label" for="hf-email">Batch No</label>
					<div class="col-md-9">
						<select name = "batch_no" class = "form-control" required>
							<option value = "">Select a Batch</option>
							<?= @$batches; ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-3 form-control-label" for="hf-email">Preparation Date</label>
					<div class="col-md-9">
						<input type="text" name="batch_preparation_date" class = "form-control" value = "<?php if($batch_preparation_date) { echo $batch_preparation_date; } else{ echo date('m/d/Y'); } ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-3 form-control-label" for="hf-email">Preparation Notes</label>
					<div class="col-md-9">
						<textarea type="text" name="batch_preparation_notes" class = "form-control" rows="8"><?= @$batch_preparation_notes; ?></textarea>
					</div>
				</div>

				<button class = "btn btn-primary btn-block">Save Changes</button>
			</form>
		</div>
	</div>
</div>