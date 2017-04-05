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
        $equipment_tabs = $this->createTabs($round_uuid,$equipments);
        // echo "<pre>";print_r($equipment_tabs);echo "</pre>";die();
        $data = [
                'pt_uuid'    =>  $round_uuid,
                'participant'    =>  $participant_id,
                'equipment_tabs'    =>  $equipment_tabs,
                'data_submission' => 'data_submission',
                'participant_report' => 'participant_report'

            ];
                
        $this->assets
            ->addJs('dashboard/js/libs/jquery.validate.js')
            ->addJs("plugin/sweetalert/sweetalert.min.js");
        // $this->assets->setJavascript('Participant/participant_login_js');
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


    public function equipmentInfoSubmission(){
        if($this->input->post()){
        //echo "<pre>";print_r("PT UUID".$pt_round_no);echo "</pre>";die();

            $user = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));

            //foreach ($variable as $key => $value) {
                $round = $this->input->post('ptround');
                $participant = $user->uuid;

                $lysis = $this->input->post('lysis_equipment_1');
                $acb = $this->input->post('acb_equipment_1');
                $kit = $this->input->post('kit_equipment_1');
                $flouro = $this->input->post('flourochromes_equipment_1');
                $abs = $this->input->post('absolute_equipment_1');
                $percent = $this->input->post('percent_equipment_1');
            //}

            


            //$this->db->insert('participant_readiness', $insertrounddata);
        }
    }

    public function dataSubSubmission(){
        if($this->input->post()){
        //echo "<pre>";print_r("PT UUID".$pt_round_no);echo "</pre>";die();
            $user = $this->M_Readiness->findUserByIdentifier('uuid', $this->session->userdata('uuid'));
            
            $round = $this->input->post('ptround');
            $participant = $user->uuid;

            $sample = $this->input->post('sample_code');
            $received = $this->input->post('date_received');
            $analyzed = $this->input->post('date_analyzed');

            //foreach ($variable as $key => $value) {
                $reagent = $this->input->post('equipment1_reagent');
                $lot = $this->input->post('equipment1_lot');
                $expiry = $this->input->post('equipment1_expiry');

            //}

            $fl1 = $this->input->post('fl1');
            $fl2 = $this->input->post('fl2');
            $fl3 = $this->input->post('fl3');
            $fl4 = $this->input->post('fl4');

            $lysing = $this->input->post('lysing');
            $absolute = $this->input->post('absolute');

            //foreach ($variable as $key => $value) {
                $cd3_abs = $this->input->post('cd3_abs_1');
                $cd3_per = $this->input->post('cd3_per_1');
                $cd4_abs = $this->input->post('cd4_abs_1');
                $cd4_per = $this->input->post('cd4_per_1');
                $other_abs = $this->input->post('other_abs_1');
                $other_per = $this->input->post('other_per_1');
            //}

            $qaname = $this->input->post('qaname');



            //$this->db->insert('participant_readiness', $insertrounddata);
        }
    }

    public function createTabs($round_uuid, $equipments){
        // echo "<pre>";print_r($equipments);echo "</pre>";die();
        $equipment_tabs = '';

        $equipment_tabs .= "<ul class='nav nav-tabs' role='tablist'>";

        foreach ($equipments as $key => $equipment) {
            $equipment_tabs .= "<li class='nav-item'>
                    <a class='nav-link' data-toggle='tab' href='".$equipment->equipment_name."' role='tab' aria-controls='home'><i class='icon-calculator'></i>";
            $equipment_tabs .= $equipment->equipment_name;
            $equipment_tabs .= "&nbsp;
                        <span class='tag tag-success'>Complete</span>
                    </a>
                </li>";
        }

        $equipment_tabs .= "</ul>
                            <div class='tab-content'>";

$counter = 0;
        foreach ($equipments as $key => $value) {
            $equipment_tabs .= "<div class='tab-pane active' id='". $equipment->equipment_name ."' role='tabpanel'>
                    <div class='row'>

    <div class='col-sm-12'>
        <div class='card'>
            <div class='card-header'>
                <strong>RESULTS</strong>
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
                        </tr>
                        <tr>
                            <th style='text-align: center;'>
                                SS-R17-036
                            </th>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd3_abs_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd3_per_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd4_abs_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd4_per_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'other_abs_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'other_per_'".$counter.">
                            </td>
                        </tr>
                        <tr>
                            <th style='text-align: center;'>
                                SS-R17-037
                            </th>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd3_abs_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd3_per_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd4_abs_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd4_per_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'other_abs_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'other_per_'".$counter.">
                            </td>
                        </tr>
                        <tr>
                            <th style='text-align: center;'>
                                SS-R17-038
                            </th>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd3_abs_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd3_per_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd4_abs_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'cd4_per_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'other_abs_'".$counter.">
                            </td>
                            <td>
                                <input type='text' class='page-signup-form-control form-control' placeholder='' name = 'other_per_'".$counter.">
                            </td>
                        </tr>
                    </table>
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