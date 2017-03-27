<script type="text/javascript">
	$(document).ready(function(){
		$("input[type='checkbox']").iCheck({
			checkboxClass: 'icheckbox_flat-blue'
		});

		$("#verdict-yes").iCheck({
			radioClass: 'iradio_flat-green'
		});
		$("#verdict-no").iCheck({
			radioClass: 'iradio_flat-red'
		});
	});

	$('#assessmentbutton').click(function(event){
		event.preventDefault();
		var target = $('#assessement-outcome-form');

		$('html, body').stop().animate({
			scrollTop: target.offset().top
		}, 500);
	})
</script>