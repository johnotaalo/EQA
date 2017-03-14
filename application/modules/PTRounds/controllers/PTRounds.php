<?php

class PTRounds extends DashboardController{
    protected $menu, $lab_id_prefix;
    function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->menu = [
            'information'   =>  [
                'icon'  =>  'fa fa-info-circle',
                'text'  =>  'PT Details'
            ],
            'variables'     =>  [
                'icon'  =>  'fa fa-table',
                'text'  =>  'Variables'
            ]
        ];

        $this->lab_id_prefix = "CD4-PT-";
    }

    function index(){
        $this->template
                    ->setPageTitle('PT Rounds')
                    ->setPartial('PTRounds/list_v')
                    ->adminTemplate();
    }

    function create($step = NULL, $id = NULL){
        $data = $pagedata = [];
        if($step == NULL){
            $step = "information";
        }

        if(($step != NULL && $step != "information") && $id == NULL){
            $step = "information";
            $this->session->set_flashdata('error', 'Sorry. You need to create the PT Round first');
            redirect('PTRounds/create/' . $step);
        }

        $view = "";

        switch ($step) {
            case 'information':
                $view = "pt_info_v";
                $pagedata['round_no'] = $this->generateRoundNumber();
                $pagedata['lab_prefix'] = $this->lab_id_prefix;
                break;
            case 'variables':
                $view = "pt_variables_v";
                break;
            default:
                # code...
                break;
        }

        $data['step'] = $step;
        $data['page'] = $view;
        $data['pageData'] = $pagedata;
        $data['submenu'] = $this->createSubMenu($step, $id);

        $js_data = [
            'step'  =>  $step
        ];
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
        if($step != NULL){
            if(($id != NULL && $step == "information") || ($step != "information" && $id != NULL) || ($step == "information" && $id == NULL)){
                switch ($step) {
                    case 'information':
                        $pt_data = [
                            'pt_round_no'       =>  $this->generateRoundNumber(),
                            'blood_lab_unit_id' =>  $this->lab_id_prefix . $this->input->post('blood_unit_lab_id')
                        ];

                        $this->db->insert('pt_round', $pt_data);
                        $round_id = $this->db->insert_id();

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

                        $this->db->select('uuid');
                        $this->db->where('id', $round_id);
                        $id = $this->db->get('pt_round')->row()->uuid;
                        break;
                    
                    default:
                        # code...
                        break;
                }                
                redirect('PTRounds/create/' . $nextpage . '/' . $id,'refresh');               
            }else{
                $step = "information";
                $this->session->set_flashdata('error', 'Sorry. An error was encountered while proessing your request. Please try again');
                redirect('PTRounds/create/' . $step);
            }
        }
    }

    function nextpage($current){
        reset($this->menu);
        while(key($this->menu) !== $current){
            next($this->menu);
        }

        $next_array = next($this->menu);
        $next_key = key($this->menu);
        
        return $next_key;
    }

    function generateRoundNumber(){
        $prefix = "NHRL/CD4/";
        $year = date("Y");
        $this->db->like('pt_round_no', $year);
        $this->db->select_max("pt_round_no");
        $query = $this->db->get('pt_round');
        
        $data = $query->row();
        $number = 1;
        if($data){
            if($data->pt_round_no){
                $data_frags = explode("-", $data->pt_round_no);
                $number = $data_frags[1];
            }
        }

        $round_number = $prefix . $year . '-' . $number;
        
        return $round_number;
    }
    
}