<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PTRound extends MY_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Participant/M_PTRound');
        $this->load->model('Participant/M_Readiness');
        $this->load->library('Mailer');
    }

    public function index(){
        
            $data = [
                'pt_rounds'    =>  $this->createPTRoundTable()
            ];

            $this->template->setPageTitle('EQA Dashboard')->setPartial("pt_view",$data)->adminTemplate();
    }

    function createPTRoundTable(){
        $rounds = $this->db->get('pt_round_v')->result();
        $ongoing = $prevfut = '';
        $round_array = [];
        if ($rounds) {
            foreach ($rounds as $round) {
                $created = date('dS F, Y', strtotime($round->date_of_entry));
                $view = "<a class = 'btn btn-success btn-sm' href = '".base_url('Participant/PTRound/Round/' . $round->uuid)."'><i class = 'fa fa-eye'></i>&nbsp;View</a>";
                $panel_tracking = "<a class = 'btn btn-danger btn-sm' href = '".base_url('Participant/PTRound/Tracking/' . $round->uuid)."'><i class = 'fa fa-truck'></i>&nbsp;Panel Tracking</a>";
                $status = ($round->status == "active") ? '<span class = "tag tag-success">Active</span>' : '<span class = "tag tag-danger">Inactive</span>';
                if ($round->type == "ongoing") {
                    $ongoing .= "<tr>
                    <td>{$round->pt_round_no}</td>
                    <td>{$created}</td>
                    <td>{$status}</td>
                    <td>{$view} {$panel_tracking}</td>
                    </tr>";
                }else{
                    $prevfut .= "<tr>
                    <td>{$round->pt_round_no}</td>
                    <td>{$created}</td>
                    <td>{$status}</td>
                    <td>{$view} {$panel_tracking}</td>
                    </tr>";
                }
            }
        }

        $round_array = [
            'ongoing'   =>  $ongoing,
            'prevfut'   =>  $prevfut
        ];

        return $round_array;
    }

    public function Round($round_uuid){
        $user = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));
        

        $participant_id = $user->username;
        $facility_code = $user->facility_code;

        $equipments = $this->M_PTRound->Equipments();

        //echo "<pre>";print_r($equipments);echo "</pre>";die();
        $equipment_tabs = $this->createTabs($round_uuid,$participant_id,$equipments);

        $data = [
                'pt_uuid'    =>  $round_uuid,
                'participant'    =>  $participant_id,
                'equipment_tabs'    =>  $equipment_tabs,
                'data_submission' => 'data_submission',
                'participant_report' => 'participant_report'

            ];
                
        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js')
                ->addJs("plugin/sweetalert/sweetalert.min.js");
        $this->assets->setJavascript('Participant/data_submission_js');
        $this->assets->addCss('css/signin.css');
        $this->template->setPageTitle('PT Forms')->setPartial('pt_form_v',$data)->adminTemplate();
    }

    public function Tracking($round_uuid){
        $user = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));
        $data = [
                'pt_uuid'    =>  $round_uuid,
                'user'    =>  $user,
                'participant_report' => 'participant_report',
                'data_submission' => 'data_submission',
                'equipment_information' => 'equipment_information'
            ];
        $this->assets
            ->addJs('dashboard/js/libs/jquery.validate.js')
            ->addJs("plugin/sweetalert/sweetalert.min.js");
        $this->assets->setJavascript('Participant/participant_login_js');
        $this->assets->addCss('css/signin.css');
        $this->template->setPageTitle('PT Forms')->setPartial('pt_tracking_v',$data)->adminTemplate();
    }


    public function dataSubmission($type,$round){
        //echo json_encode('reached');  
        if($this->input->post()){

            $user = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));

            $round_id = $this->M_Readiness->findRoundByIdentifier('uuid', $round)->id;
            $participant_id = $user->username;

            

            $equipments = $this->M_PTRound->Equipments();
            $samples = $this->M_PTRound->getSamples($round_id,$participant_id);
                        

            foreach ($equipments as $key => $equipment) {
                $eq_id = $equipment->id;
                //echo "<pre>";print_r($eq_id);echo "</pre>";

                $submission = $this->M_PTRound->getDataSubmission($round_id,$participant_id,$eq_id);
 
                $cd3_abs = $this->input->post('cd3_abs_'.$eq_id);
                $cd3_per = $this->input->post('cd3_per_'.$eq_id);
                $cd4_abs = $this->input->post('cd4_abs_'.$eq_id);
                $cd4_per = $this->input->post('cd4_per_'.$eq_id);
                $other_abs = $this->input->post('other_abs_'.$eq_id);
                $other_per = $this->input->post('other_per_'.$eq_id);

                if(!($submission)){
                    $insertsampledata = [
                        'round_id'    =>  $round_id,
                        'participant_id'    =>  $participant_id,
                        'equipment_id'    =>  $eq_id,
                        'status'    =>  0
                    ];

                    if($this->db->insert('pt_data_submission', $insertsampledata)){

                        $submission_id = $this->db->insert_id();
                        foreach ($samples as $key => $sample) {
                            
                            $insertequipmentdata = [
                            'sample_id'    =>  $submission_id,
                            'cd3_absolute'    =>  $cd3_abs,
                            'cd3_percent'    =>  $cd3_per,
                            'cd4_absolute'    =>  $cd4_abs,
                            'cd4_percent'    =>  $cd4_per,
                            'other_absolute'    =>  $other_abs,
                            'other_percent'    =>  $other_per
                        ];

                        $this->db->insert('pt_equipment_results', $insertequipmentdata);
                        }
                        
                    }
                }else{
                    $submission_id = $submission->id;

                    $this->db->set('cd3_absolute', $cd3_abs);
                    $this->db->set('cd3_percent', $cd3_per);
                    $this->db->set('cd4_absolute', $cd4_abs);
                    $this->db->set('cd4_percent', $cd4_per);
                    $this->db->set('other_absolute', $other_abs);
                    $this->db->set('other_percent', $other_per);

                    $this->db->where('sample_id', $submission_id);
                    $this->db->update('pt_equipment_results');
                }

                

                
            }
                    

            switch ($type) {
                case 'draft':

                    $this->session->set_flashdata('success', "Successfully saved as draft ");
                       //echo json_encode('draft');
            
                    break;

                case 'complete':

                    $this->db->set('status', 1);
                    $this->db->where('round_id', $submission->round_id);

                    if($this->db->update('pt_data_submission')){
                        $this->session->set_flashdata('success', "Successfully completed the submission for PT");
                    }else{
                        $this->session->set_flashdata('error', "There was a problem completing the submission. Please try again");
                    }

                    //echo json_encode('complete');

                    
                    break;
                
                default:
                    echo 'There was a problem with data submission. Please contact the administrator'; die();
                    break;
            }

        }else{
          echo json_encode('nopost');  
        }

        
    }

    public function createTabs($round_uuid, $participant_id, $equipments){
        
        $tab = 0;
        $samples = $this->M_PTRound->getSamples($round_uuid,$participant_id);
        //echo "<pre>";print_r($samples);echo "</pre>";die();
        $equipment_tabs = '';

        $equipment_tabs .= "<ul class='nav nav-tabs' role='tablist'>";

        foreach ($equipments as $key => $equipment) {
            $tab++;
            $equipment_tabs .= "<li class='nav-item'>";
            if($tab == 1){
                $equipment_tabs .= "<a class='nav-link active' data-toggle='tab'";
            }else{
                $equipment_tabs .= "<a class='nav-link' data-toggle='tab'";
            }

            $equipmentname = $equipment->equipment_name;
            $equipmentname = str_replace(' ', '_', $equipmentname);
            
            $equipment_tabs .= " href='#".$equipmentname."' role='tab' aria-controls='home'><i class='icon-calculator'></i>&nbsp;";
            $equipment_tabs .= $equipment->equipment_name;
            $equipment_tabs .= "&nbsp;";
            // $equipment_tabs .= "<span class='tag tag-success'>Complete</span>";
            $equipment_tabs .= "</a>
                                </li>";
        }

        $equipment_tabs .= "</ul>
                            <div class='tab-content'>";

        $counter = 0;
        $counter2 = 0;
        foreach ($equipments as $key => $equipment) {
            $counter++;

            $equipmentname = $equipment->equipment_name;
            $equipmentname = str_replace(' ', '_', $equipmentname);

            if($counter == 1){
                $equipment_tabs .= "<div class='tab-pane active' id='". $equipmentname ."' role='tabpanel'>";
            }else{
                $equipment_tabs .= "<div class='tab-pane' id='". $equipmentname ."' role='tabpanel'>";
            }
            



            $equipment_tabs .= "<div class='row'>
        <div class='col-sm-12'>
        <div class='card'>
            <div class='card-header'>
                <strong>RESULTS FOR ". $equipment->equipment_name ."</strong>
            </div>
            <div class='card-block'>
                <div class='row'>
                    <table class='table table-bordered'>
                        <tr>
                            <th style='text-align: center;' rowspan='3'>
                                PANEL
                            </th>
                            <th style='text-align: center;' colspan='7'>
                                RESULT
                            </th>
                        </tr>
                        <tr>
                            <th style='text-align: center;' colspan='2'>
                                CD3
                            </th>
                            <th style='text-align: center;' colspan='2'>
                                CD4
                            </th>
                            <th style='text-align: center;' colspan='2'>
                                Other (Specify)
                            </th>
                        </tr>
                        <tr>
                            <th style='text-align: center;'>
                                Absolute
                            </th>
                            <th style='text-align: center;'>
                                Percent
                            </th>
                            <th style='text-align: center;'>
                                Absolute
                            </th>
                            <th style='text-align: center;'>
                                Percent
                            </th>
                            <th style='text-align: center;'>
                                Absolute
                            </th>
                            <th style='text-align: center;'>
                                Percent
                            </th>
                        </tr>";

                    
                    foreach ($samples as $key => $sample) {
                        $counter2 ++;
                        $equipment_tabs .= "<tr>
                                            <th style='text-align: center;'>";
                        $equipment_tabs .= $sample->sample_name;

                        $equipment_tabs .= "</th>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd3_abs_$equipment->id'>
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd3_per_$equipment->id'>
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd4_abs_$equipment->id'>
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd4_per_$equipment->id'>
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'other_abs_$equipment->id'>
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'other_per_$equipment->id'>
                            </td>
                        </tr>";
                    }

                    $equipment_tabs .= "</table>
                                        </div>
                                        </div>   
                                        </div>
                                        </div>
                                        </div>
                                        </div>";
        }

        $equipment_tabs .= "</div>";

        return $equipment_tabs;

    }

    public function participantRepoSubmission(){
        if($this->input->post()){
        //echo "<pre>";print_r("PT UUID".$pt_round_no);echo "</pre>";die();
            $user = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));
            
            $pt_round_no = $this->input->post('ptround');
            $participant = $user->uuid;

            $instrument = $this->input->post('instrument');
            $sdplatform = $this->input->post('sdplatform');
            $analytes = $this->input->post('analytes');
            $flourochromes = $this->input->post('flourochromes');
            $antiflourochromes = $this->input->post('antiflourochromes');

            $fl1 = $this->input->post('fl1');
            $fl2 = $this->input->post('fl2');
            $antibody3 = $this->input->post('antibody3');
            $fl3 = $this->input->post('fl3');
            $antibody4 = $this->input->post('antibody4');
            $fl4 = $this->input->post('fl4');

            $lysemethod = $this->input->post('lysemethod');
            $acb = $this->input->post('acb');

            $ac1 = $this->input->post('ac1');
            $p1 = $this->input->post('p1');
            $ac2 = $this->input->post('ac2');
            $p2 = $this->input->post('p2');
            $ac3 = $this->input->post('ac3');
            $p3 = $this->input->post('p3');


            // Absolute Counts

            $counts_panel1_rep_cd3 = $this->input->post('counts_panel1_rep_cd3');
            $counts_panel1_rep_cd4 = $this->input->post('counts_panel1_rep_cd4');
            $counts_panel2_rep_cd3 = $this->input->post('counts_panel2_rep_cd3');
            $counts_panel2_rep_cd4 = $this->input->post('counts_panel2_rep_cd4');
            $counts_panel3_rep_cd3 = $this->input->post('counts_panel3_rep_cd3');
            $counts_panel3_rep_cd4 = $this->input->post('counts_panel3_rep_cd4');

            $counts_panel1_mean_cd3 = $this->input->post('counts_panel1_mean_cd3');
            $counts_panel1_mean_cd4 = $this->input->post('counts_panel1_mean_cd4');
            $counts_panel2_mean_cd3 = $this->input->post('counts_panel2_mean_cd3');
            $counts_panel2_mean_cd3 = $this->input->post('counts_panel2_mean_cd4');
            $counts_panel3_mean_cd3 = $this->input->post('counts_panel3_mean_cd3');
            $counts_panel3_mean_cd4 = $this->input->post('counts_panel3_mean_cd4');

            $counts_panel1_res_cd3 = $this->input->post('counts_panel1_res_cd3');
            $counts_panel1_res_cd4 = $this->input->post('counts_panel1_res_cd4');
            $counts_panel2_res_cd3 = $this->input->post('counts_panel2_res_cd3');
            $counts_panel2_res_cd4 = $this->input->post('counts_panel2_res_cd4');
            $counts_panel3_res_cd3 = $this->input->post('counts_panel3_res_cd3');
            $counts_panel3_res_cd4 = $this->input->post('counts_panel3_res_cd4');

            $counts_panel1_sd_cd3 = $this->input->post('counts_panel1_sd_cd3');
            $counts_panel1_sd_cd4 = $this->input->post('counts_panel1_sd_cd4');
            $counts_panel2_sd_cd3 = $this->input->post('counts_panel2_sd_cd3');
            $counts_panel2_sd_cd4 = $this->input->post('counts_panel2_sd_cd4');
            $counts_panel3_sd_cd3 = $this->input->post('counts_panel3_sd_cd3');
            $counts_panel3_sd_cd4 = $this->input->post('counts_panel3_sd_cd4');

            $counts_panel1_sdi_cd3 = $this->input->post('counts_panel1_sdi_cd3');
            $counts_panel1_sdi_cd4 = $this->input->post('counts_panel1_sdi_cd4');
            $counts_panel2_sdi_cd3 = $this->input->post('counts_panel2_sdi_cd3');
            $counts_panel2_sdi_cd4 = $this->input->post('counts_panel2_sdi_cd4');
            $counts_panel3_sdi_cd3 = $this->input->post('counts_panel3_sdi_cd3');
            $counts_panel3_sdi_cd4 = $this->input->post('counts_panel3_sdi_cd4');

            $counts_panel1_per_cd3 = $this->input->post('counts_panel1_per_cd3');
            $counts_panel1_per_cd4 = $this->input->post('counts_panel1_per_cd4');
            $counts_panel2_per_cd3 = $this->input->post('counts_panel2_per_cd3');
            $counts_panel2_per_cd4 = $this->input->post('counts_panel2_per_cd4');
            $counts_panel3_per_cd3 = $this->input->post('counts_panel3_per_cd3');
            $counts_panel3_per_cd4 = $this->input->post('counts_panel3_per_cd4');

            // Absolute Counts

            // Percentage

            $percentage_panel1_rep_cd3 = $this->input->post('percentage_panel1_rep_cd3');
            $percentage_panel1_rep_cd4 = $this->input->post('percentage_panel1_rep_cd4');
            $percentage_panel2_rep_cd3 = $this->input->post('percentage_panel2_rep_cd3');
            $percentage_panel2_rep_cd4 = $this->input->post('percentage_panel2_rep_cd4');
            $percentage_panel3_rep_cd3 = $this->input->post('percentage_panel3_rep_cd3');
            $percentage_panel3_rep_cd4 = $this->input->post('percentage_panel3_rep_cd4');

            $percentage_panel1_mean_cd3 = $this->input->post('percentage_panel1_mean_cd3');
            $percentage_panel1_mean_cd4 = $this->input->post('percentage_panel1_mean_cd4');
            $percentage_panel2_mean_cd3 = $this->input->post('percentage_panel2_mean_cd3');
            $percentage_panel2_mean_cd4 = $this->input->post('percentage_panel2_mean_cd4');
            $percentage_panel3_mean_cd3 = $this->input->post('percentage_panel3_mean_cd3');
            $percentage_panel3_mean_cd4 = $this->input->post('percentage_panel3_mean_cd4');

            $percentage_panel1_res_cd3 = $this->input->post('percentage_panel1_res_cd3');
            $percentage_panel1_res_cd4 = $this->input->post('percentage_panel1_res_cd4');
            $percentage_panel2_res_cd3 = $this->input->post('percentage_panel2_res_cd3');
            $percentage_panel2_res_cd4 = $this->input->post('percentage_panel2_res_cd4');
            $percentage_panel3_res_cd3 = $this->input->post('percentage_panel3_res_cd3');
            $percentage_panel3_res_cd4 = $this->input->post('percentage_panel3_res_cd4');

            $percentage_panel1_sd_cd3 = $this->input->post('percentage_panel1_sd_cd3');
            $percentage_panel1_sd_cd4 = $this->input->post('percentage_panel1_sd_cd4');
            $percentage_panel2_sd_cd3 = $this->input->post('percentage_panel2_sd_cd3');
            $percentage_panel2_sd_cd4 = $this->input->post('percentage_panel2_sd_cd4');
            $percentage_panel3_sd_cd3 = $this->input->post('percentage_panel3_sd_cd3');
            $percentage_panel3_sd_cd4 = $this->input->post('percentage_panel3_sd_cd4');

            $percentage_panel1_sdi_cd3 = $this->input->post('percentage_panel1_sdi_cd3');
            $percentage_panel1_sdi_cd4 = $this->input->post('percentage_panel1_sdi_cd4');
            $percentage_panel2_sdi_cd3 = $this->input->post('percentage_panel2_sdi_cd3');
            $percentage_panel2_sdi_cd4 = $this->input->post('percentage_panel2_sdi_cd4');
            $percentage_panel3_sdi_cd3 = $this->input->post('percentage_panel3_sdi_cd3');
            $percentage_panel3_sdi_cd4 = $this->input->post('percentage_panel3_sdi_cd4');

            $percentage_panel1_per_cd3 = $this->input->post('percentage_panel1_per_cd3');
            $percentage_panel1_per_cd4 = $this->input->post('percentage_panel1_per_cd4');
            $percentage_panel2_per_cd3 = $this->input->post('percentage_panel2_per_cd3');
            $percentage_panel2_per_cd4 = $this->input->post('percentage_panel2_per_cd4');
            $percentage_panel3_per_cd3 = $this->input->post('percentage_panel3_per_cd3');
            $percentage_panel3_per_cd4 = $this->input->post('percentage_panel3_per_cd4');

            // Percentage


            //$this->db->insert('participant_readiness', $insertrounddata);
        }
    }
    

}

/* End of file PTRound.php */
/* Location: ./application/modules/Participant/controllers/Participant/PTRound.php */