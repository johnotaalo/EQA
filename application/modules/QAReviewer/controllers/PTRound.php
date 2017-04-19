<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PTRound extends MY_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_PPTRound');
        $this->load->model('Participant/M_Readiness');
        $this->load->model('Participant/M_PTRound');
        $this->load->library('Mailer');
        $this->load->library('table');
        $this->load->config('table');
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
                $view = "<a class = 'btn btn-success btn-sm' href = '".base_url('QAReviewer/PTRound/Round/' . $round->uuid)."'><i class = 'fa fa-eye'></i>&nbsp;View</a>";
                // $panel_tracking = "<a class = 'btn btn-danger btn-sm' href = '".base_url('Participant/PTRound/Report/' . $round->uuid)."'><i class = 'fa fa-line-chart'></i>&nbsp;Report</a>";
                $status = ($round->status == "active") ? '<span class = "tag tag-success">Active</span>' : '<span class = "tag tag-danger">Inactive</span>';
                if ($round->type == "ongoing") {
                    $ongoing .= "<tr>
                    <td>{$round->pt_round_no}</td>
                    <td>{$created}</td>
                    <td>{$status}</td>
                    <td>{$view}</td>
                    </tr>";
                }else{
                    $prevfut .= "<tr>
                    <td>{$round->pt_round_no}</td>
                    <td>{$created}</td>
                    <td>{$status}</td>
                    <td>{$view}</td>
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


    function Round($round_uuid){
        $user = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));
        $facility_id = $user->facility_id;

        $data = [];
        $title = "Ready Participants";

        $data = [
            'table_view'    =>  $this->createFacilityParticipantsTable($round_uuid,$facility_id)
        ];

       
        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js");
        // $this->assets->setJavascript('QAReviewer/participants_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('QAReviewer/facility_participants_v', $data)
                ->adminTemplate();

    }



    function createFacilityParticipantsTable($round_uuid,$facility_id){

        $template = $this->config->item('default');

        $change_state = '';

        $facility_participants = $this->M_PPTRound->getFacilityParticipants($round_uuid,$facility_id);
        //echo '<pre>';print_r($facility_participants);echo "</pre>";die();

        $heading = [
            "No.",
            "Participant ID",
            "Participant",
            "Phone Number",
            "Actions"
        ];
        $tabledata = [];


        if($facility_participants){
            $counter = 0;
            foreach($facility_participants as $participant){
                $counter ++;
                $participantid = $participant->participant_id;
                $pid = $participant->p_id;
                $round_id = $this->M_Readiness->findRoundByIdentifier('uuid', $round_uuid)->id;

                $change_state = ' <a href = ' . base_url("QAReviewer/PTRound/ParticipantDetails/$round_uuid/$participantid") . ' class = "btn btn-primary btn-sm"><i class = "icon-note"></i>&nbsp;View Submissions</a>';

                $getRound = $this->M_PPTRound->getDataSubmission($round_id,$pid);

                $smart_stat = 0;
                foreach ($getRound as $stat) {
                    $smart_stat += $stat->status;
                }

                // echo "<pre>";print_r($smart_stat);echo "</pre>";die();

            if($smart_stat == 3){
                $change_state .= ' <a href = ' . base_url("QAReviewer/PTRound/MarkSubmissions/$round_uuid/$round_id/$pid") . ' class = "btn btn-warning btn-sm"><i class = "icon-note"></i>&nbsp;Send to NHRL</a>';
            }

                
                $tabledata[] = [
                    $counter,
                    $participantid,
                    $participant->participant_lname.' '.$participant->participant_fname,
                    $participant->participant_phonenumber,
                    $change_state
                ];
            }
        }
        $this->table->set_heading($heading);
        $this->table->set_template($template);

        return $this->table->generate($tabledata);
    }


    function MarkSubmissions($round_uuid,$round_id, $pid){

        $this->db->set('smart_status', 1);
        
        $this->db->where('round_id', $round_id);
        $this->db->where('participant_id', $pid);
        //$this->db->update('equipment');

        if($this->db->update('pt_data_submission')){
            $this->session->set_flashdata('success', "Successfully sent PT submission to the NHRL");
        }else{
            $this->session->set_flashdata('error', "There was a problem sending the details. Please try again");
        }

        redirect('QAReviewer/PTRound/Round/'.$round_uuid, 'refresh');

    }



    function ParticipantDetails($round_uuid,$participant_id){
        $data = [];
        $title = "Ready Participants";

        

        $user = $this->M_Readiness->findUserByIdentifier('username', $participant_id);
        $participant_uuid = $user->uuid;

        $equipment_tabs = $this->createTabs($round_uuid,$participant_uuid);

        $data = [
                'pt_uuid'    =>  $round_uuid,
                'participant'    =>  $participant_id,
                'equipment_tabs'    =>  $equipment_tabs,

            ];

         $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js");
        // $this->assets->setJavascript('QAReviewer/participants_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('QAReviewer/participant_submissions_v', $data)
                ->adminTemplate();
    }


    public function createTabs($round_uuid, $participant_uuid){

        $equipments = $this->M_PTRound->Equipments();
        
        $datas=[];
        $tab = 0;
        $zero = '0';
        
        $samples = $this->M_PTRound->getSamples($round_uuid,$participant_uuid);
        $round_id = $this->M_Readiness->findRoundByIdentifier('uuid', $round_uuid)->id;
        $user = $this->M_Readiness->findUserByIdentifier('uuid', $participant_uuid);
        $participant_id = $user->p_id;

        

        // echo "<pre>";print_r($datas[0]->cd3_absolute);echo "</pre>";die();
        
        $equipment_tabs = '';

        $equipment_tabs .= "<ul class='nav nav-tabs' role='tablist'>";

        foreach ($equipments as $key => $equipment) {
            $tab++;
            $equipment_tabs .= "";

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
    // echo "<pre>";print_r($participant_id);echo "</pre>";die();        
            $this->db->where('round_uuid',$round_uuid);
            $this->db->where('participant_id',$participant_id);
            $this->db->where('equipment_id',$equipment->id);

            $datas = $this->db->get('data_entry_v')->result();

            $equipment_tabs .= "<div class='row'>
        <div class='col-sm-12'>
        <div class='card'>
            <div class='card-header'>
                

            <div class='form-group row'>
                <div class='col-md-6'>

                <label class='checkbox-inline'>
                <strong>RESULTS FOR ". $equipment->equipment_name ."</strong>
                </label>

                </div>
                <div class='col-md-6'>
                    
            <label class='checkbox-inline' for='check-complete'>";

            if($datas){
                $getCheck = $this->M_PTRound->getDataSubmission($round_id,$participant_id,$equipment->id)->status;
            }else{
                $getCheck = 0; 
            }
            //echo "<pre>";print_r($getCheck);echo "</pre>";die();

            $equipment_tabs .= "</label>
                    </div>
                </div>


            </div>
            <div class='card-block'>
            
                <div class='row'>
                    <table  style='text-align: center;' class='table table-bordered'>
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
                        
                    // echo "<pre>";print_r($datas);echo "</pre>";die();

                        $value = 0;
                        $equipment_tabs .= "<tr> <th style='text-align: center;'>";
                        $equipment_tabs .= $sample->sample_name;

                        $equipment_tabs .= "</th> <td>";
                                
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

                        $equipment_tabs .= $value ." </td> <td>";

                        if($datas){
                                if($equipment->id == $datas[$counter2]->equipment_id){
                                    $value = $datas[$counter2]->cd3_percent;
                                }else{
                                    $value = 0;
                                }
                        }else{
                            $value = 0;
                        }

                        $equipment_tabs .= $value." </td> <td>";

                        if($datas){
                                if($equipment->id == $datas[$counter2]->equipment_id){
                                    $value = $datas[$counter2]->cd4_absolute;
                                }else{
                                    $value = 0;
                                }
                        }else{
                            $value = 0;
                        }

                        $equipment_tabs .= $value."</td> <td>";

                        if($datas){
                                if($equipment->id == $datas[$counter2]->equipment_id){
                                    $value = $datas[$counter2]->cd4_percent;
                                }else{
                                    $value = 0;
                                }
                        }else{
                            $value = 0;
                        }

                        $equipment_tabs .= $value."</td> <td>";

                        if($datas){
                                if($equipment->id == $datas[$counter2]->equipment_id){
                                    $value = $datas[$counter2]->other_absolute;
                                }else{
                                    $value = 0;
                                }
                        }else{
                            $value = 0;
                        }

                        $equipment_tabs .= $value."</td> <td>";

                        if($datas){
                                if($equipment->id == $datas[$counter2]->equipment_id){
                                    $value = $datas[$counter2]->other_percent;
                                }else{
                                    $value = 0;
                                }
                        }else{
                            $value = 0;
                        }

                        $equipment_tabs .= $value."</td> </tr>";
                        $counter2++;
                    }

                    $equipment_tabs .= "</table>
                                        </div>

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

}

/* End of file PTRound.php */
/* Location: ./application/modules/QAReviewer/controllers/PTRound.php */