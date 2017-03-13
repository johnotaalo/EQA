<?php

class Facilities extends DashboardController{
    function __construct(){
        parent::__construct();
        $this->load->model('Facilities/M_Facilities');
    }

    function list($type = NULL){
        $title = "$type Sites";
        if($type == NULL){
            $title = "All Facilities";
        }

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                    ->setJavascript('Facilities/facilities_js');
        $this->template
                    ->setPartial('Facilities/facilities_list_v')
                    ->setPageTitle($title)
                    ->adminTemplate();
    }

    function getTable(){
        $columns = [];
        $limit = $offset = $search_value = NULL;

        if($this->input->is_ajax_request()){
             $columns = [
                 0 => "facility_code",
                 1 => "facility_name",
                 2 => "county",
                 3 => "sub_county"
             ];

             $limit = $_REQUEST['length'];
             $offset = $_REQUEST['start'];
             $search_value = $_REQUEST['search']['value'];
         }

         $facilities = $this->M_Facilities->search($search_value, $limit, $offset);
         $data = [];

         if($facilities){
             foreach($facilities as $facility){
                 $data[] = [
                     $facility->facility_code,
                     $facility->facility_name,
                     $facility->county_name,
                     $facility->sub_county_name,
                     ""
                 ];
             }
         }

         if($this->input->is_ajax_request()){
            $allfacilities = $this->M_Facilities->search();
            $total_data = count($allfacilities);
            $data_total = count($facilities);

            $json_data = [
                 "draw"				=>	intval( $_REQUEST['draw']),
				"recordsTotal"		=>	intval($total_data),
				"recordsFiltered"	=>	intval(count($this->M_Facilities->search($search_value))),
				'data'				=>	$data
             ];

             return $this->output->set_content_type('application/json')->set_output(json_encode($json_data));
         }
    }
}