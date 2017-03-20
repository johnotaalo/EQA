<style>
	.circle:before {
		content: ' \25CF';
		font-size: 30px;
	}
	a{
		text-decoration: none;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class = "card">
			<div class = "card-header">
				<i class="fa fa-calendar"></i>
				&nbsp;Calendar Events for: <?= @$pt_details->pt_round_no; ?>
			</div>
			<div class = "card-block">
				<div class="dropdown" style="margin-bottom: 10px;">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Events Legend
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<?= @$legend; ?>
					</div>
				</div>
				<div id = "calendar"></div>
			</div>
		</div>
	</div>
</div>