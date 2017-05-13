<?php

class Equipments extends DashboardController{
    function __construct(){
        parent::__construct();
        $this->load->library('table');
        $this->load->config('table');

        //$this->load->model('Equipments/M_Equipments');
    }

    function index(){
    }

    function equipmentlist($eFacilities = NULL){
        $data = [];
        $title = "Equipments";
        $equipment_count = $this->db->count_all('equipment');

        if($eFacilities == NULL){

            $data = [
                'table_view'    =>  $this->createEquipmentTable(),
                'new_id_entry'  => $equipment_count + 1,
                'equipmentview' => 1
            ];

        }else{
            $data = [
                'table_view'   =>  $this->facilities($eFacilities),
                'new_id_entry' => '',
                'equipmentview' => 0
            ];
        }

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        $this->assets->setJavascript('Equipments/equipments_js');
        $this->template
                ->setModal("Equipments/new_equipment_v", "Add New Equipment")
                ->setPageTitle($title)
                ->setPartial('Equipments/equipment_list_v', $data)
                ->adminTemplate();
    }

    function newEquipmentView(){
        $data = [];
        $title = "Equipments";

        $data = [
               
            ];

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        $this->assets->setJavascript('Equipments/equipments_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('Equipments/new_equipment_v', $data)
                ->adminTemplate();
    }


    function newFlourochromes($equipment_id){
        $data = [];
        $title = "Flourochromes";
        $counter = 1;
        $flourochromes_display = "<fieldset class='page-signup-form-group form-group form-group-lg'><div class = 'form-group'><div class = 'form-group'><label class = 'control-label col-md-3'>Flourochrome {$counter}</label><div class='col-md-9'><input type = 'text' name = 'flourochromes[]' class = 'form-control'/></div></div></fieldset>";

        $data = [
               'flouro_display' => $flourochromes_display,
               'equipment' => $equipment_id
            ];

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        $this->assets->setJavascript('Equipments/equipments_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('Equipments/new_flourochromes_v', $data)
                ->adminTemplate();
    }

    function newAnalytes($equipment_id){
        $data = [];
        $title = "Analytes";
        $counter = 1;

        $data = [
               'equipment' => $equipment_id
            ];

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        $this->assets->setJavascript('Equipments/equipments_js');
        $this->template
                ->setPageTitle($title)
                ->setPartial('Equipments/new_analytes_v', $data)
                ->adminTemplate();
    }


    function equipmentEdit($id){
        $this->db->where('uuid', $id);
        $equipment = $this->db->get('equipments_v')->row();
        //echo '<pre>';print_r($equipment);echo '</pre>';die();

        $flourochromes = $this->getFlourochromes($equipment->id);
        
        $data = [
            'equipment_id'          =>  $equipment->id,
            'equipment_uuid'        =>  $equipment->uuid,
            'equipment_name'        =>  $equipment->equipment_name,
            'kit_name'              =>  $equipment->kit,
            'lysis_method'          =>  $equipment->lysis,
            'absolute_count_beads'  =>  $equipment->acb,
            'analytes_absolute'     =>  $equipment->absolute,
            'analytes_absolute_cd3' =>  $equipment->absolute_cd3,
            'analytes_absolute_cd4' =>  $equipment->absolute_cd4,
            'analytes_percent'      =>  $equipment->percent,
            'analytes_percent_cd3'  =>  $equipment->percent_cd3,
            'analytes_percent_cd4'  =>  $equipment->percent_cd4,
            'flourochromes'         =>  $flourochromes
        ];

        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        $this->assets->setJavascript('Equipments/equipment_update_js');
        $this->template
                ->setPartial('Equipments/equipment_edit_v', $data)
                ->setPageTitle('Equipment Edit')
                ->adminTemplate();
    }


    function create(){
        if($this->input->post()){
            $equipmentname = $this->input->post('equipmentname');
            $kitnames = $this->input->post('kitnames');

            if($this->input->post('lysis') == '' || $this->input->post('lysis') == NULL){
                $lysis = 'N/A';
            }else{
                $lysis = $this->input->post('lysis');
            }

            if($this->input->post('acb') == '' || $this->input->post('acb') == NULL){
                $acb = 'N/A';
            }else{
                $acb = $this->input->post('acb');
            }

            $insertdata = [
                'equipment_name'    =>  $equipmentname,
                'kit_name'    =>  $kitnames,
                'lysis_method'    =>  $lysis,
                'absolute_count_beads'    =>  $acb,
                'equipment_status'    =>  1
            ];

            //$this->db->insert('equipment', $insertdata);

            if($this->db->insert('equipment', $insertdata)){
                $this->session->set_flashdata('success', "Successfully created new Equipment");

                $equipment_id = $this->db->insert_id();

                //$this->newFlourochromes($equipment_id);
                redirect('Equipments/newFlourochromes/' . $equipment_id);

            }else{
                $this->session->set_flashdata('error', "There was a problem creating a new equipment. Please try again");
            }

            //redirect('Equipments/equipmentlist', 'refresh');
        }
    }

    public function addFlourochromes($equipment_id){

        if($this->input->post()){
            $flourochromes = $this->input->post('flourochromes');
            $flourochromes_data = [];
            foreach ($flourochromes as $flourochrome) {
                $flourochromes_data[] = [
                    'fl_name'   =>  $flourochrome,
                    'equipment_id'   =>  $equipment_id
                ];
            }

            $this->db->insert_batch('flourochromes', $flourochromes_data);

            redirect('Equipments/newAnalytes/' . $equipment_id);
        }else{

        }
    }

    public function addAnalytes($equipment_id){

        if($this->input->post()){
            if($this->input->post('absolute') == NULL){
                $absolute = 0;
            }else{
                $absolute = $this->input->post('absolute');
            }
            if($this->input->post('absolutecd3') == NULL){
                $absolutecd3 = 0;
            }else{
                $absolutecd3 = $this->input->post('absolutecd3');
            }
            if($this->input->post('absolutecd4') == NULL){
                $absolutecd4 = 0;
            }else{
                $absolutecd4 = $this->input->post('absolutecd4');
            }
            if($this->input->post('percent') == NULL){
                $percent = 0;
            }else{
                $percent = $this->input->post('percent');
            }
            if($this->input->post('percentcd3') == NULL){
                $percentcd3 = 0;
            }else{
                $percentcd3 = $this->input->post('percentcd3');
            }
            if($this->input->post('percentcd4') == NULL){
                $percentcd4 = 0;
            }else{
                $percentcd4 = $this->input->post('percentcd4');
            }

            $this->db->set('analytes_absolute', $absolute);
            $this->db->set('analytes_absolute_cd3', $absolutecd3);
            $this->db->set('analytes_absolute_cd4', $absolutecd4);
            $this->db->set('analytes_percent', $percent);
            $this->db->set('analytes_percent_cd3', $percentcd3);
            $this->db->set('analytes_percent_cd4', $percentcd4);

            $this->db->where('id', $equipment_id);

            if($this->db->update('equipment')){
                $this->session->set_flashdata('success', "Successfully added the new equipment details");
            }else{
                $this->session->set_flashdata('error', "There was a problem adding the new equipment details. Please try again");
            }

            redirect('Equipments/equipmentlist/');
        }else{

        }
    }

    function createEquipmentTable(){

        $template = $this->config->item('default');

        $heading = [
            "No.",
            "Equipment Name",
            "Status",
            "No. of Facilities Equipped",
            "Actions"
        ];
        $tabledata = [];

        //$equipments = $this->M_Facilities->getequipments();
        $equipments = $this->db->get('equipments_v')->result();


        if($equipments){
            $counter = 0;
            foreach($equipments as $equipment){
                $counter ++;
                $id = $equipment->uuid;
                if($equipment->equipment_status == 1){
                    $status = "<label class = 'tag tag-success tag-sm'>Active</label>";
                    $change_state = '<a href = ' . base_url("Equipments/changeState/deactivate/$id") . ' class = "btn btn-danger btn-sm"><i class = "icon-refresh"></i>&nbsp;Deactivate </a>';
                    
                }else{
                    $status = "<label class = 'tag tag-danger tag-sm'>Inactive</label>";
                    $change_state = '<a href = ' . base_url("Equipments/changeState/activate/$id") . ' class = "btn btn-success btn-sm"><i class = "icon-refresh"></i>&nbsp;Activate </a>';
                }

                $change_state .= ' <a href = ' . base_url("Equipments/equipmentEdit/$id") . ' class = "btn btn-primary btn-sm"><i class = "icon-note"></i>&nbsp;Edit</a>';
                
                $tabledata[] = [
                    $counter,
                    $equipment->equipment_name,
                    $status,
                    '<a class="data-toggle="tooltip" data-placement="top" title="Facilities with this equipment"" href = ' . base_url("Equipments/equipmentlist/$id") . ' >'. $equipment->facilities .'</a>',
                    $change_state
                ];
            }
        }
        $this->table->set_heading($heading);
        $this->table->set_template($template);

        return $this->table->generate($tabledata);
    }

    function changeState($type, $id){
        switch($type){
            case 'activate':
                $this->db->set('equipment_status', 1);

            break;

            case 'deactivate':
                $this->db->set('equipment_status', 0);
                
            break;
        }

        $this->db->where('uuid', $id);
        //$this->db->update('equipment');

        if($this->db->update('equipment')){
            $this->session->set_flashdata('success', "Successfully updated the equipment details");
        }else{
            $this->session->set_flashdata('error', "There was a problem updating the equipment details. Please try again");
        }

        redirect('Equipments/equipmentlist', 'refresh');

    }

    function flouroState($type, $id){
        switch($type){
            case 'activate':
                $this->db->set('fl_status', 1);

            break;

            case 'deactivate':
                $this->db->set('fl_status', 0);
                
            break;
        }

        $this->db->where('fl_id', $id);
        //$this->db->update('equipment');

        if($this->db->update('flourochromes')){
            $this->session->set_flashdata('success', "Successfully updated the flourochrome details");
        }else{
            $this->session->set_flashdata('error', "There was a problem updating the flourochrome details. Please try again");
        }

        redirect('Equipments/equipmentlist', 'refresh');

    }

    


    function getFlourochromes($equipmentId){
        $counter = 0;
        $this->db->where('equipment_id', $equipmentId);
        $this->db->where('fl_status', 1);
        $flourochromes = $this->db->get('flourochromes_v')->result();

        $result_view = '';


        foreach ($flourochromes as $key => $flourochrome) {
            // echo '<pre>';print_r($value);echo '</pre>';die();
            $counter ++;           
            $result_view .= "<div class = 'form-group row divcounter'>
                                <label class = 'col-md-3 form-control-label counter'>Flourochrome ".$counter."</label>
                                <div class = 'col-md-6'>
                                    <input type = 'text' name = 'flouro[]' class = 'form-control' value = '".$flourochrome->fl_name."' required/>
                                </div>
                                <div class = 'col-md-3'>
                                    <a href = ".base_url("Equipments/flouroState/deactivate/$flourochrome->id")." class = 'remove-flouro'><i class = 'fa fa-times'></i>
                                    </a>
                                </div>
                            </div>";
        }

        return $result_view;
    }

    function editEquipment(){
        if($this->input->post()){
            $equipmentuuid = $this->input->post('equipmentuuid');

            $equipmentname = $this->input->post('equipmentname');
            $kitname = $this->input->post('kitname');
            $lysismethod = $this->input->post('lysismethod');
            $acb = $this->input->post('acb');
            $absolute = $this->input->post('absolute');
            $percent = $this->input->post('percent'); 

            if($absolute == 0 || $absolute == NULL){
                $absolute_cd3 = 0;
                $absolute_cd4 = 0;
            }else{
                $absolute_cd3 = $this->input->post('absolute_cd3');
                $absolute_cd4 = $this->input->post('absolute_cd4');
            }

            if($percent == 0 || $percent == NULL){
                $percent_cd3 = 0;
                $percent_cd4 = 0;
            }else{
                $percent_cd3 = $this->input->post('percent_cd3');
                $percent_cd4 = $this->input->post('percent_cd4');
            }

            $this->db->set('equipment_name', $equipmentname);
            $this->db->set('kit_name', $kitname);
            $this->db->set('lysis_method', $lysismethod);
            $this->db->set('absolute_count_beads', $acb);
            $this->db->set('analytes_absolute', $absolute);
            $this->db->set('analytes_absolute_cd3', $absolute_cd3);
            $this->db->set('analytes_absolute_cd4', $absolute_cd4);
            $this->db->set('analytes_percent', $percent);
            $this->db->set('analytes_percent_cd3', $percent_cd3);
            $this->db->set('analytes_percent_cd4', $percent_cd4);

            $this->db->where('uuid', $equipmentuuid);



            if($this->db->update('equipment')){
                $this->db->where('uuid', $equipmentuuid);
                $equipment_id = $this->db->get('equipments_v')->row()->id;

                // echo '<pre>';print_r($equipment_id);echo '</pre>';die();

                $this->db->set('fl_status', 0);
                $this->db->where('equipment_id', $equipment_id);
                $this->db->update('flourochromes');

                $flourochromes = $this->input->post('flouro');
                $flourochromes_data = [];

                foreach ($flourochromes as $flourochrome) {
                    $flourochromes_data[] = [
                        'fl_name'   =>  $flourochrome,
                        'equipment_id'   =>  $equipment_id
                    ];
                }

                $this->db->insert_batch('flourochromes', $flourochromes_data);


                $this->session->set_flashdata('success', "Successfully updated the equipment " . $equipmentname);

            }else{
                $this->session->set_flashdata('error', "There was a problem updating the equipment details. Please try again");
            }

            redirect('Equipments/equipmentlist', 'refresh');
        }
    }

    function facilities($equipmentId){

        $template = $this->config->item('default');

        $facilityheading = [
            "No.",
            "MFL. Code",
            "Facility Name",
            "County",
            "Sub County",
            "Actions"
        ];
        $facilitytabledata = [];

        $this->db->where('e_uuid', $equipmentId);
        $efacilities = $this->db->get('equipment_facilities_v')->result();

        if($efacilities){
            $counter = 0;
            foreach($efacilities as $facility){
                $counter ++;
 
                $facilitytabledata[] = [
                    $counter,
                    $facility->facility_code,
                    $facility->facility_name,
                    $facility->county_name,
                    $facility->sub_county_name,
                    ""
                ];
            }
        }

        $this->table->set_heading($facilityheading);
        $this->table->set_template($template);

        return $this->table->generate($facilitytabledata);
    }


}