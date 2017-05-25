<?php if(!is_null($pt_round)){ ?>
	<div class="alert alert-success">
		Hello QA Reviewer, there is an ongoing PTRound with the number <?= @$pt_round->pt_round_no; ?>. Please check on the calendar below to keep track of the timeline
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-block">
					<div id="calendar"></div>
				</div>
			</div>
		</div>
	</div>
<?php }else{ ?>
	<div class="alert alert-danger">
		Oh Snap! There is no PT Round ongoing
	</div>
<?php } ?>