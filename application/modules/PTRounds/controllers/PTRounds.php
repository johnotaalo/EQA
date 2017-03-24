<?php

class PTRounds extends DashboardController{
    protected $menu, $lab_id_prefix;
    function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('table');
        $this->load->config('table');
        $this->load->model('PTRounds/M_PTRounds');
        $this->menu = [
            'information'   =>  [
                'icon'  =>  'fa fa-info-circle',
                'text'  =>  'PT Details'
            ],
            'facilities'      =>  [
                'icon'  =>  'fa fa-hospital-o',
                'text'  =>  'Facilities'
            ],
            'samples_labs'      => [
                'icon'  =>  'fa fa-flask',
                'text'  =>  'Samples & Testers'
            ],
            'variables'     =>  [
                'icon'  =>  'fa fa-table',
                'text'  =>  'Variables'
            ],
            'calendar'      =>  [
                'icon'  =>  'fa fa-calendar',
                'text'  =>  'Calendar'
            ],
            
        ];

        $this->lab_id_prefix = "CD4-PT-";
    }

    function index(){
        $data['pt_rounds'] = $this->createPTRoundTable();
        $this->template
                    ->setPageTitle('PT Rounds')
                    ->setPartial('PTRounds/list_v', $data)
                    ->adminTemplate();
    }

    function calendar($pt_round){
        $this->assets
                ->addJs('dashboard/js/libs/moment.min.js')
                ->addJs('dashboard/js/libs/fullcalendar.min.js')
                ->addJs('dashboard/js/libs/gcal.js');

        $data = [
            'pt_details'    =>  $this->db->get_where('pt_round', ['uuid' => $pt_round])->row(),
            'legend'        =>  $this->createCalendarColorLegend()
        ];
        $this->assets->setJavascript('PTRounds/calendar_js');
        $this->template
                ->setPartial('PTRounds/view_pt_calendar', $data)
                ->adminTemplate();
    }
    function create($step = NULL, $id = NULL){
        $data = $pagedata = [];
        $pt_details = new StdClass;
        if($step == NULL){
            $step = "information";
        }

        if($id != NULL){
            $pt_details = $this->db->get_where('pt_round', ['uuid'  => $id])->row();
            $pagedata['pt_details'] = $pt_details;
        }

        if(($step != NULL && $step != "information") && $id == NULL){
            $step = "information";
            $this->session->set_flashdata('error', 'Sorry. You need to create the PT Round first');
            redirect('PTRounds/create/' . $step);
        }

        $view = "";
        $js_data = [
            'step'  =>  $step
        ];

        switch ($step) {
            case 'information':
                $view = "pt_info_v";
                $pagedata['round_no'] = (!$id) ? $this->generateRoundNumber() : $pt_details->pt_round_no;
                $pagedata['lab_prefix'] = $this->lab_id_prefix;
                if($id){
                    $pagedata['lab_id'] = str_replace('-', '', substr($pt_details->blood_lab_unit_id, strpos($pt_details->blood_lab_unit_id, '-', strpos($pt_details->blood_lab_unit_id, '-')+1)));
                    $pagedata['no_labs'] = $this->db->get_where('pt_labs', ['pt_round_id' => $pt_details->id])->num_rows();
                    $pagedata['no_testers'] = $this->db->get_where('pt_testers', ['pt_round_id' => $pt_details->id])->num_rows();
                    $pagedata['samples_table'] = $this->createSamplesTable($pt_details->id);
                    $pagedata['round_duration'] = date('m/d/Y', strtotime($pt_details->from)) .' - ' . date('m/d/Y', strtotime($pt_details->to));
                }
                $this->assets
                        ->addJs('dashboard/js/libs/moment.min.js')
                        ->addJs('dashboard/js/libs/daterangepicker.js');
                break;
            case 'variables':
                $view = "pt_variables_v";
                $pagedata['accordion'] = $this->createVariablesAccordion($pt_details->id);
                break;
            case 'calendar':
                $view = "pt_calendar_v";
                $pagedata['calendar_form'] = $this->createCalendarForm($pt_details->id);
                $js_data['duration_from'] = $pt_details->from;
                $js_data['duration_to'] = $pt_details->to;

                $this->assets
                        ->addJs('dashboard/js/libs/moment.min.js')
                        ->addJs('dashboard/js/libs/daterangepicker.js');
                break;
            case 'facilities':
                $view = "pt_facilities_v";
                $pagedata['statistics'] = $this->getFacilityStatistics($id);
                $js_data = [
                    'pt_details'    =>  $pt_details
                ];
                $this->assets
                            ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                            ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js");
                break;
            default:
                break;
        }

        $data['step'] = $step;
        $data['uuid'] = $id;
        $data['page'] = $view;
        $data['pageData'] = $pagedata;
        $data['submenu'] = $this->createSubMenu($step, $id);

        $this->assets
                    ->addJs('dashboard/js/libs/jquery.validate.js')
                    ->setJavascript('PTRounds/pt_rounds_js', $js_data);
        $this->template
                    ->setPageTitle('PT Rounds')
                    ->setPartial('PTRounds/new_v', $data)
                    ->adminTemplate();
    }

    function createSubMenu($active = NULL, $id = NULL){
        $menu = $this->menu;
        if($active == NULL){
            $active = key($menu);
        }
        
        $menu_list = "";

        if($menu){
            foreach($menu as $item  =>   $details){
                $active_link = "";
                if($active == $item){
                    $active_link = "active";
                }

                $menu_list .= " <li class='nav-item {$active_link}'>
                <a class='nav-link' href=".base_url('PTRounds/create/' . $item . '/' . $id)."><i class='{$details['icon']}'></i> {$details['text']}</a>
            </li>";
            }
        }

        return $menu_list;
    }

    function add($step, $id = NULL){
        // echo "<pre>";print_r($this->input->post());die;
        $nextpage = $this->nextpage($step);
        $round_id = ($id != NULL) ? $this->db->get_where('pt_round', ['uuid' => $id])->row()->id : 0;
        if($step != NULL){
            if(($id != NULL && $step == "information") || ($step != "information" && $id != NULL) || ($step == "information" && $id == NULL)){
                switch ($step) {
                    case 'information':
                        $round_duration_frags = explode('-', preg_replace('/\s+/', '', $this->input->post('round_duration')));
                        $from_date = date('Y-m-d', strtotime($round_duration_frags[0]));
                        $to_date = date('Y-m-d', strtotime($round_duration_frags[1]));
                        if(!$id){
                            $pt_round_no = $this->generateRoundNumber();
                            $pt_data = [
                                'pt_round_no'       =>  $pt_round_no,
                                'tag'               =>  substr($pt_round_no, strpos($pt_round_no, "-") + 1),
                                'blood_lab_unit_id' =>  $this->lab_id_prefix . $this->input->post('blood_unit_lab_id'),
                                'from'              =>  $from_date,
                                'to'                =>  $to_date
                            ];

                            $this->db->insert('pt_round', $pt_data);
                            $round_id = $this->db->insert_id();

                            $this->db->select('uuid');
                            $this->db->where('id', $round_id);
                            $id = $this->db->get('pt_round')->row()->uuid;
                        }else{
                            $update_data = [
                                'blood_lab_unit_id' =>  $this->lab_id_prefix . $this->input->post('blood_unit_lab_id'),
                                'from'  =>  $from_date,
                                'to'    =>  $to_date
                            ];

                            $this->db->where('id', $round_id);
                            $this->db->update('pt_round', $update_data);
                        }
                        break;
                    case 'variables':
                        $filtered_input = array_filter($this->input->post());
                        $sorted_input = [];
                        foreach ($filtered_input as $key => $value) {
                            $key_frags = explode('_', $key);
                            if (is_array($key_frags) && count($key_frags) == 2) {
                                $section = $key_frags[0];
                                $ids_frag = explode('//', $key_frags[1]);
                                $sorted_input[$section][] = [
                                    'pt_round_uuid'     =>  $id,
                                    'equipment_uuid'    =>  $ids_frag[0],
                                    'sample_uuid'       =>  $ids_frag[1],
                                    $section . '_uuid'  =>  $ids_frag[2],
                                    'result'            =>  $value
                                ];
                            }
                        }
                        if ($sorted_input['tester']) {
                            foreach ($sorted_input['tester'] as $data_array) {
                                $equipment_id = $this->db->get_where('equipment', ['uuid' => $data_array['equipment_uuid']])->row()->id;
                                $sample_id = $this->db->get_where('pt_samples', ['uuid' =>  $data_array['sample_uuid']])->row()->id;
                                $tester_id = $this->db->get_where('pt_testers', ['uuid' =>  $data_array['tester_uuid']])->row()->id;
                                $result = $data_array['result'];

                                $sql = "CALL proc_pt_testers_result($equipment_id, $sample_id, $tester_id, $round_id, $result)";
                                $this->db->query($sql);
                            }
                        }
                        if ($sorted_input['lab']) {
                            foreach ($sorted_input['lab'] as $data_array) {
                                $equipment_id = $this->db->get_where('equipment', ['uuid' => $data_array['equipment_uuid']])->row()->id;
                                $sample_id = $this->db->get_where('pt_samples', ['uuid' =>  $data_array['sample_uuid']])->row()->id;
                                $lab_id = $this->db->get_where('pt_labs', ['uuid' =>  $data_array['lab_uuid']])->row()->id;
                                $result = $data_array['result'];

                                $sql = "CALL proc_pt_labs_results($equipment_id, $sample_id, $lab_id, $round_id, $result)";
                                $this->db->query($sql);
                            }
                        }
                        break;
                    case 'samples_labs':
                        $no_testers = $this->input->post('no_testers');
                        $no_labs = $this->input->post('no_labs');
                        if($no_testers > 0 && $no_labs > 0){
                            $testers_data = [];
                            $labs_data = [];
                            for ($i=0; $i < $no_testers; $i++) { 
                                $number = $i + 1;
                                $tester_name = 'Tester ' . $number;
                                $testers_data[] = [
                                    'tester_name'   =>  $tester_name,
                                    'pt_round_id'   =>  $round_id
                                ];
                            }

                            for ($i=0; $i < $no_labs; $i++) { 
                                $number = $i + 1;
                                $lab_name = 'Lab' . $number;
                                $labs_data[] = [
                                    'lab_name'      =>  $lab_name,
                                    'pt_round_id'   =>  $round_id
                                ];
                            }

                            $this->db->insert_batch('pt_testers', $testers_data);
                            $this->db->insert_batch('pt_labs', $labs_data);
                        }

                        $samples = $this->input->post('samples');
                        $sample_data = [];
                        foreach ($samples as $sample) {
                            $sample_data[] = [
                                'sample_name'   =>  $sample,
                                'pt_round_id'   =>  $round_id
                            ];
                        }

                        $this->db->insert_batch('pt_samples', $sample_data);
                        break;
                    case 'calendar':
                        foreach ($this->input->post() as $calendar_item_uuid => $dates) {
                           $item_id = $this->db->get_where('calendar_items', ['uuid'    =>  $calendar_item_uuid])->row()->id;
                           $dates_frags = explode('-', preg_replace('/\s+/', '', $dates));
                           $date_from = date('Y-m-d', strtotime($dates_frags[0]));
                           $date_to = date('Y-m-d', strtotime($dates_frags[1]));

                           $sql = "CALL proc_pt_calendar($item_id, $round_id, '$date_from', '$date_to')";
                           $this->db->query($sql);
                        }
                        break;
                    default:
                        $this->session->set_flashdata('error', 'Sorry. An error was encountered while proessing your request. Please try again');
                        redirect('PTRounds/create/' . $step);
                        break;
                }              
                redirect('PTRounds/create/' . $nextpage . '/' . $id,'refresh');               
            }else{
                echo $step;die;
                $step = "information";
                $this->session->set_flashdata('error', 'Sorry. An error was encountered while proessing your request. Please try again');
                redirect('PTRounds/create/' . $step);
            }
        }
    }

    function createVariablesAccordion($round_id){
        $accordion = "";
        $template = $this->config->item('default');

        $where = ['pt_round_id' =>  $round_id];
        $samples = $this->db->get_where('pt_samples', $where)->result();
        $testers = $this->db->get_where('pt_testers', $where)->result();
        $labs = $this->db->get_where('pt_labs', $where)->result();
        $equipments = $this->db->get_where('equipment', ['equipment_status'=>1])->result();

        $table_headers = $testers_arr = $labs_arr = [];

        $table_headers[] = "Sample ID";
        foreach($testers as $tester){
            $testers_arr[] = $tester->tester_name;
        }
        $testers_arr[] = "Mean";
        $testers_arr[] = "SD";
        $testers_arr[] = "2SD";
        $testers_arr[] = "Upper Limit";
        $testers_arr[] = "Lower Limit";
        $testers_arr[] = "CV";
        $testers_arr[] = "Outcome";
        foreach($labs as $lab){
            $testers_arr[] = $lab->lab_name;
            $testers_arr[] = "Field Stability";
        }
        $testers_arr[] = "Outcome";
        $table_headers = array_merge($table_headers, $testers_arr);

        foreach($equipments as $equipment){
            $table_body = [];
            $accordion .= "<div class = 'card'>";
            $accordion .= "<div class = 'card-header' role='tab' id = 'heading-{$equipment->id}'>
                <h5 class = 'mb-0'>
                    <a data-toggle = 'collapse' data-parent = '#accordion' href = '#collapse{$equipment->id}' aria-expanded = 'true' aria-controls = 'collapse{$equipment->id}'>
                        {$equipment->equipment_name}
                    </a>
                </h5>
            </div>
            <div id = 'collapse{$equipment->id}' class = 'collapse' role = 'tabpanel' aria-labelledby= 'heading-{$equipment->id}'>
                <div class = 'card-block'>";
                $table_data = [];
                foreach($samples as $sample){
                    $table_body = [];
                    $table_body[] = $sample->sample_name;
                    foreach($testers as $tester){
                        $where_array = [
                            'pt_round_id'   => $round_id,
                            'equipment_id'  =>  $equipment->id,
                            'pt_tester_id'  =>  $tester->id,
                            'pt_sample_id'  =>  $sample->id
                        ];
                        $tester_val = $this->db->get_where('pt_testers_result', $where_array)->row();
                        $testers_value = ($tester_val) ? $tester_val->result : "";
                        $table_body[] = "<input type = 'number' name = 'tester_{$equipment->uuid}//{$sample->uuid}//{$tester->uuid}' value = '{$testers_value}'/>";
                    }

                    $calculated_values = $this->db->get_where('pt_testers_calculated_v', ['pt_round_id' =>  $round_id, 'equipment_id'   =>  $equipment->id, 'pt_sample_id'  =>  $sample->id])->row(); 

                    $table_body[] = ($calculated_values) ? $calculated_values->mean : 0;
                    $table_body[] = ($calculated_values) ? $calculated_values->sd : 0;
                    $table_body[] = ($calculated_values) ? $calculated_values->doublesd : 0;
                    $table_body[] = ($calculated_values) ? $calculated_values->upper_limit : 0;
                    $table_body[] = ($calculated_values) ? $calculated_values->lower_limit : 0;
                    $table_body[] = ($calculated_values) ? $calculated_values->cv : 0;
                    $table_body[] = ($calculated_values) ? $calculated_values->outcome : 0;
                    foreach($labs as $lab){
                        $where_array = [
                            'pt_round_id'   => $round_id,
                            'equipment_id'  =>  $equipment->id,
                            'pt_lab_id'     =>  $lab->id,
                            'pt_sample_id'  =>  $sample->id
                        ];
                        $lab_val = $this->db->get_where('pt_labs_results', $where_array)->row();
                        $lab_value = ($lab_val) ? $lab_val->result : "";
                        $table_body[] = "<input type = 'number' name = 'lab_{$equipment->uuid}//{$sample->uuid}//{$lab->uuid}' value = '{$lab_value}'/>";
                        $stability_val = $this->db->get_where('pt_labs_calculated_v', $where_array)->row();
                        $stability_value = ($stability_val) ? $stability_val->stability : "N/A";
                        $table_body[] = $stability_value;
                    }
                    $table_body[] = "";

                    array_push($table_data, $table_body);
                }

                $this->table->set_template($template);
                $this->table->set_heading($table_headers);
            $accordion .= "<div class = 'table-responsive'>" . $this->table->generate($table_data) . "</div>";
            $accordion .= "</div>
            </div>";
            $accordion .= "</div>";
        }
        return $accordion;
    }

    function createCalendarForm($round_id){
        $calendar_form = "";

        $form_data = $this->M_PTRounds->findCalendarDetailsByRound($round_id);

        foreach($form_data as $calendar_data){
            $dates = "";
            if($calendar_data->date_from != "" && $calendar_data->date_to != ""){
                $dates = "{$calendar_data->date_from} - {$calendar_data->date_to}";
            }
            $calendar_form .= "<div class = 'form-group'>
                <label class = 'control-label'>{$calendar_data->calendar_item}</label>
                <input class = 'form-control daterange' type = 'text' name = '{$calendar_data->calendar_item_id}' value = '$dates'/>
            </div>";
        }

        return $calendar_form;
    }

    function createSamplesTable($round_id){
        $this->db->where('pt_round_id', $round_id);
        $query = $this->db->get('pt_samples');
        $samples = $query->result();

        $samples_table = "";
        if($samples){
            $counter = 1;
            foreach ($samples as $sample) {
               $samples_table .= "<tr>";
               $samples_table .= "<td>{$counter}</td>";
               $samples_table .= "<td>Sample <span class = 'sample-no'>{$counter}</span></td>";
               $samples_table .= "<td><input type = 'text' class = 'form-control' value = '{$sample->sample_name}' disabled/></td>";
               $samples_table .= "<td><center>N/A</center></td>";
               $samples_table .= "</tr>";

               $counter++;
            }
        }

        return $samples_table;
    }

    function createPTRoundTable(){
        $rounds = $this->db->get('pt_round_v')->result();
        $ongoing = $prevfut = '';
        $round_array = [];
        if ($rounds) {
            foreach ($rounds as $round) {
                $created = date('dS F, Y', strtotime($round->date_of_entry));
                $view = "<a class = 'btn btn-success btn-sm' href = '".base_url('PTRounds/create/information/' . $round->uuid)."'>View</a>";
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

    function nextpage($current){
        reset($this->menu);
        while(key($this->menu) !== $current){
            next($this->menu);
        }

        $next_array = next($this->menu);
        $next_key = (key($this->menu)) ? key($this->menu) : "information";
        
        return $next_key;
    }

    function generateRoundNumber(){
        $prefix = "NHRL/CD4/";
        $year = date("Y");
        $this->db->select_max("tag");
        $query = $this->db->get('pt_round');
        
        $data = $query->row();
        $number = 17;
        if($data){
            if($data->tag != ""){
                $number = $data->tag + 1;
            }
        }

        $round_number = $prefix . $year . '-' . $number;
        
        return $round_number;
    } 

    function createDateRangeArray($start, $end){
        $aryRange=array();

        $iDateFrom=mktime(1,0,0,substr($start,5,2), substr($start,8,2),substr($start,0,4));
        $iDateTo=mktime(1,0,0,substr($end,5,2), substr($end,8,2),substr($end,0,4));

        if ($iDateTo>=$iDateFrom)
        {
            array_push($aryRange,date('Y-m{d}',$iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo)
            {
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange,date('Y-m{d}',$iDateFrom));
            }
        }
        return $aryRange;
    } 

    function getCalendarData(){
        if ($this->input->is_ajax_request()) {
            $uuid = $this->input->post('round_uuid');
            $pt_round = $this->db->get_where('pt_round', ['uuid'   =>  $uuid])->row();

            $this->db->select('ci.item_name, ci.colors, pt.date_from, pt.date_to');
            $this->db->from('pt_calendar pt');
            $this->db->join('calendar_items ci', 'ci.id = pt.calendar_item_id');
            $result = $this->db->get()->result();
            $event_data = [];
            if($result){
                foreach ($result as $cal_data) {
                    $event_data[] = [
                        'title' =>  $cal_data->item_name,
                        'start' =>  $cal_data->date_from,
                        'end'   =>  date('Y-m-d', strtotime($cal_data->date_to. "+1 days")),
                        'backgroundColor' =>  $cal_data->colors,
                        'rendering' => 'background'

                    ];
                }
            }

            return $this->output->set_content_type('application/json')->set_output(json_encode($event_data));
        }
    }

    function createCalendarColorLegend(){
        $calendar_items_span = "&nbsp;";
        $calendaritems = $this->db->get('calendar_items')->result();
        if ($calendaritems) {
            foreach ($calendaritems as $item) {
                $calendar_items_span .= "
                    <a class='dropdown-item'><span class = 'circle' style = 'color: {$item->colors}'></span>&nbsp;{$item->item_name}</a>
                ";
            }
        }

        return $calendar_items_span;
    }

    function getFacilityStatistics($round_uuid){
        $query = $this->db->query("CALL get_pt_facility_statistics('$round_uuid');");
        $result = $query->row();
        $query->next_result();
        $query->free_result();
        $statistics_array = [];
        $stats_section = "";
        if($result){
            $statistics_array[] = [
                                'text'      =>  'Facilities with participants',
                                'no'        =>  $result->with_participants,
                                'percentage'=>  round($result->with_participants / $result->total_sites * 100, 3)
                            ];
            $statistics_array[] = [
                                'text'      =>  'Participants Have Responded',
                                'no'        =>  $result->responded,
                                'percentage'=>  round($result->responded / $result->total_sites * 100, 3)
                            ];
            if($result->responded == 0){
                $statistics_array[] = [
                                'text'      =>  'Ready for this round',
                                'no'        =>  0,
                                'percentage'=>  0
                            ];
                $statistics_array[] = [
                                'text'      =>  'Not Ready for this round',
                                'no'        =>  0,
                                'percentage'=>  0
                            ];
            }else{
                $statistics_array[] = [
                                'text'      =>  'Ready for this round',
                                'no'        =>  0,
                                'percentage'=>  round(0 / $result->responded * 100, 3)
                            ];
                $statistics_array[] = [
                                'text'      =>  'Not Ready for this round',
                                'no'        =>  0,
                                'percentage'=>  round(0 / $result->responded * 100, 3)
                            ];
            }
            
            
            foreach ($statistics_array as $key => $value) {
                $percentage_color = "info";
                $percentage = $value['percentage'];
                
                if ($percentage >= 0 && $percentage < 25) {
                    $percentage_color = "danger";
                }elseif ($percentage >= 25 && $percentage < 50) {
                    $percentage_color = "warning";
                }elseif ($percentage >= 50 && $percentage < 75) {
                    $percentage_color = "info";
                }elseif ($percentage >= 75 && $percentage <= 100) {
                    $percentage_color = "success";
                }
                else {
                    # code...
                }
                
                $stats_section .= "<div class = 'card'>";
                $stats_section .= "<div class = 'card-block'>";
                $stats_section .= "<div class='h4 mb-0'>{$value['no']}</div>";
                $stats_section .= "<small class='text-muted text-uppercase font-weight-bold'>{$value['text']}</small>";
                $stats_section .= "<progress class='progress progress-xs progress-{$percentage_color} mt-1 mb-0' value='{$percentage}' max='100'>{$percentage}%</progress>";
                $stats_section .= "</div>";
                $stats_section .= "</div>";
            }
        }
        return $stats_section;
    }

    function getFacilitiesTable($pt_uuid, $type=NULL){
        if($this->input->is_ajax_request()){
            $columns = [];
            $limit = $offset = $search_value = NULL;
            $columns = [
                0 => "facility_code",
                1 => "facility_name",
                2 => "status"
            ];

            $limit = $_REQUEST['length'];
            $offset = $_REQUEST['start'];
            $search_value = $_REQUEST['search']['value'];

            $facilities = $this->M_PTRounds->searchFacilityReadiness($pt_uuid, $search_value, $limit, $offset);
            $data = [];
            if ($facilities) {
                foreach ($facilities as $facility) {
                    $data[] = [
                        $facility->facility_code,
                        $facility->facility_name,
                        $facility->status,
                        ""
                    ];
                }
            }

            $all_facilities = $this->M_PTRounds->searchFacilityReadiness($pt_uuid, NULL, NULL, NULL);
            $total_data = count($all_facilities);
            $data_total= count($data);
            $json_data = [
                 "draw"             =>  intval( $_REQUEST['draw']),
                "recordsTotal"      =>  intval($total_data),
                "recordsFiltered"   =>  intval(count($this->M_PTRounds->searchFacilityReadiness($pt_uuid, $search_value, NULL, NULL))),
                'data'              =>  $data
             ];


            return $this->output->set_content_type('application/json')->set_output(json_encode($json_data));
        }
    }
}