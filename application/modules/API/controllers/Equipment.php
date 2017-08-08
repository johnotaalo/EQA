<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Equipment');
	}

	function get($id = NULL){
		$query_string = "";
		if (isset($_GET['q'])) {
			$query_string = $_GET['q'];
		}

		$equipment = $this->M_Equipment->get($id, $query_string);
		$data = [];
		if (count($equipment)) {
			if (isset($id)) {
				return $equipment;
			}else{
				foreach ($equipment as $eq) {
					$data['items'][] = [
						'id'	=>	$eq->id,
						'text'	=>	$eq->equipment_name
					];
				}
			}
		}

		if ($this->input->is_ajax_request()) {
			return $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
}

/* End of file Equipment.php */
/* Location: ./application/modules/API/controllers/Equipment.php */