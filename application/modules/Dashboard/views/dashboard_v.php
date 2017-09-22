<?php if($dashboard_data->rounds == 1 && $dashboard_data->current != "" ){?>
<div class="alert alert-warning" role = "alert">
	<?php if($dashboard_data->current == "enroute"){ ?>
		Hello. A panel has been sent to you from NHRL. Please be sure to confirm upon receiving them. If you have received it, <a href="<?= @base_url('Participant/PanelTracking/confirm/' . $dashboard_data->readiness->panel_tracking_uuid); ?>" target = "_blank">click here</a> to confirm receipt, in order to participate in the Round.
	<?php } elseif($dashboard_data->current == "readiness"){ ?>
		Hello. Please fill in the evaulation for that has been sent to your email (<?= @$participant->participant_email; ?>). If you haven't received the evaluation, <a href="#">click here</a> to receive it.
	<?php } elseif($dashboard_data->current == "pt_round_submission"){?>
		Hey there. Please ensure that you fill in your findings for this PT (<?= @$dashboard_data->pt_round->pt_round_no; ?>) before <span style = "color:red;"><?= @date('dS F, Y', strtotime($dashboard_data->pt_round->to)); ?></span>. To fill in the form, please head over to the <a href = "<?= @base_url('Participant/PTRound/Round/' . $dashboard_data->pt_round->uuid); ?>">PT Round Section</a>
	<?php } ?>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<div class="col-sm-8">
					Current PT Round: (<?= @$dashboard_data->pt_round->pt_round_no;?>) Calendar
				</div>
				<div class="col-sm-4">
				<?php
					if($dashboard_data->current == "pt_round_submission"){
				?>
						<a href = "<?= @base_url('Participant/PTRound/Round/' . $dashboard_data->pt_round->uuid); ?>" class = "btn btn-primary pull-right">Open Round</a>
				<?php
					}
				?>
				</div>
			</div>
			<div class="card-block">
				<table class = "table table-bordered">
					<tr>
						<td>
							<p>Round Duration</p>
							<h6>
								From: <?= @date('d/m/Y', strtotime($dashboard_data->pt_round->from)); ?> To: <?= @date('d/m/Y', strtotime($dashboard_data->pt_round->to)); ?>
							</h6>
						</td>

						<td>
							<p>Total Days Left</p>
							<h6>
								<?php
									$date_time_to = date_create($dashboard_data->pt_round->to);
									$data_time_now = date_create(date('Y-m-d'));
									$difference = date_diff($date_time_to, $data_time_now);

									echo $difference->format('%a Days');
								?>
							</h6>
						</td>
						<td style="background-color: <?= @$dashboard_data->calendar_current->color; ?>;">
							<p>Current Item By Calendar</p>
							<h6>
								<?= @$dashboard_data->calendar_current->name; ?>
							</h6>
						</td>
					</tr>
				</table>

				<div id = "calendar"></div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-block">
				<h5 class = "mb-1">Legend</h5>
				<hr>
				<?= @$dashboard_data->calendar_legend; ?>
			</div>
		</div>
	</div>
</div>

<?php } ?>