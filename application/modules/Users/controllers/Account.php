<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends DashboardController{
    function __construct(){
        parent::__construct();
        $this->load->model('Auth/auth_m');
        $this->load->helper('string');
    }

    function index(){
		$user_details = $this->auth_m->findUserByIdentifier('uuid', $this->session->userdata('uuid'));
        $data = [
            'user'  =>  $user_details
        ];
        $this->assets
                ->addJs('dashboard/js/libs/jquery.validate.js');
        $this->assets->setJavascript('Users/account_js');
        $this->template
                ->setPartial('Users/my_acccount_v', $data)
                ->setPageTitle('My Account')
                ->adminTemplate();
    }

    function editAccount(){
        $uuid = $this->session->userdata('uuid');
        $valid = false;
        $errors = [];
        $new_password = "";
        if($this->input->post('old_password')){
            $user = $this->auth_m->findUserByIdentifier('uuid', $uuid);
            if(password_verify($this->input->post('old_password'), $user->password)){
                if($this->input->post('new_password') != $this->input->post('confirm_new_password')){
                     $errors[] = "The two passwords do not match";
                }else{
                    $new_password = $this->input->post('new_password');
                }
            }
            else{
                $errors[] = "The old password you entered is incorrect!";
            }
        }

        $avatar_url = "";

        if(is_uploaded_file($_FILES['userAvatar']['tmp_name'])){
            $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
            $fileExtension = strrchr($_FILES['userAvatar']['name'], ".");

            if (in_array($fileExtension, $validExtensions)) {
                $this->load->library('ImageManipulator');
                $manipulator = new ImageManipulator($_FILES['userAvatar']['tmp_name']);
                $newImage = $manipulator->resample(200, 200);
                $file_name = random_string('alnum', 32) ."_". $_FILES['userAvatar']['name'];

                $manipulator->save('./uploads/avatars/thumbs/' . $file_name);
                $avatar_url = base_url('uploads/avatars/thumbs/' . $file_name);
            }else{
                $errors[] = "The file you uploaded may not be an image";
            }
        }

        if(empty($errors)){
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email_address = $this->input->post('email_address');
            $phonenumber = $this->input->post('phonenumber');

            $user_type = $this->session->userdata('type');

            $insert_data = [];
            $table = "";
            switch ($user_type) {
                case 'participant':
                    $insert_data = [
                        'participant_fname'         =>  $firstname,
                        'participant_lname'         =>  $lastname,
                        'participant_email'         =>  $email_address,
                        'participant_phonenumber'   =>  $phonenumber
                    ];

                    if($new_password != ""){
                        $insert_data['participant_password'] = $this->hash->hashPassword($new_password);
                    }

                    $table = "participants";
                    break;
                case 'admin':
                case 'testers':
                    $insert_data = [
                        'user_firstname' =>  $firstname,
                        'user_lastname' =>  $lastname,
                        'email_address' =>  $email_address,
                        'phonenumber'   =>  $phonenumber
                    ];

                     if($new_password != ""){
                        $insert_data['password'] = $this->hash->hashPassword($new_password);
                    }

                    $table = "user";
                    break;
                default:
                    $table = "user";
                    break;
            }
            if($avatar_url != ""){
                $insert_data['avatar'] = $avatar_url;
            }

            $this->db->where('uuid', $uuid);
            if($this->db->update($table, $insert_data)){
                $this->session->set_flashdata('success', "Successfully updated your details");
            }else{
                $this->session->set_flashdata('error', "There was a problem updating your data. Please try again");
            }
           
        }else{
            $error_string = "<ul>";
            foreach($errors as $error){
                $error_string .= "<li>{$error}</li>";
            }
            $error_string .= "</ul>";
            $this->session->set_flashdata('error', $error_string);
        }

        redirect('Users/Account/');
    }


    
}