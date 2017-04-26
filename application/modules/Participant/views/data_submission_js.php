<script>

$(document).ready(function(){

	var round = $(".ptround").val();


	$("form").submit(function(e){
		 e.preventDefault();
	  var form = $(this);
	  var id = form.attr('id');
	  var formData = $('#'+id).serialize();
		// alert(formData);

		dataSubmit(id, formData);
	 
	});

	

	function dataSubmit(equipmentid,formData){
		 // alert(round);
	  	$.ajax({
		   	type: "POST",
		   	url: "<?= @base_url('Participant/PTRound/dataSubmission/'); ?>"+equipmentid+ '/' +round,
			data: formData,
		   success: function(html){   
		   		if(html){

                	$("#data-info").html("Saving Data ...");
                    window.location = "<?= @base_url('Participant/PTRound/Round/'); ?>"+round;
                }else{
                	
                	$("#data-info").html("Loading Error ...");
                	window.location = "<?= @base_url('Participant/PTRound/Round/'); ?>"+round;
                }	
		   },
		   beforeSend:function()
		   {
			// $("#add_err").css('display', 'inline', 'important');
			// $("#add_err").html("<img src='images/ajax-loader.gif' /> Loading...")
		   }
	  	});
	}


   	$(".check-complete").click(function(e) {

        e.preventDefault();
        var equipmentid = $(this).val();

  		 // alert(equipmentid);
        swal({
            title: "Are you sure you want to Mark as Complete ?",
            text: "Once marked as complete, changes won't be made on this equipment",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function(){
            $.get('<?= @base_url('Participant/PTRound/EquipmentComplete/'); ?>'+equipmentid+'/'+round, function(data){
                if(data.response == true){
                    window.location = "<?= @base_url('Participant/PTRound/Round/'); ?>"+round;
                    $("#data-info").html("Saving Data ...");
                }else{
                    sweetAlert("Oops...", data.message, "error");
                }
            });
        });
    });

 //    if(document.getElementById('isAgeSelected').checked) {
	//   $(":input:not([name=tloEnable], [name=filename], [name=notifyUsers])")
 //        .prop("disabled", true);
	// }



   });

</script>