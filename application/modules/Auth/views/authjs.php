<style>
	.error{
		color: red;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('select[name="facility"]').select2({
			ajax: {
				url: "<?= @base_url('API/Facilities/get'); ?>",
				dataType: 'json',
				delay: 250,
				data: function(params){
					return{
						q:params.term,
						page: params.page
					};
				},
				processResults: function(data, params){
					console.log(data);
					params.page = params.page || 1;
					return {
						results: data.items,
						pagination: {
							more: (params.page * 30) < data.total_count
						}
					};
				},
				cache: true
			},
			placeholder: "Pick your Facility",
			minimumInputLength: 1
		});

		$('select[id="equipment"]').select2({
			ajax: {
				url: "<?= @base_url('API/Equipment/get'); ?>",
				dataType: 'json',
				delay: 250,
				data: function(params){
					return{
						q:params.term,
						page: params.page
					};
				},
				processResults: function(data, params){
					console.log(data);
					params.page = params.page || 1;
					return {
						results: data.items,
						pagination: {
							more: (params.page * 30) < data.total_count
						}
					};
				},
				cache: true
			},
			placeholder: "Equipment Available in Facility",
		});

		$('#userCompleteForm').validate({
			rules: {
				password: {
					required: true,
					minlength: 5
				},
				confirm_password: {
					required: true,
					minlength: 5,
					 equalTo: "input[name='password']" 
				},
				username: {
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
	});
</script>