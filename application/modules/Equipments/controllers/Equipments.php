<?php

class Equipments extends DashboardController{
    function __construct(){
        parent::__construct();
        $this->load->model('Auth/auth_m');
    }

    function index(){
    }

    function equipmentlist(){
        $data = [];

        $equipment_count = $this->db->count_all('equipment');

        $data = [
            'equipments_table'   =>  $this->createEquipmentTable(),
            'new_id_entry' => $equipment_count + 1
        ];



        // $this->assets
        //         ->addCss("plugin/select2/css/select2.min.css");
        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        $this->assets->setJavascript('Equipments/equipments_js');
        $this->template
                ->setModal("Equipments/new_equipment_v", "Create New Equipment")
                ->setPartial('Equipments/equipment_list_v', $data)
                ->adminTemplate();
    }

    function create(){
        if($this->input->post()){
            $equipmentname = $this->input->post('equipmentname');

            $insertdata = [
                'equipment_name'    =>  $equipmentname
            ];

            $this->db->insert('equipment', $insertdata);

            $equipment_id = $this->db->insert_id();

            $this->db->where('id', $equipment_id);
            $equipment = $this->db->get('equipment')->row();

            $message = "Equipment Name : " . $equipment->equipment_name . " is registered successfully";

            redirect('Equipments/equipmentlist', 'refresh');
        }
    }

    function createEquipmentTable(){
        $this->load->library('table');
        $this->load->config('table');

        $template = $this->config->item('default');

        $heading = [
            "No.",
            "Equipment Name",
            "Status",
            "Actions"
        ];
        $tabledata = [];

        $equipments = $this->db->get('equipment')->result();

        if($equipments){
            $counter = 0;
            foreach($equipments as $equipment){
                $counter ++;
                if($equipment->equipment_status == 1){
                    $status = "<label class = 'tag tag-success tag-sm'>Active</label>";
                    $change_state = "<a href = " . base_url('Equipments/changeState/deactivate/$equipment->id') . " class = 'btn btn-warning btn-sm'><i class = 'icon-refresh'></i>&nbsp;Deactivate Equipment</a>";
                }else{
                    $status = "<label class = 'tag tag-danger tag-sm'>Inactive</label>";
                    $change_state = "<a href = " . base_url('Equipments/changeState/activate/$equipment->id') . " class = 'btn btn-warning btn-sm'><i class = 'icon-refresh'></i>&nbsp;Activate Equipment</a>";
                }
                
                $tabledata[] = [
                    $counter,
                    $equipment->equipment_name,
                    $status,
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
printr("Activation");die();
            break;

            case 'deactivate':
printr("Deactivation");die();
            break;
        }

    }


}