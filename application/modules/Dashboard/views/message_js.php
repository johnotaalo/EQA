<script>

$(document).ready(function(){

	// var round = $(".ptround").val();


	// $("form").submit(function(e){
	// 	 e.preventDefault();
	//   var form = $(this);
	//   var id = $(this).attr('btn-delete');
	//   var formData = $('#'+id).serialize();
	// 	// alert(formData);

	// 	dataSubmit(id, formData);
	 
	// });

   	$(".btn-delete").click(function(e) {

        var uuid = $(this).attr('id');

  		 // alert(uuid);
        swal({
            title: "Are you sure you want to Remove this message ?",
            text: "Once message is removed, you will no longer be able to view it",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function(){
            $.get('<?= @base_url('Dashboard/RemoveMessage/'); ?>'+uuid, function(data){
                if(data == 'success'){
                    $("#data-info").html("Successfully removed the message");
                    window.location = "<?= @base_url('Dashboard/viewMessages/'); ?>";
                    
                }else if(data == 'fail'){
                    $("#nodata-info").html("Failed removed the message");
                    window.location = "<?= @base_url('Dashboard/viewMessages/'); ?>";

                }else{
                    sweetAlert("Oops...", data.message, "error");
                }
            });
        });
    });



   });

</script>