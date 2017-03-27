<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>150</h3>

				<p>Batches created</p>
			</div>
			<div class="icon">
				<i class="glyphicons glyphicons-more-items "></i>
			</div>
			<a href="<?= @base_url('PTRounds/PanelTracking/batches/' . $pt_uuid); ?>" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bgm-amber">
			<div class="inner">
				<h3>150</h3>

				<p>Total Batches Sent</p>
			</div>
			<div class="icon">
				<i class="glyphicons glyphicons-cargo"></i>
			</div>
			<a href="#" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3>150</h3>

				<p>Enroute Panels</p>
			</div>
			<div class="icon">
				<i class="glyphicons glyphicons-truck"></i>
			</div>
			<a href="#" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3>150</h3>

				<p>Received Panels</p>
			</div>
			<div class="icon">
				<i class="glyphicons glyphicons-handshake"></i>
			</div>
			<a href="#" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
</div>

<div class="row">
	<div class="card card-accent-primary">
		<div class="card-block">
			<div class="row">
				<div class="col-sm-5">
					<h3 class="card-title clearfix mb-0">Ready Facilities</h3>
				</div>
				<div class="col-sm-7">
					<button type="button" class="btn btn-outline-primary pull-right ml-1"><i class="icon-doc"></i> &nbsp; View Reports</button>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-md-12">
					<div class = "table-responsive">
						<table class = "table table-bordered table">
							<thead>
								<th>MFL Code</th>
								<th>Facility Name</th>
								<th>G4S Branch</th>
								<th>G4S Location</th>
								<th>Status</th>
								<th>Details</th>
							</thead>
							<tbody>
								<tr>
									<td colspan="6"><center>No data available</center></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>