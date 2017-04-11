<script>

$(document).ready(function(){


	$("form").submit(function(e){
		 e.preventDefault();
	  var form = $(this);
	  var id = form.attr('id');
	  var formData = $('#'+id).serialize();
		// alert(formData);

		dataSubmit(id, formData);
	 
	});

	function dataSubmit(equipmentid,formData){
		var round= $(".ptround").val();
		 // alert(round);
	  	$.ajax({
		   	type: "POST",
		   	url: "<?= @base_url('Participant/PTRound/dataSubmission/'); ?>"+equipmentid+ '/' +round,
		   	dataType: 'json',
			data: formData,
		   success: function(html){   
		   //alert(html);
		   	window.location = "<?= @base_url('Participant/PTRound/'); ?>";
		   },
		   beforeSend:function()
		   {
			// $("#add_err").css('display', 'inline', 'important');
			// $("#add_err").html("<img src='images/ajax-loader.gif' /> Loading...")
		   }
	  	});
	}


	});

</script>