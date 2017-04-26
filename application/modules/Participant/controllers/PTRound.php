<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PTRound extends MY_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Participant/M_PTRound');
        $this->load->model('Participant/M_Readiness');
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

                $this->db->where('status','active');
                $get = $this->db->get('pt_round_v')->row();

                // echo "<pre>";print_r($get);echo "</pre>";die();

                if($get == null){
                    $locking = 0;
                }else{
                    $ongoing_pt = $this->db->get_where('pt_round_v', ['type'=>'ongoing','status' => 'active'])->row()->uuid;
            
                    if($ongoing_pt){
                        $checklocking = $this->M_PTRound->allowPTRound($ongoing_pt, $this->session->userdata('uuid'));

                        if($checklocking == null){
                            $view = "";
                        }else{
                            if($checklocking->acceptance){

                                $view = "<a class = 'btn btn-success btn-sm' href = '".base_url('Participant/PTRound/Round/' . $round->uuid)."'><i class = 'fa fa-eye'></i>&nbsp;View</a>";

                            }else{

                                $view = "<a class = 'btn btn-success btn-sm' href = '".base_url('Participant/PanelTracking/confirm/' . $checklocking->uuid)."'><i class = 'fa fa-eye'></i>&nbsp;Confirm Receipt</a>";

                            }
                        }
                    }else{
                        $view = "";
                    }
                }

                


                $panel_tracking = "<a class = 'btn btn-danger btn-sm' href = '".base_url('Participant/PTRound/Report/' . $round->uuid)."'><i class = 'fa fa-line-chart'></i>&nbsp;Report</a>";
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

    public function Round($round_uuid){
        $user = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));
        

        $participant_id = $user->uuid;

        

        //echo "<pre>";print_r($equipments);echo "</pre>";die();
        $equipment_tabs = $this->createTabs($round_uuid,$participant_id);
        $pt_round_to = $this->M_Readiness->findRoundByIdentifier('uuid', $round_uuid)->to;

        $data = [
                'pt_round_to' => $pt_round_to,
                'pt_uuid'    =>  $round_uuid,
                'participant'    =>  $participant_id,
                'equipment_tabs'    =>  $equipment_tabs,
                'data_submission' => 'data_submission'
            ];


              
        $this->assets
                ->addCss("plugin/sweetalert/sweetalert.css")
                ->addCss('css/signin.css');  
        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js')
                ->addJs("plugin/sweetalert/sweetalert.min.js");
        $this->assets
                ->setJavascript('Participant/data_submission_js');
        
        $this->template->setPageTitle('PT Forms')->setPartial('pt_form_v',$data)->adminTemplate();
    }

    public function Report($round_uuid){
        $user = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));
        $round = $this->M_Readiness->findRoundByIdentifier('uuid',$round_uuid);
        // echo "<pre>";print_r($round);echo "</pre>";die();
        $data = [
                'pt_uuid'    =>  $round_uuid,
                'user'    =>  $user,
                'round'    =>  $round
            ];
        $this->assets
            ->addJs('dashboard/js/libs/jquery.validate.js')
            ->addJs("plugin/sweetalert/sweetalert.min.js");
        $this->assets->setJavascript('Participant/participant_login_js');
        $this->assets
                ->addCss("plugin/sweetalert/sweetalert.css")
                ->addCss('css/signin.css');
        $this->template->setPageTitle('PT Forms')->setPartial('pt_report_v',$data)->adminTemplate();
    }


    // public function EquipmentComplete($equipmentId,$round){
    //     // echo "<pre>";print_r("Reached with ".$equipmentId);echo "</pre>";die();

    //     $user = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));

    //     $round_id = $this->M_Readiness->findRoundByIdentifier('uuid', $round)->id;
    //     $participant_id = $user->p_id;

    //     $this->db->set('status', 1);
    //     $this->db->where('round_id', $round_id);
    //     $this->db->where('participant_id', $participant_id);
    //     $this->db->where('equipment_id', $equipmentId);

    //     if($this->db->update('pt_data_submission')){
    //         $data = [
    //              'response' =>  1,
    //              'message' => "Successfully marked equipment as complete"
    //         ];
    //     }else{
    //         $data = [
    //              'response' =>  0,
    //              'message' => "Marking as complete failed, please try again..."
    //         ];
    //     }

    //     return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    // }


    public function dataSubmission($equipmentid,$round){
        if($this->input->post()){
            $user = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));

            $round_id = $this->M_Readiness->findRoundByIdentifier('uuid', $round)->id;
            $participant_uuid = $user->uuid;
            $participant_id = $user->p_id;

            $samples = $this->M_PTRound->getSamples($round,$participant_uuid);
             
            $counter2 = 0;
            $submission = $this->M_PTRound->getDataSubmission($round_id,$participant_id,$equipmentid);

            $lot_number = $this->input->post('lot_number');

            // Uploading file
            $file_upload_errors = [];
            $file_path = NULL;
            if($_FILES){
                $config['upload_path'] = './uploads/participant_data/';
                $config['allowed_types'] = 'gif|jpg|png|xlsx|xls|pdf|csv';
                $config['max_size'] = 10000000;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('data_uploaded_form')) {
                    $file_upload_errors = $this->upload->display_errors();
                }else{
                    $data =$this->upload->data();
                    $file_path = substr($config['upload_path'], 1) . $data['file_name'];
                }
            }
            if(!$file_upload_errors){
                if(!($submission)){

                    $insertsampledata = [
                            'round_id'    =>  $round_id,
                            'participant_id'    =>  $participant_id,
                            'equipment_id'    =>  $equipmentid,
                            'lot_number'    =>  $lot_number,
                            'status'    =>  0,
                            'doc_path'  =>  $file_path
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
                        // echo "submission_error";
                        $this->session->set_flashdata('error', "A problem was encountered while saving data. Please try again...");
                    }

                    echo "submission_save";
                    $this->session->set_flashdata('success', "Successfully saved new data");

                }else{

                    

                    $submission_id = $submission->id;

                    // $this->db->where('round_uuid',$round_uuid);
                    // $this->db->where('participant_id',$participant_id);
                    // $this->db->where('equipment_id',$equipment->id);

                    // $datas = $this->db->get('data_entry_v')->result();

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

                        if($this->db->insert('pt_equipment_results', $insertequipmentdata)){
                            if($lot_number != $submission->lot_number){
                                //echo "<pre>";print_r("reached");echo "</pre>";die();

                                $this->db->set('lot_number', $lot_number);
                                $this->db->where('id', $submission_id);
                                $this->db->update('pt_data_submission');
                            }
                        }

                        $counter2 ++;
                    }
                    $this->session->set_flashdata('success', "Successfully updated data");
                    echo "submission_update";
                }
            }else{
                $this->session->set_flashdata('error', implode('<br/>', $file_upload_errors));
            }
        }else{
            //echo "no_post";
          $this->session->set_flashdata('error', "No data was received");
        }
    }

    


    public function createTabs($round_uuid, $participant_uuid){
        
        $datas=[];
        $tab = 0;
        $zero = '0';
        
        $samples = $this->M_PTRound->getSamples($round_uuid,$participant_uuid);
        $round_id = $this->M_Readiness->findRoundByIdentifier('uuid', $round_uuid)->id;
        $user = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));
        $participant_id = $user->p_id;

        
        $equipments = $this->M_PTRound->Equipments($participant_uuid);
        
        
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
        $lotcounter = 0;

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


            $this->db->where('round_id',$round_id);
            $this->db->where('participant_id',$participant_id);
            $this->db->where('equipment_id',$equipment->id);
            $new_m_count = $this->db->count_all_results('pt_data_log');

            if($new_m_count){
               $qa_m_count = $new_m_count; 
            }else{
                $qa_m_count = 0;
            }

            // echo "<pre>";print_r($new_m_count);echo "</pre>";die();

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
                    <a class='nav-link nav-link'  href='".base_url('Participant/PTRound/QAMessage/'.$round_id.'/'.$participant_id.'/'.$equipment->id)."' role='button'>
                    Message(s) from QA on ". $equipment->equipment_name ."
                        <i class='icon-envelope-letter'></i>
                        <span class='tag tag-pill tag-danger'>". $new_m_count ."</span>
                    </a>
                </div>
                
                <div class='col-md-6'>
                    
            <label class='checkbox-inline' for='check-complete'>";

            if($datas){
                $getCheck = $this->M_PTRound->getDataSubmission($round_id,$participant_id,$equipment->id)->status;
            }else{
                $getCheck = 0; 
            }
            

            // echo "<pre>";print_r("<br/><br/><br/><br/><br/>Lot Number: ".$lotcounter);echo "</pre>";

            if($getCheck == 1){
                $disabled = "disabled='' ";
                $equipment_tabs .= "<p><strong><span class='text-danger'>Further entry disabled. The Supervisor has submitted your data for review by the NHRL</span></strong></p>";
                // $equipment_tabs .= "<input type='checkbox' data-type = '". $equipment->equipment_name ."' class='check-complete' checked='checked' $disabled name='check-complete' value='". $equipment->id ."'>&nbsp;&nbsp; Mark Equipment as Complete";
            }else{
                $disabled = "";
                // $equipment_tabs .= "<input type='checkbox' class='check-complete' $disabled name='check-complete' value='". $equipment->id ."'>&nbsp;&nbsp; Mark Equipment as Complete";
            }

            $equipment_tabs .= "</label>
                    </div>
                </div>


            </div>
            <div class='card-block'>
            <form method='POST' class='p-a-4' id='".$equipment->id."' entype = 'multipart/form-data'>
                <input type='hidden' class='page-signup-form-control form-control ptround' value='".$round_uuid."'>
                <div>
                ";

                $equipment_tabs .= "
                </div>


                <div class='row'>
                    <table class='table table-bordered'>

                        <tr><td style='style='text-align: center;' width:40%;' colspan='8'>

                        <label style='text-align: center; width:40%;' for='lot_number'>Lot Number: </label>";

                if($datas){
                    // echo "<pre>";print_r("<br/><br/><br/><br/><br/>".$counter.": Lot number is".$datas[$counter]->lot_number);echo "</pre>";
                    if($datas[0]->lot_number != ''){
                        $lot = "<input style='text-align: center; width:40%;' type='text' name='lot_number' id='lot_".$equipment->id."'class='page-signup-form-control form-control' $disabled placeholder='Enter the Lot Number' value='".$datas[0]->lot_number."' required>" ;
                    }else{
                        $lot = "<input style='text-align: center; width:40%;' type='text' name='lot_number' id='lot_".$equipment->id."'class='page-signup-form-control  form-control' $disabled placeholder='Enter the Lot Number' required>";
                    }
                }else{
                    $lot = "<input style='text-align: center; width:40%;' type='text' name='lot_number' class='page-signup-form-control form-control' $disabled id='lot_".$equipment->id."' placeholder='Enter the Lot Number' required>";
                }
                $equipment_tabs .= $lot;

                            
                      $equipment_tabs .= " </td></tr>

                        <tr>
                            <th style='text-align: center; width:20%;' rowspan='3'>
                                PANEL
                            </th>
                            <th style='text-align: center;' colspan='6'>
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
                        
                        
// echo "<pre>";print_r($datas[$counter2]->cd3_absolute);echo "</pre>";die();
                        $value = 0;
                        $equipment_tabs .= "
                                        <tr>
                                            <th style='text-align: center;'>";
                        $equipment_tabs .= $sample->sample_name;

                        $equipment_tabs .= "</th>
                            <td>
                                <input type='text' data-type='". $equipment->equipment_name ."' class='page-signup-form-control form-control' $disabled placeholder='' value = '";
                                
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
                                <input type='text' data-type='". $equipment->equipment_name ."' class='page-signup-form-control form-control' $disabled placeholder='' value = '";

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
                                <input type='text' data-type='". $equipment->equipment_name ."'  class='page-signup-form-control form-control' $disabled placeholder='' value = '";

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
                                <input type='text' data-type='". $equipment->equipment_name ."'  class='page-signup-form-control form-control' $disabled placeholder='' value = '";

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
                                <input type='text' data-type='". $equipment->equipment_name ."'  class='page-signup-form-control form-control' $disabled placeholder='' value = '";

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
                                <input type='text' data-type='". $equipment->equipment_name ."'  class='page-signup-form-control form-control' $disabled placeholder='' value = '";

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

                    $this->db->where('round_id', $round_id);
                    $this->db->where('participant_id', $participant_id);
                    $this->db->where('equipment_id', $equipment->id);
                    $entry = $this->db->get('pt_data_submission')->row();
                    if($entry){
                        if($entry->doc_path){
                            $uploader = "<div class = 'form-control'>
                                <h5>File uploaded</h5>
                                <a href = '".base_url($entry->doc_path)."'>Click to Download File</a>
                            </div>";
                        }else{
                            $uploader = "<div class = 'form-group'>
                                            <label class = 'control-label'>Please upload the data received from the machine</label>
                                            <input type = 'file' name = 'data_uploaded_form' required = 'true' class = 'form-control'/>
                                        </div>";
                        }
                    }else{
                        $uploader = "<div class = 'form-group'>
                                            <label class = 'control-label'>Please upload the data received from the machine</label>
                                            <input type = 'file' name = 'data_uploaded_form' required = 'true' class = 'form-control'/>
                                        </div>";
                    }


                    $equipment_tabs .= "</table>
                                        </div>

                                        {$uploader}
                                        <button $disabled type='submit' class='btn btn-block btn-lg btn-primary m-t-3 submit'>
                                            Save
                                        </button>

                                        </form>

                                        </div>   
                                        </div>
                                        </div>
                                        </div>
                                        </div>";

                    $equipment_tabs .= "";
                    $lotcounter++;
        }

        $equipment_tabs .= "</div>";

        return $equipment_tabs;

    }


    public function QAMessage($round_id,$part_id,$equip_id){
        $message_view = '';

        $messages = $this->M_PTRound->getDataLog($round_id,$part_id,$equip_id);
         // echo "<pre>";print_r($messages);echo "</pre>";die();

        $counter = 1;
        foreach ($messages as $key => $message) {
            $message_view .= "<div class='container-fluid pt-2'>
                                <div class='animated fadeIn'>
                                    <div class='row'>
                                        <div class='col-sm-12'>
                                            <div class='card'>
                                                <div class='card-header'>
                                                    <strong> Message ";
            $message_view .= $counter;

            $message_view .= "</strong>
                            </div>
                            <div class='card-block'>
                                <div class='row'>

                                    <div class='col-sm-2'>

                                        <div class='form-group'>
                                            <label for='name'>Verdict</label>
                                            <p>";

            $message_view .= $message->verdict;

            $message_view .= "</p>
                                        </div>

                                    </div>
                                    <div class='col-sm-8'>

                                        <div class='form-group'>
                                            <label for='ccnumber'>Message</label>
                                            <p>";

            $message_view .= $message->comments;

            $message_view .= "</p>
                                </div>

                                </div>
                                <div class='col-sm-2'>

                                    <div class='form-group'>
                                        <label for='ccnumber'>Date Sent</label>
                                        <p>";
            $message_view .= date('dS F, Y', strtotime($message->date_of_log));

            $message_view .= "</p></div></div></div></div></div></div></div></div></div>";

            $counter++;

        }

        $data = [];
        $title = "QA/Supervisor Message";

        $data = [
              'message_view' => $message_view 
            ];

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        // $this->assets->setJavascript('Participant/notifications_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('Participant/qa_messages', $data)
                ->adminTemplate();
    }

    
    

}

/* End of file PTRound.php */
/* Location: ./application/modules/Participant/controllers/Participant/PTRound.php */