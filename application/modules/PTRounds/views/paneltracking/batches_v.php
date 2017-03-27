<div class="card card-accent-blue">
	<div class="card-header">
		Batches

		<div class="pull-right">
			<button id = "create-batch" class="btn btn-outline-primary" data-href = "<?= @base_url('PTRounds/PanelTracking/add/' . $pt_uuid); ?>">
				<i class = "icon-plus"></i>
				&nbsp;Create Batch
			</button>
		</div>
	</div>
	<div class="card-block">
		<div class="table-responsive">
			<?= @$batch_table; ?>
		</div>
	</div>
</div>