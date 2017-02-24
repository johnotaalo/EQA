<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilities extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('API/M_Facilities');
	}
	public function get($id = NULL){
		$query_string = NULL;
		if (isset($_GET['q'])) {
			$query_string = $_GET['q'];
		}
		$facilities = $this->M_Facilities->get($id, $query_string);
		$data = [];
		if (count($facilities)) {
			if (isset($id)) {
				return $facilities;
			}else{
				foreach ($facilities as $facility) {
					$data['items'][] = [
						'id'	=>	$facility->id,
						'text'	=>	$facility->facility_name
					];
				}
			}
		}

		if ($this->input->is_ajax_request()) {
			return $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

}

/* End of file Facilities.php */
/* Location: ./application/modules/API/controllers/Facilities.php */