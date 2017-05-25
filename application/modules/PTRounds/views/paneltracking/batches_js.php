<script type="text/javascript">
	$(document).ready(function(){
		var table_body = $('table tbody');
		if (table_body.length == 0) {
			var table = $('table thead tr th').length;
			var empty_string = '<tbody><tr><td colspan = '+table+'><center>No Batches Added For This Round Yet</center></td></tr></tbody>';
			$('table').append(empty_string);
		}	
	});

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