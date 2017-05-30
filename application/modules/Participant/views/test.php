
                    $responses_table .= "<td>{$response->question}</td>";
                $response_status = "";
                if($response->response != NULL && $response->extra_comments == NULL){
                    if($response->response == 0) {
                        $response_status = "No";
                    }
                    elseif($response->response == 1){
                        $response_status = "Yes";
                    }
                }elseif($response->extra_comments != NULL){
                    $response_status = $response->extra_comments;
                }
                $responses_table .= "<td>{$response_status}</td>";
                $responses_table .= "</tr>";
            }
        }

        return $responses_table;
    }

    function addReadinessAssessmentOutcome($readiness_id){
        $readiness = $this->db->get_where('participant_readiness', ['readiness_id' => $readiness_id])->row();
        if ($readiness) {
            $participant = $this->db->get_where('participants', ['uuid' => $readiness->participant_id])->row();
            $facility = $this->db->get_where('facility', ['id'  =>  $participant->participant_facility])->row();
            $verdict = $this->input->post('verdict');
            $status = ($this->input->post('status') == 'on') ? 1 : 0;
            $comment = $this->input->post('readiness_comment');

            $update_data = [
                'verdict'   =>  $verdict,
                'status'    =>  $status,
                'comment'   =>  $comment
            ];

            $this->db->where('readiness_id', $readiness->readiness_id);
            $result = $this->db->update('participant_readiness', $update_data);
            if ($result) {
                $this->session->set_flashdata('success', 'Successfully updated assessment outcome');
            }else{
                $this->session->set_flashdata('error', 'There was an issue updating your assessment outcome');
            }
            redirect('PTRounds/facilityreadiness/' . $readiness->pt_round_no . '/' . $facility->facility_code);
        }else{
            $this->session->set_flashdata('error', 'There was an issue updating your assessment outcome');
            redirect('Dashboard','refresh');
        }
    }

    function sendemails($pt_round_uuid, $facility_code = NULL){
        $pt_round = $this->db->get_where('pt_round', ['uuid'   =>  $pt_round_uuid])->row();
        $this->load->library('Mailer');
        if ($pt_round) {
            $recepients = [];
            if($facility_code == NULL){
                $facilities = $this->M_PTRounds->searchFacilityReadiness($pt_round_uuid);
                $recepients_array = [];
                foreach ($facilities as $facility) {
                    if($facility->smart_status == NULL || $facility->smart_status == "No Response"){
                        $participants = $this->db->get_where('participants', ['participant_facility' =>  $facility->facility_id])->result();
                        if($participants){
                            foreach ($participants as $participant) {
                               $recepients_array[$participant->participant_email]  =  $participant->participant_fname . ' ' . $participant->participant_lname;
                            }
                        }elseif ($facility->email != "NULL" && $facility->email != "(NULL)" && $facility->email != "") {
                            // $recepients_array[$facility->email]  =  $facility->facility_name;
                        }
                    }
                }

                if ($recepients_array) {
                    $recepients = $recepients_array;
                }
            }else{
                $facility = $this->db->get_where('facility', ['facility_code'   =>  $facility_code])->row();
                $participants = $this->db->get_where('participants', ['participant_facility' =>  $facility->id])->result();
                if($participants){
                    foreach ($participants as $participant) {
                        $recepients[$participant->participant_email]  =  $participant->participant_fname . ' ' . $participant->participant_lname;
                    }
                }elseif ($facility->email != "NULL" && $facility->email != "(NULL)" && $facility->email != "") {
                    // $recepients[$facility->email]  =  $facility->facility_name;
                }
            }

            $data = [
                'pt_round_no'   =>  $pt_round->pt_round_no,
                'round_uuid'    =>  $pt_round->uuid,
                'due_date'  => $pt_round->to
            ];
            $body = $this->load->view('Template/email/assessment_link_v', $data, TRUE);
            $result = $this->mailer->sendMail('john.otaalo@strathmore.edu', 'PT Round Evaluation Link', $body, $recepients);
            if($result == true){
                $this->session->set_flashdata('success', 'Successfully sent the evaluation link(s)');
            }else{
                $this->session->set_flashdata('error', 'There was an error sending the evaluation link(s). Please contact the system administrator for further guidance');
            }

            redirect('PTRounds/create/facilities/' . $pt_round_uuid);
        }else{
            show_404();
        }
    }
}