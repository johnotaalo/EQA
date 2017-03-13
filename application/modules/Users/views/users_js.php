<script>
    $(document).ready(function(){
        $('table').dataTable();
        
        $("#role-select").select2({
            ajax: {
                url: "<?= @base_url('API/Users/getUserTypes'); ?>",
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
			placeholder: "Pick A Role"
        });

        $('#save-changes').click(function(){
            $('#createUser').submit();
        });
        $('#createUser').validate({
            rules: {
                firstname: "required",
                lastname: "required",
                email_address: {
                    required: true,
                    email: true
                },
                role: "required"
            },
            messages: {
                firstname: "First Name cannot be empty",
                lastname: "Last Name cannot be empty",
                email_address: {
                    required: "Email Address cannot be empty",
                    email: "This is not an email"
                },
                role: "Please select a role"
            },
            errorElement: 'em',
            errorPlacement: function ( error, element ) {
                // Add the `help-block` class to the error element
                error.addClass( 'form-control-feedback' );
                if ( element.prop( 'type' ) === 'checkbox' ) {
                    error.insertAfter( element.parent( 'label' ) );
                } else {
                    error.insertAfter( element );
                }
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).addClass( 'form-control-danger' ).removeClass( 'form-control-success' );
                $( element ).parents( '.form-group' ).addClass( 'has-danger' ).removeClass( 'has-success' );
            },
            unhighlight: function (element, errorClass, validClass) {
                $( element ).addClass( 'form-control-success' ).removeClass( 'form-control-danger' );
                $( element ).parents( '.form-group' ).addClass( 'has-success' ).removeClass( 'has-danger' );
            }
        });
    });

    $('#btn-create-user').click(function(){
        // load modal
        $('#pageModal').modal();
    });
</script>