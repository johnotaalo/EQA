<script type="text/javascript">
	$(document).ready(function(){
		$('input[name="participant_received_date"]').datepicker({
			"endDate" : "<?= @date('m/d/Y'); ?>"
		});
		$("input[type='checkbox']").iCheck({
			checkboxClass: 'icheckbox_flat-green'
		});
		$("input[type='radio']").iCheck({
			radioClass: 'iradio_flat-green'
		});
	});
</script>