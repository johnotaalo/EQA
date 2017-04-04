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