<?php

class Users extends DashboardController{
    function __construct(){
        parent::__construct();
        $this->load->model('Auth/auth_m');
    }

    function index(){
    }

    function userlist(){
        $data = [];

        $data = [
            'users_table'   =>  $this->createUserTable()
        ];

        // $this->assets
        //         ->addCss("plugin/select2/css/select2.min.css");
        $this->assets
                ->addJs("dashboard/js/libs/jquery.dataTables.min.js")
                ->addJs("dashboard/js/libs/dataTables.bootstrap4.min.js")
                ->addJs('dashboard/js/libs/jquery.validate.js')
                ->addJs('dashboard/js/libs/select2.min.js');
        $this->assets->setJavascript('Users/users_js');
        $this->template
                ->setModal("Users/new_user_v", "Create New User")
                ->setPartial('Users/list_v', $data)
                ->adminTemplate();
    }

    function create(){
        if($this->input->post()){
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email_address');
            $role = $this->input->post('role');

            $insertdata = [
                'user_firstname'    =>  $firstname,
                'user_lastname'     =>  $lastname,
                'email_address'     =>  $email,
                'user_type'         =>  $role,
                'status'            =>  0
            ];

            $this->db->insert('user', $insertdata);

            $user_id = $this->db->insert_id();

            $this->db->where('id', $user_id);
            $user = $this->db->get('user')->row();

            if($user){
                $data = [
                    'username'  =>  $firstname ." " . $lastname,
                    'url'       =>  $this->config->item('server_url') . "Auth/firstTime/" . $user->uuid
                ];

                $body = $this->load->view('Template/email/user_created_v', $data, TRUE);
                $this->load->library('Mailer');
                $sent = $this->mailer->sendMail($email, "Account Created", $body);
                if ($sent == FALSE) {
                    log_message('error', "The system could not send an email to {$email}. Username: $lastname $firstname at " . date('Y-m-d H:i:s'));
                }
            }
            redirect('Users/userlist', 'refresh');
        }
    }

    function createUserTable(){
        $this->load->library('table');
        $this->load->config('table');

        $template = $this->config->item('default');

        $heading = [
            "Name",
            "Email Address",
            "Role",
            "Status",
            "Actions"
        ];
        $tabledata = [];

        $this->db->where('user_type !=', "admin");
        $this->db->where('uuid != ', $this->session->userdata('uuid'));
        $users = $this->db->get('user')->result();

        if($users){
            foreach($users as $user){
                $status = "<label class = 'tag tag-danger tag-sm'>Inactive</label>";
                if($user->status == 1){
                    $status = "<label class = 'tag tag-success tag-sm'>Active</label>";
                }
                $tabledata[] = [
                    $user->user_firstname ." " . $user->user_lastname,
                    $user->email_address,
                    strtoupper($user->user_type),
                    $status,
                    "<a href = '#' class = 'btn btn-warning btn-sm'><i class = 'icon-refresh'></i>&nbsp;Reset Password</a>"
                ];
            }
        }
        $this->table->set_heading($heading);
        $this->table->set_template($template);

        return $this->table->generate($tabledata);
    }
}