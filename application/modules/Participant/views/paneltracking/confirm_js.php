<script type="text/javascript">
	$(document).ready(function(){
		// console.log('conditions');


    	$('.acceptance').click(function(){
	  		var get_id = $(this).attr('id');
	  		var sample_name = $(this).attr('data-type');
	  		

	   	    var nocheck = $('#no-'+sample_name).is(":checked");
	   	    var yescheck = $('#yes-'+sample_name).is(":checked");
	   	    var view = $('#'+sample_name).is(":visible");

	   	//     console.log('No '+nocheck);
	   	//     console.log('Yes '+yescheck);
	  		// console.log('View Visibility '+view);

	       	if(nocheck && !(view)){
	       		
	       		if(!(view)){
	       			$('#'+sample_name).slideDown();
	       		}else{
	       			$('#'+sample_name).slideUp();
	       		}
	       	}else if(yescheck){
	       		if(view){
	       			$('#'+sample_name).slideUp();
	       		}
	       	}
    	});


		$('input[name="participant_received_date"]').datepicker({
			"endDate" : "<?= @date('m/d/Y'); ?>"
		});

		// $("input[type='checkbox']").iCheck({
		// 	checkboxClass: 'icheckbox_flat-green'
		// });
		// $("input[type='radio']").iCheck({
		// 	radioClass: 'iradio_flat-green'
		// });

});
</script>