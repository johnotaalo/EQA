<script>

$(document).ready(function(){

	$('#readiness-login-form').validate({
			rules: {
				username: {
					required: true
				}
			},
			messages : {
				username: {
					required: "Please enter your username"
				}
			}
		});


	//  $("#loginready").click(function(){	
	// 	  username=$("#username").val();
	// 	  password=$("#password").val();
	// 	  $.ajax({
	// 	   type: "POST",
	// 	   url: "<?= @base_url('Participant/Readiness/authentication'); ?>",
	// 		data: "usname="+username+"&passwd="+password,
	// 	   success: function(html){    
	// 		if(html=='true')    {
	// 		 //$("#add_err").html("right username or password");
	// 		 window.location = "<?= @base_url('Participant/Readiness/readinessChecklist'); ?>";
	// 		}
	// 		else if(html=='false'){
				
	// 		}
	// 	   },
	// 	   beforeSend:function()
	// 	   {
	// 		$("#add_err").css('display', 'inline', 'important');
	// 		$("#add_err").html("<img src='images/ajax-loader.gif' /> Loading...")
	// 	   }
	// 	  });
	// 	return false;
	// });
});

</script>

