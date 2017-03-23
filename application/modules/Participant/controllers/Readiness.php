<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Readiness extends MY_Controller {

	public function __construct(){
		parent::__construct();

		
		$this->load->model('M_Readiness');
	}

	public function authenticate()
	{
		$this->assets
			->addJs('dashboard/js/libs/jquery.validate.js')
            ->addJs("plugin/sweetalert/sweetalert.min.js");
        $this->assets->setJavascript('Participant/participant_login_js');
		$this->assets->addCss('css/signin.css');
		$this->template->setPageTitle('Readiness Form')->setPartial('login_v')->authTemplate();
	}

	public function authentication(){
		$user = $this->M_Readiness->findParticipant($this->input->post('usname'));
		//echo "<pre>";print_r($user);echo "</pre>";die();
		if ($user) {
			if($user->status == 1){
			$this->load->library('Hash');
				if (password_verify($this->input->post('passwd'), $user->password)) {
					
					$session_data = [
						'uuid'				=>	$user->uuid,
						'username'			=>	$user->username,
						'firstname'			=>	$user->firstname,
						'lastname'			=>	$user->lastname,
						'phone'				=>	$user->phone,
						'emailaddress'		=>	$user->email_address,
						'facilityid'		=>	$user->facility_code,
						'facilityname'		=>	$user->facility_name,
						'facilityphone'		=>	$user->telephone,
						'facilityaltphone'	=>	$user->alt_telephone,
						'is_logged_in'		=>	true
					];

					$this->set_session($session_data);
					echo "true";
				}
			}else{
				echo "not_active";
			}
		}else{
			echo "false";
		}
		
		$this->session->set_flashdata('error', 'Username or Password is incorrect. Please try again');
		redirect('Participant/Readiness/authenticate', 'refresh');
	}
	
	private function set_session($session_data){
		$this->session->set_userdata($session_data);        
    }

	public function logout()
    {
        $this->session->sess_destroy();
        redirect('Participant/Readiness/authenticate');
    }

    public function checkLogin(){
		if($this->session->userdata('is_logged_in') != true){
			redirect('Participant/Readiness/authenticate/','refresh');
		}
	}

	public function readinessChecklist(){
		$data = [];

		$user_details = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));
		$questions_data = $this->getQuestions();
		//echo "<pre>";print_r($questions_data);echo "</pre>";die();
        $data = [
            'user'  =>  $user_details,
            'questionnair'  =>  $questions_data
        ];

        $title = "Readiness Form";

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        $this->assets->setJavascript('Participant/readiness_form_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('readiness_form_v', $data)
                ->readinessTemplate();
	}

	function getQuestions(){
		$results = $this->db->get('questionnairs')->result();

		$question_view = '';
		$counter = 0;

		foreach ($results as $key => $questions) {
			$counter ++;
			
		 	if($questions->question_no == '4'){
				$question_view .= 	'<div id="checkNoAnswers" class="form-group">
	                				<div class="form-group row">
		                			<div class="form-group col-md-12">
		                			<label>';
		        $question_view .= 	$counter . '. ' .$questions->question;
		        $question_view .=   '</label>
		                			</div>
									</div>';
				
			}else if($questions->question_no == '4.1'){
				$counter --;

				$question_view .= 	'<div class="form-group row">
					                <div class="form-group">
					                <label class="col-md-6 form-control-label" for="textarea-input">';
				    $question_view .= 	' &nbsp (a). ' .$questions->question;
				    $questions->question_no = str_replace('.','_',$questions->question_no);
				    $question_view .=   '</label>
				                		<div class="col-md-6">
				                    	<textarea id="question_'.$questions->question_no.'" name="question_'.$questions->question_no.'" rows="8" class="form-control" placeholder="Please provide reason for any No selection..."></textarea>
				                		</div>
				            			</div>
				        				</div>';

			}else if($questions->question_no == '4.2'){
				$counter --;

				$question_view .= 	'<div class="form-group row">
	                    			<label class="col-md-6 form-control-label">';
		        $question_view .= 	' &nbsp (b). ' .$questions->question;
		        $questions->question_no = str_replace('.','_',$questions->question_no);
		        $question_view .=   '</label>
	                    			<div class="col-md-6">
	                        		<label class="radio-inline" for="inline-radio1">';
            	$question_view .= 	'<input type="radio" id="question_'.$questions->question_no.'_1" name="question_'.$questions->question_no.'" value="1">Yes';
				$question_view .= 	'</label>
	    							<label class="radio-inline" for="inline-radio2">';
				$question_view .= 	'<input type="radio" id="question_'.$questions->question_no.'_0" name="question_'.$questions->question_no.'" value="0">No';
				$question_view .= 	'</label>
								    </div>
									</div>
									</div>';    				

		 	}else{
		 		$question_view .= 	'<div class="form-group row">
							 		<label class="col-md-6 form-control-label">';
		 		$question_view .= 	$counter . '. ' .$questions->question;
	 			$question_view .= 	'</label>
	    							<div class="col-md-6">
	        						<label class="radio-inline" for="inline-radio1">';
				$question_view .= 	'<input type="radio" id="question_'.$questions->question_no.'_1" name="question_'.$questions->question_no.'" value="1">Yes';
				$question_view .= 	'</label>
	    							<label class="radio-inline" for="inline-radio2">';
				$question_view .= 	'<input type="radio" id="question_'.$questions->question_no.'_0" name="question_'.$questions->question_no.'" value="0">No';
				$question_view .= 	'</label>
								    </div>
									</div>';
		 	}

		 }

		return $question_view;
	}

	public function submitReadiness(){
		$response_array = [];
		if($this->input->post()){
            $question1 = $this->input->post('question_1');
            $question2 = $this->input->post('question_2');
            $question3 = $this->input->post('question_3');
            $question4_1 = $this->input->post('question_4_1');
            $question4_2 = $this->input->post('question_4_2');
            $question5 = $this->input->post('question_5');
            $username  =   $this->session->userdata('username');
            $facilityid  =   $this->session->userdata('facilityid');
            $pt_round_no = '';

            $response_array[] = [
            	'1'		=>	$question1,
            	'2'		=>	$question2,
            	'3'		=>	$question3,
                '5'     =>  $question4_1,
                '6'    	=>  $question4_2,
                '7'    	=>  $question5
            ];

            


            $insertrounddata = [
            	'participant_id'	=>	$username,
            	'pt_round_no'		=>	$pt_round_no,
            	'status'			=>	0,
                'verdict'    	  	=>  0,
                'comment'    		=>  'No comment made'
            ];

            $this->db->insert('participant_readiness', $insertrounddata);

            $readiness_id = $this->db->insert_id();

            foreach ($response_array as $key => $values) {
            	foreach ($values as $question_id => $response) {
	            	//echo "<pre>";print_r($value);echo "</pre>";die();

	            	$insertresponsedata = [
		            	'readiness_id'	=>	$readiness_id,
		            	'questionnaire_id'		=>	$question_id,
		            	'response'			=>	$response
	            	];

	            	$this->db->insert('participant_readiness_responses', $insertresponsedata);
            	}	
            }

            

            redirect('/', 'refresh');
        }
	}


	public function assessmentForm(){

	}

	
}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */