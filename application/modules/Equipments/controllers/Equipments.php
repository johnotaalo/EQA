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

            $message = "Equipment Name : <strong>" . $equipment->equipment_name . "</strong> is registered successfully";

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
                $id = $equipment->id;
                if($equipment->equipment_status == 1){
                    $status = "<label class = 'tag tag-success tag-sm'>Active</label>";
                    $change_state = '<a href = ' . base_url("Equipments/changeState/deactivate/$id") . ' class = "btn btn-warning btn-sm"><i class = "icon-refresh"></i>&nbsp;Deactivate </a>';
                    
                }else{
                    $status = "<label class = 'tag tag-danger tag-sm'>Inactive</label>";
                    $change_state = '<a href = ' . base_url("Equipments/changeState/activate/$id") . ' class = "btn btn-warning btn-sm"><i class = "icon-refresh"></i>&nbsp;Activate </a>';
                }

                $change_state .= ' <a href = ' . base_url("Equipments/equipmentEdit/$id") . ' class = "btn btn-primary btn-sm"><i class = "icon-note"></i>&nbsp;Edit</a>';
                
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
                $this->db->set('equipment_status', 1);

            break;

            case 'deactivate':
                $this->db->set('equipment_status', 0);
                
            break;
        }

        $this->db->where('id', $id);
        $this->db->update('equipment');

        redirect('Equipments/equipmentlist', 'refresh');

    }

    function equipmentEdit($equipmentid){
        $this->db->where('id', $equipmentid);
        $equipment = $this->db->get('equipment')->row();

        $data = [
            'equipment_id'  =>  $equipment->id,
            'equipment_name'  =>  $equipment->equipment_name
        ];
        $this->assets
                ->addJs('dashboard/js/libs/jquery.validate.js');
        $this->assets->setJavascript('Equipments/equipment_update_js');
        $this->template
                ->setPartial('Equipments/equipment_edit_v', $data)
                ->setPageTitle('Equipment Edit')
                ->adminTemplate();
    }

    function editEquipment(){
        if($this->input->post()){
            $equipmentid = $this->input->post('equipmentid');
            $equipmentname = $this->input->post('equipmentname');

            $this->db->set('equipment_name', $equipmentname);
            $this->db->where('id', $equipmentid);
            $this->db->update('equipment');
            
            $message = "Equipment Name : <strong>" . $equipmentname . "</strong> has been edited successfully";

            redirect('Equipments/equipmentlist', 'refresh');
        }
    }


}