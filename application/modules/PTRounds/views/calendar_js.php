<script type="text/javascript">
	$(document).ready(function(){
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
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
	});
</script>