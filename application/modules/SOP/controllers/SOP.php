<?php

class SOP extends DashboardController{
    function __construct(){
        parent::__construct();
        $this->load->library('table');
        $this->load->config('table');

        //$this->load->model('Equipments/M_Equipments');
    }

    function index(){
    }


    function soplist(){
        $data = [];
        $title = "SOPs";

        $data = [
            'table_view'    =>  $this->createSOPTable()
        ];

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs("dashboard/js/libs/toastr.min.js");
        $this->assets->setJavascript('SOP/sop_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('SOP/sop_v', $data)
                ->adminTemplate();
    }

    function newSOP(){
        $data = [];
        $title = "SOP";

        $data = [
               
            ];

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        $this->assets->setJavascript('SOP/sop_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('SOP/new_sop_v', $data)
                ->adminTemplate();
    }

    function createsopTable(){

        $template = $this->config->item('default');

        $heading = [
            "No.",
            "Name (Click to download)",
            "Date of Entry",
            "Status",
            "Actions"
        ];
        $tabledata = [];

                $this->db->order_by('id','desc');
        $sops = $this->db->get('sops')->result();


        if($sops){
            $counter = 0;
            foreach($sops as $sop){
                $counter ++;
                $id = $sop->id;
                if($sop->current == 1){
                    $status = "<label class = 'tag tag-success tag-sm'>Current</label>";
                    $change_state = '<a href = ' . base_url("SOP/soplist/#") . ' class = "btn btn-primary btn-sm showtoast">&nbsp;Marked a Current </a>';
                    
                }else{
                    $status = "<label class = 'tag tag-danger tag-sm'>Not Current</label>";
                    $change_state = '<a href = ' . base_url("SOP/changeState/$id") . ' class = "btn btn-warning btn-sm">&nbsp;Set as Current </a>';
                }
                
                $tabledata[] = [
                    $counter,
                    "<a download href=".$sop->sop_path." >".$sop->sop_name."</a>",
                    $sop->date_of_entry,
                    $status,
                    $change_state
                ];
            }
        }
        $this->table->set_heading($heading);
        $this->table->set_template($template);

        return $this->table->generate($tabledata);
    }


    function changeState($id){
                $this->db->set('current', 0);
                if($this->db->update('sops')){
                    $this->db->set('current', 1);
                    $this->db->where('id', $id);

                     if($this->db->update('sops')){
                            $this->session->set_flashdata('success', "Successfully marked the SOP details");
                        }else{
                            $this->session->set_flashdata('error', "There was a problem marking the SOP details. Please try again");
                        }
                }

       

        redirect('sop/soplist', 'refresh');

    }


    function create(){
        if($this->input->post()){
            $name = $this->input->post('sop_name');

            $file_upload_errors = [];
            $file_path = NULL;

            if($_FILES){
                $config['upload_path'] = './uploads/docs/SOPS/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 10000000;
                $this->load->library('upload', $config);

                $this->upload->initialize($config); 
                $docCheck = $this->upload->do_upload('sop_file');
 


                if (!$docCheck) {
                    $file_upload_errors = $this->upload->display_errors();
                    echo "<pre>";print_r($file_upload_errors);echo "</pre>";die();
                }else{
                    $data =$this->upload->data();
                    $file_path = substr($config['upload_path'], 1) . $data['file_name'];

                    if(!($name)){
                        $name = $data['file_name'];
                    }
                }
            }
            
            if(!$file_upload_errors){

                    $insertsopdata = [
                            'sop_name'    =>  $name,
                            'sop_path'  =>  $file_path
                        ];



                    if($this->db->insert('sops', $insertsopdata)){
                        $sop_id = $this->db->insert_id();

                        echo "submission_save";
                    $this->session->set_flashdata('success', "Successfully saved new SOP");


                    }else{
                        //echo "submission_error";
                        $this->session->set_flashdata('error', "A problem was encountered while saving SOP. Please try again...");
                    }

                    
                    redirect('SOP/soplist/');
                
            }else{
                echo "file error";
                $this->session->set_flashdata('error', $file_upload_errors);
            }

        }
    }



}