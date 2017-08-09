<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analysis extends DashboardController {
	public function __construct(){
		parent::__construct();

		$this->load->library('table');
        $this->load->config('table');
		// $this->load->model('dashboard_m');
		// $this->load->module('Participant');

	}
	
	public function index()
	{	
		$data = [];
        $title = "Analysis";
        // $pt_count = $this->db->count_all('pt_rounds');

            $data = [
                'table_view'    =>  $this->createPTTable()
            ];

        

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        $this->assets->setJavascript('Analysis/analysis_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('Analysis/analysis_v', $data)
                ->adminTemplate();
	}


	public function createPTTable()
	{
		$template = $this->config->item('default');

        $heading = [
            "No.",
            "PT Round No.",
            "From",
            "To",
            "Tag",
            "Lab Unit",
            "Status",
            "Actions"
        ];
        $tabledata = [];

        
        $rounds = $this->db->get('pt_round_v')->result();
        // echo "<pre>";print_r($rounds);echo "</pre>";die();

        if($rounds){
            $counter = 0;
            foreach($rounds as $round){
                $counter ++;
                $round_uuid = $round->uuid;

                if($round->type == "ongoing"){
                    $status = "<label class = 'tag tag-warning tag-sm'>Ongoing</label>"; 
                }else{
                    $status = "<label class = 'tag tag-success tag-sm'>Done</label>";
                }
                
                $tabledata[] = [
                    $counter,
                    $round->pt_round_no,
                    $round->from,
                    $round->to,
                    $round->tag,
                    $round->lab_unit,
                    $status,
                    '<a href = ' . base_url("Analysis/Results/$round_uuid") . ' class = "btn btn-primary btn-sm"><i class = "icon-eye"></i>&nbsp;View </a>
                    '
                ];
            }
        }
        $this->table->set_heading($heading);
        $this->table->set_template($template);

        return $this->table->generate($tabledata);
	}


	public function Results($round_uuid){
		$data = [];
        $title = "Analysis";
        // $pt_count = $this->db->count_all('pt_rounds');

            $data = [
                'nhrl_table'    		=>  $this->createNHRLTable(),
                'peer_table'    		=>  $this->createPeerTable(),
                'participant_results'   =>  $this->createParticipantTable()
            ];

        

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        $this->assets->setJavascript('Analysis/analysis_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('Analysis/nhrl_peer_results_v', $data)
                ->adminTemplate();
	}


	public function createNHRLTable(){
		$template = $this->config->item('default');

        $heading = [
            "Sample ID",
            "Mean",
            "SD",
            "2SD",
            "Upper Limit",
            "Lower Limit",
            "Actions"
        ];
        $tabledata = [];

        
        // $rounds = $this->db->get('pt_round_v')->result();
        // // echo "<pre>";print_r($rounds);echo "</pre>";die();

        // if($rounds){
        //     $counter = 0;
        //     foreach($rounds as $round){
        //         $counter ++;
        //         $round_uuid = $round->uuid;

        //         if($round->type == "ongoing"){
        //             $status = "<label class = 'tag tag-warning tag-sm'>Ongoing</label>"; 
        //         }else{
        //             $status = "<label class = 'tag tag-success tag-sm'>Done</label>";
        //         }
                
        //         $tabledata[] = [
        //             $counter,
        //             $round->pt_round_no,
        //             $round->from,
        //             $round->to,
        //             $round->tag,
        //             $round->lab_unit,
        //             $status,
        //             '<a href = ' . base_url("Analysis/Results/$round_uuid") . ' class = "btn btn-primary btn-sm"><i class = "icon-eye"></i>&nbsp;View </a>
        //             '
        //         ];
        //     }
        // }
        $this->table->set_heading($heading);
        $this->table->set_template($template);

        return $this->table->generate($tabledata);
	}

	public function createPeerTable(){
		$template = $this->config->item('default');

        $heading = [
            "Sample ID",
            "Mean",
            "SD",
            "2SD",
            "Upper Limit",
            "Lower Limit",
            "Actions"
        ];
        $tabledata = [];

        
        // $rounds = $this->db->get('pt_round_v')->result();
        // // echo "<pre>";print_r($rounds);echo "</pre>";die();

        // if($rounds){
        //     $counter = 0;
        //     foreach($rounds as $round){
        //         $counter ++;
        //         $round_uuid = $round->uuid;

        //         if($round->type == "ongoing"){
        //             $status = "<label class = 'tag tag-warning tag-sm'>Ongoing</label>"; 
        //         }else{
        //             $status = "<label class = 'tag tag-success tag-sm'>Done</label>";
        //         }
                
        //         $tabledata[] = [
        //             $counter,
        //             $round->pt_round_no,
        //             $round->from,
        //             $round->to,
        //             $round->tag,
        //             $round->lab_unit,
        //             $status,
        //             '<a href = ' . base_url("Analysis/Results/$round_uuid") . ' class = "btn btn-primary btn-sm"><i class = "icon-eye"></i>&nbsp;View </a>
        //             '
        //         ];
        //     }
        // }
        $this->table->set_heading($heading);
        $this->table->set_template($template);

        return $this->table->generate($tabledata);
	}

	public function createParticipantTable(){
		$template = $this->config->item('default');

        $heading = [
            "No.",
            "Participant ID",
            "Review Slot",
            "Sample 1",
            "Comment 1",
            "Sample 2",
            "Comment 2",
            "Sample 3",
            "Comment 3",
            "Overall Grade",
            "Review Comment"
        ];
        $tabledata = [];

        
        // $rounds = $this->db->get('pt_round_v')->result();
        // // echo "<pre>";print_r($rounds);echo "</pre>";die();

        // if($rounds){
        //     $counter = 0;
        //     foreach($rounds as $round){
        //         $counter ++;
        //         $round_uuid = $round->uuid;

        //         if($round->type == "ongoing"){
        //             $status = "<label class = 'tag tag-warning tag-sm'>Ongoing</label>"; 
        //         }else{
        //             $status = "<label class = 'tag tag-success tag-sm'>Done</label>";
        //         }
                
        //         $tabledata[] = [
        //             $counter,
        //             $round->pt_round_no,
        //             $round->from,
        //             $round->to,
        //             $round->tag,
        //             $round->lab_unit,
        //             $status,
        //             '<a href = ' . base_url("Analysis/Results/$round_uuid") . ' class = "btn btn-primary btn-sm"><i class = "icon-eye"></i>&nbsp;View </a>
        //             '
        //         ];
        //     }
        // }
        $this->table->set_heading($heading);
        $this->table->set_template($template);

        return $this->table->generate($tabledata);
	}

	







}

/* End of file Analysis.php */
/* Location: ./application/modules/Home/controllers/Analysis.php */
