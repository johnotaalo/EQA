<script type="text/javascript">
	$(document).ready(function(){
		// console.log('conditions');

		// $('#bad-samples').hide();

		


		$('input[name="participant_received_date"]').datepicker({
			"endDate" : "<?= @date('m/d/Y'); ?>"
		});
		$("input[type='checkbox']").iCheck({
			checkboxClass: 'icheckbox_flat-green'
		});
		$("input[type='radio']").iCheck({
			radioClass: 'iradio_flat-green'
		});


		console.log("conditions");
    	
    	$('#acceptanceyes').click(function() {
    		console.log('yes clicked');
	   	    $check = $('#acceptanceyes').is(":checked"); 	
	       	if($check){
	       		$divcheck = $('#bad-samples').is(":visible");
	       		if($divcheck){
	       			$('#bad-samples').slideUp();
	       		}
				
	       	}
    	});


    	$('#acceptanceno').click(function(){
			console.log('no clicked');
	   	    $check = $('#acceptanceno').is(":checked"); 	
	       	if($check){
	       		$divcheck = $('#bad-samples').is(":visible");
	       		if(!($divcheck)){
	       			$('#bad-samples').slideDown();
	       		}
	       	}
    	});

    $('input[type="radio"]').click(function() {
    	console.log('no clicked');
       if(($(this).attr('id') == 'acceptanceno')) {
	   	    if($check){
	       		$divcheck = $('#bad-samples').is(":visible");
	       		if(!($divcheck)){
	       			$('#bad-samples').slideDown();
	       		}
	       	}   
       	}
   });






});
</script>