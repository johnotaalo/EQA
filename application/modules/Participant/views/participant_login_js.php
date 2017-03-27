<script>

$(document).ready(function(){

	$('#readiness-login-form').validate({
			rules: {
				passw: {
					required: true,
					minlength: 5
				},
				uname: {
					minlength: 6,
					remote: {
						url: "<?= @base_url('API/Users/checkExist'); ?>",
						type: "POST"
					}
				}
			},
			messages : {
				username: {
					remote: "Username already in use!"
				}
			}
		});


	 $("#loginready").click(function(){	
		  username=$("#username").val();
		  password=$("#password").val();
		  $.ajax({
		   type: "POST",
		   url: "<?= @base_url('Participant/Readiness/authentication'); ?>",
			data: "usname="+username+"&passwd="+password,
		   success: function(html){    
			if(html=='true')    {
			 //$("#add_err").html("right username or password");
			 window.location = "<?= @base_url('Participant/Readiness/readinessChecklist'); ?>";
			}
			else if(html=='false'){
				// swal({
			   //              title: "Error !!",
			   //              text: "Wrong username or password",
			   //              type: "error",
			   //              showCancelButton: true,
			   //              closeOnConfirm: false,
			   //              showLoaderOnConfirm: true
			   //          }, function(){
			   //              $.get(url, function(data){
			   //                  if(data.status == true){
			   //                     window.location = "<?= @base_url('Participant/Readiness/authenticate'); ?>";
			   //                  }else{
			   //                      sweetAlert("Oops...", data.message, "error");
			   //                  }
			   //              });
			   //          });
			}
		   },
		   beforeSend:function()
		   {
			$("#add_err").css('display', 'inline', 'important');
			$("#add_err").html("<img src='images/ajax-loader.gif' /> Loading...")
		   }
		  });
		return false;
	});
});

</script>

