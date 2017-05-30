<script>
    $(document).ready(function(){


        $('#equipmentEditForm').validate({
            rules: {
                equipmentid: "required",
                equipmentname: "required"
            },
            messages: {
                equipmentid: "Could not get the equipment data",
                equipmentname: "Equipment Name cannot be empty"
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



        $('#add-edit-flouro').click(function(){
            
            var rowCount = numberofrows();
            var num = rowCount+1;
            //alert(number);
            $('#flouro-chromes div.divcounter:last').after(customizeRow(num));
        });

        function numberofrows(){
            var rowCount = $('#flouro-chromes div.divcounter').length;
            return rowCount;
        }

        function customizeRow(number){
            return "<div class = 'form-group row divcounter'><label class = 'col-md-3 form-control-label counter'>Flourochrome "+number+"</label><div class = 'col-md-6'><input type = 'text' name = 'flouro[]' class = 'form-control' required/></div><div class = 'col-md-3'><a class = 'remove-flouro'><i class = 'fa fa-times'></i></a></div></div>";

            // <center><a class = 'remove-sample'><i class = 'fa fa-times'></i></a></center>
        }

        $('#flouro-chromes').on('click', 'a.remove-flouro' , function(){
            if(numberofrows() > 1){
                $(this).parent().parent().remove();
                $('#flouro-chromes div.divcounter').each(function(i, row){
                    var $row = $(row);
                    var row_no = $(row).children(":first");
                    var sample_number = $(row).find('label.counter');

                    sample_number.text('Flourochrome '+(i+1));
                    row_no.text('Flourochrome '+(i+1));
                });
            }else{
                alert("You must have at least one flourochrome");
            }
        });


        
    });
</script>