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

		$('#registrationForm').validate({
			rules: {
				surname: "required",
				firstname: "required",
				sex: "required",
				age: "required",
				education: "required",
				experience: "required",
				email_address: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?= @base_url('API/Users/checkEmail'); ?>",
                        type: "POST"
                    }
                },
                phonenumber: {
                	required: true,
                    remote: {
                        url: "<?= @base_url('API/Users/checkPhone'); ?>",
                        type: "POST"
                    }
                },
                usertype: "required",
                facility: "required",
                'equipment[]': "required",
                password: {
                    minlength: 5,
                    required: true
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                } 
			},
			messages : {
				surname: "Please enter your Surname",
				firstname: "Please enter your First Name",
				sex: "Please select your gender",
				age: "Please select your age criteria",
				education: "Please select your highest qualification",
				experience: "Please select your years of experience in flow cytometry",
				email_address: {
                    required: "Email Address cannot be empty",
                    email: "This is not an email",
                    remote: "Email already taken"
                },
                phonenumber: {
                    required: "Please enter your phone number",
                    remote: "Phone Number already taken, Please contact administrator"
                },
                usertype: "Please Select your User Type",
                facility: "Please a facility",
                'equipment[]': "Please Select at least one equipment",
                password: {
                    minlength: "Password is too short",
                    required: "Please enter a password"
                },
                confirm_password: {
                    minlength: "Password is too short",
                    required: "Please enter a confirmatory password",
                    equalTo: "Passwords do not match "
                }
			}
		});
	});
</script>