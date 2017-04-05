<script>

$(document).ready(function(){


	$('.submit').click(function(){
	  var datatype = $(this).attr('data-type');
	   //alert(datatype);
		dataSubmit(datatype);
	 
	});

	function dataSubmit(datatype){
		round= $("#ptround").val();
	  	$.ajax({
		   	type: "POST",
		   	url: "<?= @base_url('Participant/PTRound/dataSubSubmission/'); ?>"+datatype+ '/' +round,
			data: $("#data-submission").serialize(),
		   success: function(html){   
		   alert(html); 
			if(html=='true')    {
			 
			 //window.location = "<?= @base_url('Participant/PTRound/Round/'); ?>"+round;
			}
			else if(html=='false'){
				alert("Fail");
			}
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