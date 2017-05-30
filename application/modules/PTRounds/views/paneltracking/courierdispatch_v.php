<div class="card">
	<div class="card-header">
		<a class = "btn btn-default"  data-toggle="tooltip" title="Back to Ready Facilities" href = "<?= @base_url('PTRounds/PanelTracking/details/' . $pt_round_no); ?>">
			<i class = "fa fa-arrow-left"></i>
		</a>
		&nbsp;
		Courier Dispatch Details

		<!-- <div class="pull-right">
			<button id = "courier-dispatch" type="button" class="btn btn-outline-primary ml-1"><i class="icon-cloud-download"></i> &nbsp; Export Dispatch List</button>
		</div> -->
	</div>
	<div class="card-block">
		<form method="POST" class="form-horizontal">
			<div class="form-group row">
				<label class="col-md-3 form-control-label" for="courier_company">Courier Company</label>
				<div class="col-md-9">
					<input type="text" name="courier_company" class = "form-control" value = "G4S Courier"/>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3 form-control-label" for="courier_official">Courier Official</label>
				<div class="col-md-9">
					<input type="text" name="courier_official" class = "form-control" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3 form-control-label" for="dispatch_date">Dispatch Date</label>
				<div class="col-md-9">
					<input type="text" name="dispatch_date" class = "form-control" value = "<?= @date('m/d/Y'); ?>"/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-3 form-control-label" for="dispatch_notes">Dispatch Notes</label>
				<div class="col-md-9">
					<textarea class = "form-control" rows = "8" name = "dispatch_notes"></textarea>
				</div>
			</div>

			<button class = "btn btn-primary btn-block">Save and Start Dispatch</button>
		</form>
	</div>
</div>