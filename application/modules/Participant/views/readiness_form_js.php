<script>   
    $(document).ready(function(){
    	var question_4_1 = document.getElementById("question_4_1");
    	var question_4_2_0 = document.getElementById("question_4_2_1");
    	var question_4_2_1 = document.getElementById("question_4_2_0");


	   	$('#checkNoAnswers').hide();
		question_4_1.disabled = true;
		question_4_2_0.disabled = true;
		question_4_2_1.disabled = true;

		$(question11).val();
        var question11= $(this).attr('question_1_1');
        var question21= $(this).attr('question_2_1');
        var question31= $(this).attr('question_2_1');


	$('input[type="radio"]').click(function() {
       if(($(this).attr('id') == 'question_1_0')) {
	   	    $divcheck = $('#checkNoAnswers').is(":visible"); 	
	       	if(!($divcheck)){
				activatequestion();
	       	}
            
       	}
   });

	$('input[type="radio"]').click(function() {
       if(($(this).attr('id') == 'question_2_0')) {
	   	    $divcheck = $('#checkNoAnswers').is(":visible"); 	
	       	if(!($divcheck)){
				activatequestion();
	       	}
            
       	}
   });

	$('input[type="radio"]').click(function() {
       if(($(this).attr('id') == 'question_3_0')) {
	   	    $divcheck = $('#checkNoAnswers').is(":visible"); 	
	       	if(!($divcheck)){
				activatequestion();
	       	}
            
       	}
   });

	$('input[type="radio"]').click(function() {
	 	if(($(this).attr('id') == 'question_1_1')){
       		$checkNo = checkIfNoAnswer();
	       	if(!($checkNo)){
	       		deactivatequestion(); 
	       	}
       	}
   });

	$('input[type="radio"]').click(function() {
	 	if(($(this).attr('id') == 'question_2_1')){
       		$checkNo = checkIfNoAnswer();
	       	if(!($checkNo)){
	       		deactivatequestion(); 
	       	}
       	}
   });

	$('input[type="radio"]').click(function() {
	 	if(($(this).attr('id') == 'question_3_1')){
       		$checkNo = checkIfNoAnswer();
	       	if(!($checkNo)){
	       		deactivatequestion(); 
	       	}
       	}
   });



	function activatequestion(){
		$('#checkNoAnswers').slideDown();  
        question_4_1.disabled = false;
		question_4_2_0.disabled = false;
		question_4_2_1.disabled = false;  
	}

	function deactivatequestion(){
		$('#checkNoAnswers').slideUp();
		question_4_1.disabled = true;
		question_4_2_0.disabled = true;
		question_4_2_1.disabled = true;
	}

	function checkIfNoAnswer(){
		$que1 = $('#question_1_0').is(":checked"); 
		$que2 = $('#question_2_0').is(":checked"); 
		$que3 = $('#question_3_0').is(":checked");

		if($que1 || $que2 || $que3){
			return true;
		} else{
			return false;
		}
	}


    });
</script>