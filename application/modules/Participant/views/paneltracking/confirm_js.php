<script type="text/javascript">
	$(document).ready(function(){
		// console.log('conditions');

		$('#bad-samples').hide();

    	$('input#acceptanceyes').click(function() {
	   	    $check = $('#acceptanceyes').is(":checked"); 	
	       	if($check){
	       		$divcheck = $('#bad-samples').is(":visible");
	       		if($divcheck){
	       			$('#bad-samples').slideUp();
	       		}
				
	       	}
    	});


    	$('input#acceptanceno').click(function(){
	   	    $check = $('#acceptanceno').is(":checked"); 	
	       	if($check){
	       		$divcheck = $('#bad-samples').is(":visible");
	       		if(!($divcheck)){
	       			$('#bad-samples').slideDown();
	       		}
	       	}
    	});


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