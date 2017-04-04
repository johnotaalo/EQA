<script>
    $(document).ready(function(){
        var question_4_1 = document.getElementById("question_4_1");


        $('table').dataTable();
        $('.absolute').hide();
        $('.percent').hide();

        $('#absolute').click(function() {
            if(document.getElementById('absolute').checked){
                $('.absolute').slideDown();
            }else{
                $('.absolute').slideUp();
            }
        });

        $('#percent').click(function() {
            if(document.getElementById('percent').checked){
                $('.percent').slideDown();
            }else{
                $('.percent').slideUp();
            }
        });


        $('#add-flouro').click(function(){
            var rowCount = numberofrows();
            var number = rowCount+1;
             $('#flourochromes fieldset:last').after(customizeRow(number));
        });

    function numberofrows(){
        var rowCount = $('#flourochromes fieldset').length;
        return rowCount;
    }

    function customizeRow(counter){
        return "<fieldset class='page-signup-form-group form-group form-group-lg'><div class = 'form-group'><div class = 'form-group'><label class = 'control-label col-md-3'>Flourochrome "+counter+"</label><div class='col-md-9'><input type = 'text' name = 'flourochromes[]' class = 'form-control'/></div></div></fieldset>";
    }


    
                   


        
});    
</script>