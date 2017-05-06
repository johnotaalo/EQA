<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('home_m');
	}
	
	// public function index()
	// {
	// 	$this->template->setPageTitle('External Quality Assurance Programme')->setPartial('home_v')->frontEndTemplate();
	// }

	public function index()
	{
		$this->template->setPageTitle('External Quality Assurance Programme')->setPartial('home_v2')->frontEndTemplate2();
	}

    public function FAQ()
    {
        $this->template->setPageTitle('External Quality Assurance Programme')->setPartial('faq')->frontEndTemplate2();
    }


	function sendMessage($round_uuid,$particapant_uuid){
        if($this->input->post()){
            
            $fname = $this->input->post('fname');
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            $email_to = "nhrlcd4eqa@nphls.or.ke";

            $data = [
                'names'  	=>  $fname,
                'email'  	=>  $email,
                'subject'  	=>  $subject,
                'message'  	=>  $message,
                'to'		=>  $email_to
            ];

            $body = $this->load->view('Template/email/message_v', $data, TRUE);
            $this->load->library('Mailer');
            $sent = $this->mailer->sendMail($email_to, $subject, $body);
            if ($sent == FALSE) {
                log_message('error', "The system could not send an email to {$email_to}, from: $fname at " . date('Y-m-d H:i:s'));
            }
                      
            redirect('Home/', 'refresh');
        }
    }


    function downloadSOP(){
        
    }


    //Function used to revise on how the export the pdf

    // file-> /uploads/docs/NHRL-PT-SOP-19042017.pdf

    // function dispatchList($pt_round_uuid){
    //     $table_header = [
    //         '#',
    //         'Recepient Name',
    //         'Recepient Phone',
    //         'Facility Name',
    //         'G4S Branch'
    //     ];

    //     $this->db->where('pt_round_uuid', $pt_round_uuid);
    //     $this->db->where('status_code', 2);
    //     $dispatch_ready = $this->db->get('pt_ready_participants')->result();
    //     $table_body = [];
    //     if ($dispatch_ready) {
    //         $counter = 1;
    //         foreach ($dispatch_ready as $ready) {
    //             $table_body[] = [
    //                 $counter,
    //                 "$ready->participant_fname $ready->participant_lname",
    //                 $ready->participant_phonenumber,
    //                 $ready->facility_name,
    //                 $ready->G4S_branch_name
    //             ];

    //             $counter++;
    //         }
    //     }

    //     $this->load->library('table');
    //     $this->load->config('table');

    //     $template = $this->config->item('default');

    //     $this->table->set_heading($table_header);
    //     $this->table->set_template($template);

    //     $viewData['dispatch_list'] = $this->table->generate($table_body);
    //     $pdf_view = $this->load->view('PTRounds/paneltracking/dispatch_list_v', $viewData, TRUE);       
    //     $data['document_title'] = "Dispatch List - Panel Tracking - " . date('d-m-Y');
    //     $this->load->library('pdf');
    //     $pdf = $this->pdf->load();
    //     $pdf->AddPage("L");
    //     $stylesheet = file_get_contents('./assets/dashboard/css/style.css');

    //     $pdf->WriteHTML($stylesheet, 1);
    //     $pdf->WriteHTML($pdf_view, 2);

    //     $pdf->output('Dispatch List ' . date('d-m-Y') . '.pdf', 'D');
    // }




}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */