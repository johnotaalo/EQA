<script>   
    $(document).ready(function(){
    	var question_4_1 = document.getElementById("question_4_1");
    	var question_4_2_0 = document.getElementById("question_4_2_1");
    	var question_4_2_1 = document.getElementById("question_4_2_0");


	   	$('#checkNoAnswers').hide();
		question_4_1.disabled = true;
		question_4_2_0.disabled = true;
		question_4_2_1.disabled = true;


	$('input[type="radio"]').click(function() {
       if(($(this).attr('id') == 'question_1_0') || ($(this).attr('id') == 'question_2_0') || ($(this).attr('id') == 'question_3_0')) {
	   	    $divcheck = $('#checkNoAnswers').is(":visible"); 	
	       	if(!($divcheck)){
				activatequestion();  
	       	}
            
       	}else if(($(this).attr('id') == 'question_1_1') && ($(this).attr('id') == 'question_2_1') && ($(this).attr('id') == 'question_3_1')){
       		$divcheck = $('#checkNoAnswers').is(":visible"); 	
	       	if($divcheck){
				deactivatequestion();  
	       	}
               
       }
   });



	function activatequestion(){
		$('#checkNoAnswers').show();  
        question_4_1.disabled = false;
		question_4_2_0.disabled = false;
		question_4_2_1.disabled = false;  
	}

	function deactivatequestion(){
		$('#checkNoAnswers').hide();
		question_4_1.disabled = true;
		question_4_2_0.disabled = true;
		question_4_2_1.disabled = true;
	}


    });
</script>