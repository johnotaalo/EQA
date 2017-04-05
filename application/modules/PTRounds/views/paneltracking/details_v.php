<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3><?= @$stats->batches; ?></h3>

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
				<h3><?= @$stats->panels_prepared; ?></h3>

				<p>Total Batches Assigned</p>
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
				<h3><?= @$stats->enroute; ?></h3>

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
				<h3><?= @$stats->received; ?></h3>

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
<?php if($this->session->flashdata('success')){?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<?= @$this->session->flashdata('success'); ?>
	</div>
<?php } ?>
<div class="row">
	<div class="card card-accent-primary">
		<div class="card-block">
			<div class="row">
				<div class="col-sm-5">
					<h3 class="card-title clearfix mb-0">Ready Facilities</h3>
				</div>
				<div class="col-sm-7">
					<button type="button" class="btn btn-outline-primary pull-right ml-1"><i class="icon-doc"></i> &nbsp; View Reports</button>
					<?php if($stats->enroute == 0 && $stats->received == 0){ ?>
					<button id = "courier-dispatch" type="button" class="btn btn-outline-primary pull-right ml-1"><i class="icon-plane"></i> &nbsp; Courier Dispatch</button>
					<?php } ?>
					<?php if($stats->enroute != 0){ ?>
					<button id = "delivery-notes" type="button" class="btn btn-outline-primary pull-right ml-1"><i class="icon-credit-card"></i> &nbsp; Delivery Notes</button>
					<button id = "dispatch-list" type="button" class="btn btn-outline-primary pull-right ml-1"><i class="icon-cloud-download"></i> &nbsp; Dispatch List</button>
					<?php } ?>
				</div>
			</div>
			<!-- <hr/> -->
			<div class="row">
				<div class="col-md-12">
					<div class = "table-responsive">
						<table class = "table table-bordered table-striped" id = 'readyParticipants'>
							<thead>
								<th>Participant Name</th>
								<th>MFL Code</th>
								<th>Facility Name</th>
								<th>Assigned Batch</th>
								<th>Status</th>
								<th>Action</th>
							</thead>
							<tbody>
								<!-- <tr>
									<td colspan="6"><center>No data available</center></td>
								</tr> -->
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>