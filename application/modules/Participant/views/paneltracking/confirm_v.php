<?php if($this->session->flashdata('success')){?>
	<div class="container">
		<div class="card">
			<div class="card-block" style="text-align: center;">
				<i class = "icon-check" style="font-size: 6em;color: #66BB6A;"></i>
				<h3 class = "mt-1">SUCCESS!</h3>
				<p><?= @$this->session->flashdata('success');?></p>
				<div class="alert alert-danger">
					<p>Please close this tab or logout if you are done.</p>
				</div>
			</div>
		</div>
	</div>
<?php } else { ?>
<?php if($this->session->flashdata('error')){?>
	<div class="alert alert-danger alert-dismissable" role = "alert">
		<h4>Ooops! Something went wrong</h4>
		<p><?= @$this->session->flashdata('error');?></p>
	</div>
<?php } ?>
<div class="container">
	<div class="card">
		<div class="card-block">
			<h4>Confirm Receipt</h4>
			<hr>
			<form method="POST" class = "form-horizontal" action="<?= @base_url('Participant/PanelTracking/submitConfirmation/' . $panel_tracking_uuid); ?>">
				<div class="form-group row">
					<label class="col-sm-3" class = "control-label">Date of Receipt</label>
					<div class="col-sm-9">
						<input type="text" name="participant_received_date" class = "form-control" value="<?= @date('m/d/Y'); ?>" required>
						<span class="help-block">Format: month/day/year e.g. 02/01/2017</span>
					</div>
				</div>

				<legend>Condition of Panel</legend>
				<div class="form-group row">
					<label class = "col-sm-8">What is the condition of the panel that you have received from the courier?</label>
					<div class="col-sm-4">
						<input type="radio" name="tubes_condition" id = "tubes_condition_yes" value = "1" required /> <label for = "tubes_condition_yes">Good</label>&nbsp;
						<input type="radio" name="tubes_condition" id = "tubes_condition_no" value = "0" required /> <label for = "tubes_condition_no">Bad</label>
					</div>
				</div>

				<div class="form-group">
					<label>Please provide a brief comment on why you chose the response above</label>
					<textarea class = 'form-control' name = 'condition_comment' rows = "8" required></textarea>
				</div>

				<div class="form-group">
					<input type="checkbox" value = "1" name="acceptance" id = "acceptance"/>&nbsp;
					<label for="acceptance" required>By clicking on this you agree that the data you have provided above is true.</label>
				</div>

				<div class="alert alert-info" role = "alert">
					<p>Please note that if your panels are in good condition, then you will be allowed to start reporting on your findings. Otherwise, you may have to wait for an administrator to intervene</p>
				</div>
				
				<button class = "btn btn-primary btn-block">Submit Receipt</button>
			</form>
		</div>
	</div>
</div>
<?php } ?>
