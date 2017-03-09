<script>
    $(document).ready(function(){
        $('#uploadImage').click(function(){
            $("input[name='userAvatar']").click();
        });

        $("input[name='userAvatar']").change(function(){
            readInput(this);
        });

        // $.validator.setDefaults({
        //     submitHandler: function () {
        //         $('#editForm').submit();
        //     }
        // });

        $('input[name="old_password"]').keyup(function(){
            if($(this).val() !== ""){
                $('input[name="new_password"]').prop('disabled', false);
                $('input[name="confirm_new_password"]').prop('disabled', false);
            }else{
                $('input[name="new_password"]').prop('disabled', true);
                $('input[name="confirm_new_password"]').prop('disabled', true);
            }
        });

        $('#editForm').validate({
            rules: {
                firstname: "required",
                lastname: "required",
                email_address: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?= @base_url('API/Users/checkEmail'); ?>",
                        type: "POST"
                    }
                },
                phonenumber:{
                    remote: {
                        url: "<?= @base_url('API/Users/checkPhone'); ?>",
                        type: "POST"
                    }
                },
                new_password: {
                    minlength: 5,
                    required: true
                },
                confirm_new_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#new_password"
                }
            },
            messages: {
                firstname: "First Name cannot be empty",
                lastname: "Last Name cannot be empty",
                email_address: {
                    required: "Email Address cannot be empty",
                    email: "This is not an email",
                    remote: "Email already taken"
                },
                phonenumber: {
                    remote: "Phone number already taken"
                },
                new_password: {
                    minlength: "Password is too short",
                    required: "Please enter a new password"
                }
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

    function readInput(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(document.getElementById("userAvatar").files[0]);
            reader.onload = function (e) {
                $('img#avatarImg').attr('src', e.target.result);
            }
        }
    }
</script>