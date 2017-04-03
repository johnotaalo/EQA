<?php if($this->session->flashdata('success')){?>
	 <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= @$this->session->flashdata('success'); ?>
    </div>
<?php } ?>
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