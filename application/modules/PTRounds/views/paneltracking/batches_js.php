<script type="text/javascript">
	$(document).ready(function(){
		var table_body = $('table tbody');
		if (table_body.length == 0) {
			var table = $('table thead tr th').length;
			var empty_string = '<tbody><tr><td colspan = '+table+'><center>No Batches Added For This Round Yet</center></td></tr></tbody>';
			$('table').append(empty_string);
		}	
	});

	if($('.delete-batch')[0]){
		$('.delete-batch').click(function(){
			batch_id = $(this).attr('data-id');
			ajax_options = {
				url: "<?= @base_url('PTRounds/PanelTracking/checkBatch'); ?>",
				type: "POST",
				data: {
					'batch_id' : batch_id
				},
				beforeSend: function(){
					console.log('Please wait...');
				},
				error: function(xhr, ajaxOptions, thrownError){
					alert('There was an error!');
				}
			};
			$.ajax(ajax_options)
				.done(function(res){
					if (res.continue == true) {
						swal({
							title: "Are you Sure?",
							text: "You will not be able to recover this batch",
							type: "info",
							showCancelButton: true,
							closeOnConfirm: false,
							showLoaderOnConfirm: true,
						}, function(response){
							if(response){
								$.ajax({
									url: "<?= @base_url('PTRounds/PanelTracking/deleteBatch'); ?>",
									type: "POST",
									data: {
										'batch_id' : batch_id
									},
									error: function(){
										swal("Error!", "There was an error while trying to delete this batch", "error");
									}
								})
								.done(function(){
									swal("Success!", "Successfully deleted batch", "success");
									window.location = "<?= @base_url('PTRounds/PanelTracking/batches/' . $pt_uuid); ?>";
								});
							}
						});
					}else{
						swal("STOP!", res.message, "error");
					}
				});
		});
	}

	if($('.edit-batch')[0]){
		$('.edit-batch').click(function(){
			batch_uuid = $(this).attr('data-id');
			url = "<?= @base_url('PTRounds/PanelTracking/editBatch/' . $pt_uuid . '/'); ?>" + batch_uuid;

			$('#generalModal .modal-body').load(url, function(res){
				resObj = $.parseJSON(res);
				$('#generalModal .modal-body').html("");
				$('#exampleModalLabel').text(resObj.title);
				$('#generalModal .modal-body').html(resObj.page);
			});

			$('#generalModal').modal();
		});
	}

	$('#create-batch').click(function(){
		url = $(this).attr('data-href');
		$('#generalModal .modal-body').load(url, function(res){
			resObj = $.parseJSON(res);
			$('#generalModal .modal-body').html("");
			$('#exampleModalLabel').text(resObj.title);
			$('#generalModal .modal-body').html(resObj.page);
		});

		$('#generalModal').modal();
	});

	$('#save-changes').click(function(){
		$('#new_batch_form').submit();
	});
</script>