<script type="text/javascript">
	$(document).ready(function(){
		$('#readyParticipants').dataTable({
			serverSide: true,
			processing: true,
			ajax: {
				url: "<?= @base_url('PTRounds/PanelTracking/readyFacilities/' . $pt_round_uuid); ?>",
				type: "POST",
				error: function(){
					alert("No data found in server");
				}
			}
		});

		$('#courier-dispatch').click(function(){
			$.get('<?= @base_url('PTRounds/PanelTracking/getDispatchRatio/' . $pt_round_uuid); ?>', function(res){
				if (res.ratio < 1 && res.ratio > 0) {
					swal({
						title: "NOT ALL PARTICIPANTS HAVE BATCHES ASSIGNED TO THEM ONLY " + res.ready + " OUT OF " + res.total + " HAVE BATCHES ASSIGNED TO THEM",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Yes, Continue!",
						closeOnConfirm: false
					},
					function(){
						redirect();
					});
				}else if(res.ratio == 0){
					sweetAlert("Action Stopped", "You cannot dispatch to the courier because no participant has a batch assigned to them", "error");
				}else{
					redirect();
				}
			});
		});
	});

	function redirect(){
		window.location = "<?= @base_url('PTRounds/PanelTracking/courierdispatch/' . $pt_round_uuid); ?>";
	}
</script>