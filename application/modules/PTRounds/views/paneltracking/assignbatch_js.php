<script type="text/javascript">
	$(document).ready(function(){
		$('input[name="batch_preparation_date"]').datepicker({
			startDate: "<?= @date('m/d/Y', strtotime($from)); ?>",
			endDate: "<?= @date('m/d/Y'); ?>",
			todayHighlight: true
		});
	});
</script>