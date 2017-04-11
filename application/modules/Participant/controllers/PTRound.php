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
        

        $participant_id = $user->uuid;
        $facility_code = $user->facility_code;

        $equipments = $this->M_PTRound->Equipments();

        //echo "<pre>";print_r($equipments);echo "</pre>";die();
        $equipment_tabs = $this->createTabs($round_uuid,$participant_id,$equipments);

        $data = [
                'pt_uuid'    =>  $round_uuid,
                'participant'    =>  $participant_id,
                'equipment_tabs'    =>  $equipment_tabs,
                'data_submission' => 'data_submission'

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


    public function dataSubmission($equipmentid,$round){
        

        if($this->input->post()){
            // echo "<pre>";print_r("Reached0");echo "</pre>";  
            $user = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));

            $round_id = $this->M_Readiness->findRoundByIdentifier('uuid', $round)->id;
            $participant_uuid = $user->uuid;
            $participant_id = $user->p_id;

            $samples = $this->M_PTRound->getSamples($round,$participant_uuid);
            // echo json_encode($samples);
             
            $counter2 = 0;
            $submission = $this->M_PTRound->getDataSubmission($round_id,$participant_id,$equipmentid);
            // echo "<pre>";print_r($submission);echo "</pre>";die();
            if(!($submission)){

                $insertsampledata = [
                        'round_id'    =>  $round_id,
                        'participant_id'    =>  $participant_id,
                        'equipment_id'    =>  $equipmentid,
                        'status'    =>  0
                    ];

                if($this->db->insert('pt_data_submission', $insertsampledata)){
                    $submission_id = $this->db->insert_id();

                        foreach ($samples as $key => $sample) {

                            $cd3_abs = $this->input->post('cd3_abs_'.$counter2);
                            $cd3_per = $this->input->post('cd3_per_'.$counter2);
                            $cd4_abs = $this->input->post('cd4_abs_'.$counter2);
                            $cd4_per = $this->input->post('cd4_per_'.$counter2);
                            $other_abs = $this->input->post('other_abs_'.$counter2);
                            $other_per = $this->input->post('other_per_'.$counter2);

                            //echo "<pre>";print_r($cd3_abs);echo "</pre>";

                            $insertequipmentdata = [
                            'sample_id'    =>  $submission_id,
                            'cd3_absolute'    =>  $cd3_abs,
                            'cd3_percent'    =>  $cd3_per,
                            'cd4_absolute'    =>  $cd4_abs,
                            'cd4_percent'    =>  $cd4_per,
                            'other_absolute'    =>  $other_abs,
                            'other_percent'    =>  $other_per
                            ];

                            try {
                                if($this->db->insert('pt_equipment_results', $insertequipmentdata)){
                                    $this->session->set_flashdata('success', "Successfully saved new data");
                                }else{
                                    $this->session->set_flashdata('error', "There was a problem saving the new data. Please try again");
                                }
                                
                            } catch (Exception $e) {
                                echo $e->getMessage();
                            }

                            $counter2 ++;
                        }

                }else{
                    echo json_encode('Problem submitting into Round Data');
                }

            }else{

                $submission_id = $submission->id;

                    $this->db->where('sample_id', $submission_id);
                    $this->db->delete('pt_equipment_results');
                
                foreach ($samples as $key => $sample) {     

                    $cd3_abs = $this->input->post('cd3_abs_'.$counter2);
                    $cd3_per = $this->input->post('cd3_per_'.$counter2);
                    $cd4_abs = $this->input->post('cd4_abs_'.$counter2);
                    $cd4_per = $this->input->post('cd4_per_'.$counter2);
                    $other_abs = $this->input->post('other_abs_'.$counter2);
                    $other_per = $this->input->post('other_per_'.$counter2);

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

                    //echo "<pre>";print_r($cd3_abs);echo "</pre>";die();

                    // $this->db->set('cd3_absolute', $cd3_abs);
                    // $this->db->set('cd3_percent', $cd3_per);
                    // $this->db->set('cd4_absolute', $cd4_abs);
                    // $this->db->set('cd4_percent', $cd4_per);
                    // $this->db->set('other_absolute', $other_abs);
                    // $this->db->set('other_percent', $other_per);

                    // $this->db->where('sample_id', $submission_id);

                    
                    $counter2 ++;
                }
            }

            if($this->db->update('pt_equipment_results')){
                $this->session->set_flashdata('success', "Successfully saved");
            }else{
                $this->session->set_flashdata('error', "There was a problem saving the data. Please try again");
            }
            redirect('Participant/PTRound/');
        }else{
          echo json_encode('noposting');  
        }

        
    }

    public function createTabs($round_uuid, $participant_uuid, $equipments){
        
        $datas=[];
        $tab = 0;
        $zero = '0';
        $samples = $this->M_PTRound->getSamples($round_uuid,$participant_uuid);
        //echo "<pre>";print_r($participant_id);echo "</pre>";die();
        $user = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));
        $participant_id = $user->p_id;

        

        // echo "<pre>";print_r($datas[0]->cd3_absolute);echo "</pre>";die();
        
        $equipment_tabs = '';

        $equipment_tabs .= "<ul class='nav nav-tabs' role='tablist'>";

        foreach ($equipments as $key => $equipment) {
            $tab++;
            $equipment_tabs .= "
                ";

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
        $counter3 = 0;

        foreach ($equipments as $key => $equipment) {
            $counter++;
            

            $equipmentname = $equipment->equipment_name;
            $equipmentname = str_replace(' ', '_', $equipmentname);

            if($counter == 1){
                $equipment_tabs .= "<div class='tab-pane active' id='". $equipmentname ."' role='tabpanel'>";
            }else{
                $equipment_tabs .= "<div class='tab-pane' id='". $equipmentname ."' role='tabpanel'>";
            }
            
            $this->db->where('round_uuid',$round_uuid);
            $this->db->where('participant_id',$participant_id);
            $this->db->where('equipment_id',$equipment->id);

            $datas = $this->db->get('data_entry_v')->result();


            $equipment_tabs .= "<div class='row'>
        <div class='col-sm-12'>
        <div class='card'>
            <div class='card-header'>
                <strong>RESULTS FOR ". $equipment->equipment_name ."</strong>
            </div>
            <div class='card-block'>
            <form method='POST' class='p-a-4' id='".$equipment->id."'>
                <input type='hidden' class='page-signup-form-control form-control ptround' value='".$round_uuid."'>



                <div class='row'>
                    <table class='table table-bordered'>
                        <tr>
                            <th style='text-align: center; width:20%;' rowspan='3'>
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

                    $counter2 = 0;
                    foreach ($samples as $key => $sample) {
                        
                    //echo "<pre>";print_r($datas);echo "</pre>";die();

                        $value = 0;
                        $equipment_tabs .= "<tr>
                                            <th style='text-align: center;'>";
                        $equipment_tabs .= $sample->sample_name;

                        $equipment_tabs .= "</th>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' value = '";
                                
                        //echo "<pre>";print_r($datas[$counter2]->equipment_id);echo "</pre>";die();
                            if($datas){
                                if($equipment->id == $datas[$counter2]->equipment_id){
                                    $value = $datas[$counter2]->cd3_absolute;
                                }else{
                                    $value = 0;
                                }
                            }else{
                                $value = 0;
                            }

                        $equipment_tabs .= $value ."' name = 'cd3_abs_$counter2'>
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' value = '";

                        if($datas){
                                if($equipment->id == $datas[$counter2]->equipment_id){
                                    $value = $datas[$counter2]->cd3_percent;
                                }else{
                                    $value = 0;
                                }
                        }else{
                            $value = 0;
                        }

                        $equipment_tabs .= $value."' name = 'cd3_per_$counter2'>
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' value = '";

                        if($datas){
                                if($equipment->id == $datas[$counter2]->equipment_id){
                                    $value = $datas[$counter2]->cd4_absolute;
                                }else{
                                    $value = 0;
                                }
                        }else{
                            $value = 0;
                        }

                        $equipment_tabs .= $value."'  name = 'cd4_abs_$counter2'>
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' value = '";

                        if($datas){
                                if($equipment->id == $datas[$counter2]->equipment_id){
                                    $value = $datas[$counter2]->cd4_percent;
                                }else{
                                    $value = 0;
                                }
                        }else{
                            $value = 0;
                        }

                        $equipment_tabs .= $value."' name = 'cd4_per_$counter2'>
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' value = '";

                        if($datas){
                                if($equipment->id == $datas[$counter2]->equipment_id){
                                    $value = $datas[$counter2]->other_absolute;
                                }else{
                                    $value = 0;
                                }
                        }else{
                            $value = 0;
                        }

                        $equipment_tabs .= $value."' name = 'other_abs_$counter2'>
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' value = '";

                        if($datas){
                                if($equipment->id == $datas[$counter2]->equipment_id){
                                    $value = $datas[$counter2]->other_percent;
                                }else{
                                    $value = 0;
                                }
                        }else{
                            $value = 0;
                        }

                        $equipment_tabs .= $value."' name = 'other_per_$counter2'>
                            </td>
                        </tr>";
                        $counter2++;
                    }

                    $equipment_tabs .= "</table>
                                        </div>


                                        <button type='submit' class='btn btn-block btn-lg btn-primary m-t-3 submit'>
                                            Save
                                        </button>

                                        </form>

                                        </div>   
                                        </div>
                                        </div>
                                        </div>
                                        </div>";

                    $equipment_tabs .= "";
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