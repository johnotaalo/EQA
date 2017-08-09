<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analysis extends DashboardController {
	public function __construct(){
		parent::__construct();

		$this->load->library('table');
        $this->load->config('table');
		$this->load->model('Analysis_m');

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

        $where_array = [
                            'uuid'   => $round_uuid
                        ];


        $pt_id = $this->db->get_where('pt_round', $where_array)->row()->id;
		$equipments = $this->db->get_where('equipment', ['equipment_status'=>1])->result();
		//echo "<pre>";print_r($equipments);echo "</pre>";die();

		
			$data = [
				'equipment_tabs' => $this->createTabs($pt_id)
			];
            

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                        ->addJs('dashboard/js/libs/moment.min.js');
        $this->assets->setJavascript('Analysis/analysis_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('Analysis/nhrl_peer_results_v', $data)
                ->adminTemplate();
	}


	public function createNHRLTable($round_id, $equipment_id){
		$template = $this->config->item('default');

		$where = ['pt_round_id' =>  $round_id];
        $samples = $this->db->get_where('pt_samples', $where)->result();
        $testers = $this->db->get_where('pt_testers', $where)->result();
        $labs = $this->db->get_where('pt_labs', $where)->result();
        $equipments = $this->db->get_where('equipment', ['equipment_status'=>1])->result();

		$where_array = [
                            'pt_round_id'   => $round_id,
                            'equipment_id'  => $equipment_id
                        ];

		$nhrl_results = $this->db->get_where('pt_testers_result', $where_array)->result();

        $heading = [
            "Sample ID",
            "Mean",
            "SD",
            "2SD",
            "Upper Limit",
            "Lower Limit"
        ];
        $tabledata = [];

// echo "<pre>";print_r($nhrl_results);echo "</pre>";die();
        foreach($samples as $sample){
                    $table_body = [];
                    $table_body[] = $sample->sample_name;
                    

                    $calculated_values = $this->db->get_where('pt_testers_calculated_v', ['pt_round_id' =>  $round_id, 'equipment_id'   =>  $equipment_id, 'pt_sample_id'  =>  $sample->id])->row(); 

                    $tabledata[] = [
	                    $sample->sample_name,
	                    ($calculated_values) ? $calculated_values->mean : 0,
	                    ($calculated_values) ? $calculated_values->sd : 0,
	                    ($calculated_values) ? $calculated_values->doublesd : 0,
	                    ($calculated_values) ? $calculated_values->upper_limit : 0,
	                    ($calculated_values) ? $calculated_values->lower_limit : 0
                	];

                }

                $this->table->set_template($template);
                $this->table->set_heading($heading);

        return $this->table->generate($tabledata);
	}

	public function createPeerTable($round_uuid){
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

        $this->table->set_heading($heading);
        $this->table->set_template($template);

        return $this->table->generate($tabledata);
	}

	public function createParticipantTable($round_uuid){
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

        $this->table->set_heading($heading);
        $this->table->set_template($template);

        return $this->table->generate($tabledata);
	}



	public function createTabs($round_id){
        
        $datas=[];

        $tab = 0;
        $zero = '0';
        
        $where = ['pt_round_id' =>  $round_id];
        $samples = $this->db->get_where('pt_samples', $where)->result();

        
        $equipments = $this->Analysis_m->Equipments();
        // echo "<pre>";print_r($equipments);echo "</pre>";die();
        
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

        foreach ($equipments as $key => $equipment) {
            $counter++;

            

            $equipment_id = $equipment->id;
            $equipmentname = $equipment->equipment_name;
            $equipmentname = str_replace(' ', '_', $equipmentname);

            if($counter == 1){
            	// echo "<pre>";print_r($equipmentname);echo "</pre>";die();
                $equipment_tabs .= "<div class='tab-pane active' id='". $equipmentname ."' role='tabpanel'>";
            }else{

                $equipment_tabs .= "<div class='tab-pane' id='". $equipmentname ."' role='tabpanel'>";
            }

            $equipment_tabs .= '<div class = "row">
								    <div class="col-md-12">
								        <div class = "card card-outline-info">
								            <div class="card-header col-4">
								                <i class = "icon-chart"></i>
								                &nbsp;

								                    Equipment Info

								            </div>

								            <div class = "card-block">
								            No. of Registrations : ';

            $equipment_tabs .= '';

            $equipment_tabs .= ' <br/>
                No. of Submissions : ';

            $equipment_tabs .= '';

            $equipment_tabs .= ' <br/>
                No. of Passes : ';

            $equipment_tabs .= '';

            $equipment_tabs .= ' <br/>
                No. of Failed : ';

            $equipment_tabs .= '';

            $equipment_tabs .= ' <br/>
				            </div>
				        </div>
				    </div>
				</div>';
            
            $equipment_tabs .= '<div class = "row">
				    <div class="col-md-12">
				    <div class="card ">

						<div class="col-md-6">
							<div class = "card card-outline-success">
					            <div class="card-header col-6">
					            	<i class = "icon-chart"></i>
				                &nbsp;

				                    NHRL Results
					            </div>
					            <div class = "card-block">';

            $equipment_tabs .= $this->createNHRLTable($round_id, $equipment_id);

            $equipment_tabs .= '</div>
						    </div>
					    </div>

						<div class="col-md-6">
							<div class = "card card-outline-warning">
					            <div class="card-header col-6">
					            	<i class = "icon-chart"></i>
				                &nbsp;
				                Peer Results
					            </div>
					            <div class = "card-block">';

            $equipment_tabs .= $this->createPeerTable($round_id, $equipment_id);

            $equipment_tabs .= '</div>
						    </div>
					    </div>

				    </div>
				    </div>
				</div>


				<div class = "row">
				    <div class="col-md-12">
				        <div class = "card card-outline-danger">
				            <div class="card-header col-4">
				                <i class = "icon-chart"></i>
				                &nbsp;
				                    Participant Results
				            </div>

				            <div class = "card-block col-12">';

            $equipment_tabs .= $this->createParticipantTable($round_id, $equipment_id);

            $equipment_tabs .= '</div>


				        </div>
				    </div>
				</div>
			</div>';
               
        }

        $equipment_tabs .= "</div>";
  // echo "<pre>";print_r($equipments);echo "</pre>";die();
        return $equipment_tabs;

    }

	







}

/* End of file Analysis.php */
/* Location: ./application/modules/Home/controllers/Analysis.php */
