<form method = "POST" action="<?= @base_url('PTRounds/PanelTracking/addBatchInfo'); ?>" id = "new_batch_form">
	<div class="form-group">
		<label>Batch Name</label>
		<input type="text" class="form-control" value = "<?= @$batch_name; ?>" name="batch_name" readonly="true">
	</div>

	<?= @$tubes_list; ?>

	<input type = "hidden" name = "pt_round_uuid" value = "<?= @$pt_uuid; ?>"/>
</form>