<?php

class FAQ extends DashboardController{
    function __construct(){
        parent::__construct();
        $this->load->library('table');
        $this->load->config('table');

        //$this->load->model('Equipments/M_Equipments');
    }

    function index(){
    }


    function faqlist(){
        $data = [];
        $title = "FAQs";

        $data = [
            'table_view'    =>  $this->createFAQTable()
        ];

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        $this->assets->setJavascript('FAQ/faq_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('FAQ/faqs_v', $data)
                ->adminTemplate();
    }

    function newFAQ(){
        $data = [];
        $title = "FAQ";

        $data = [
               
            ];

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        $this->assets->setJavascript('FAQ/faq_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('FAQ/new_faq_v', $data)
                ->adminTemplate();
    }

    function createFAQTable(){

        $template = $this->config->item('default');

        $heading = [
            "No.",
            "Title",
            "Question",
            "Answer",
            "Status",
            "Actions"
        ];
        $tabledata = [];

        $faqs = $this->db->get('faqs')->result();


        if($faqs){
            $counter = 0;
            foreach($faqs as $faq){
                $counter ++;
                $id = $faq->id;
                if($faq->status == 1){
                    $status = "<label class = 'tag tag-success tag-sm'>Active</label>";
                    $change_state = '<a href = ' . base_url("FAQ/changeState/deactivate/$id") . ' class = "btn btn-danger btn-sm"><i class = "icon-refresh"></i>&nbsp;Deactivate </a>';
                    
                }else{
                    $status = "<label class = 'tag tag-danger tag-sm'>Inactive</label>";
                    $change_state = '<a href = ' . base_url("FAQ/changeState/activate/$id") . ' class = "btn btn-warning btn-sm"><i class = "icon-refresh"></i>&nbsp;Activate </a>';
                }

                $change_state .= ' <a href = ' . base_url("FAQ/faqEdit/$id") . ' class = "btn btn-primary btn-sm"><i class = "icon-note"></i>&nbsp;Edit</a>';
                
                $tabledata[] = [
                    $counter,
                    $faq->title,
                    $faq->question,
                    $faq->answer,
                    $status,
                    $change_state
                ];
            }
        }
        $this->table->set_heading($heading);
        $this->table->set_template($template);

        return $this->table->generate($tabledata);
    }


    function changeState($type, $id){
        switch($type){
            case 'activate':
                $this->db->set('status', 1);

            break;

            case 'deactivate':
                $this->db->set('status', 0);
                
            break;
        }

        $this->db->where('id', $id);

        if($this->db->update('faqs')){
            $this->session->set_flashdata('success', "Successfully updated the FAQ details");
        }else{
            $this->session->set_flashdata('error', "There was a problem updating the FAQ details. Please try again");
        }

        redirect('FAQ/faqlist', 'refresh');

    }


    function create(){
        if($this->input->post()){
            $title = $this->input->post('title');
            $question = $this->input->post('question');
            $answer = $this->input->post('answer');

            $insertdata = [
                'title'    =>  $title,
                'question'    =>  $question,
                'answer'    =>  $answer,
                'status'    =>  1
            ];


            if($this->db->insert('faqs', $insertdata)){
                $this->session->set_flashdata('success', "Successfully created new FAQ");

                redirect('FAQ/faqlist/');

            }else{
                $this->session->set_flashdata('error', "There was a problem creating a new FAQ. Please try again");
            }

        }
    }


    function faqEdit($id){
        $this->db->where('id', $id);
        $faq = $this->db->get('faqs')->row();
        //echo '<pre>';print_r($equipment);echo '</pre>';die();
        
        $data = [
            'faqid'          =>  $faq->id,
            'title'        =>  $faq->title,
            'question'        =>  $faq->question,
            'answer'              =>  $faq->answer,
            'status'          =>  $faq->status
        ];

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        // $this->assets->setJavascript('FAQ/faq_update_js');
        $this->template
                ->setPartial('FAQ/faq_edit_v', $data)
                ->setPageTitle('FAQ Edit')
                ->adminTemplate();
    }


    function editFAQ(){
        if($this->input->post()){
            $faqid = $this->input->post('faqid');
            $title = $this->input->post('title');
            $question = $this->input->post('question');
            $answer = $this->input->post('answer'); 

            $this->db->set('title', $title);
            $this->db->set('question', $question);
            $this->db->set('answer', $answer);

            $this->db->where('id', $faqid);



            if($this->db->update('faqs')){
                
                $this->session->set_flashdata('success', "Successfully updated the FAQ ");

            }else{
                $this->session->set_flashdata('error', "There was a problem updating the FAQ details. Please try again");
            }

            redirect('FAQ/faqlist', 'refresh');
        }
    }


}