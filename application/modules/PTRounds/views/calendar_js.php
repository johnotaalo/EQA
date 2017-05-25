<script type="text/javascript">
	$(document).ready(function(){
		if($('#calendar')[0]){
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'agendaYear,month,agendaWeek,agendaDay'
				},
				eventSources: [
					{
						url: '<?= @base_url('PTRounds/getCalendarData'); ?>',
						type: 'POST',
						data: {
							round_id : "<?= @$round; ?>"
						},
						error: function() {
							alert('There was an error while fetching events!');
						}
					}
				]
			});	
		}
	});
</script>