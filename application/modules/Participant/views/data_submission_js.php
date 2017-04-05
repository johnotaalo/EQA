<script>

$(document).ready(function(){


	$('.submit').click(function(){
	  var datatype = $(this).attr('data-type');
	  var formData = $("#data-submission").serialize();

	  var round= $("#ptround").val();
		//alert(formData);
	  // 	$.ajax({
		 //   	type: "POST",
		 //   	url: "<?= @base_url('Participant/PTRound/dataSubmission/'); ?>"+datatype+ '/' +round,
		 //   	dataType: 'json',
			// data: formData,
		 //   success: function(html){   
		 //   alert(html);

		 //   },
		 //   beforeSend:function()
		 //   {
			// // $("#add_err").css('display', 'inline', 'important');
			// // $("#add_err").html("<img src='images/ajax-loader.gif' /> Loading...")
		 //   }
	  // 	});
	   
		dataSubmit(datatype,formData);
	 
	});

	function dataSubmit(datatype,formData){
		var round= $("#ptround").val();
		//alert(formData);
	  	$.ajax({
		   	type: "POST",
		   	url: "<?= @base_url('Participant/PTRound/dataSubmission/'); ?>"+datatype+ '/' +round,
		   	dataType: 'json',
			data: formData,
		   success: function(html){   
		   alert(html);

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