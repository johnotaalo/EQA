<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PanelTracking extends DashboardController {

	public function details($pt_uuid)
	{
		$data['pt_uuid'] = $pt_uuid;
		$this->template
				->setPartial('PTRounds/paneltracking/details_v', $data)
				->adminTemplate();
	}

	function batches($pt_uuid){
		$data['pt_uuid'] = $pt_uuid;
		$pt_round = $this->db->get_where('pt_round', ['uuid'=>$pt_uuid])->row();
		if ($pt_round) {
			$no_of_tubes = $this->db->get_where('pt_tubes', ['pt_round_id'=>$pt_round->id])->num_rows();
			if ($no_of_tubes == 0) {
				$this->createTrackingTubes($pt_round->id);
			}

			$data['batch_table'] = $this->createBatchTable($pt_round->id);

			$this->assets->setJavascript('PTRounds/paneltracking/batches_js');
			$this->template
				->setPartial('PTRounds/paneltracking/batches_v', $data)
				->adminTemplate();
		}else{
			show_404();
		}
	}

	private function createTrackingTubes($pt_id){
		$samples = $this->db->get_where('pt_samples', ['pt_round_id'=>$pt_id])->num_rows();
		if($samples != 0){
			$tubes = [];
			$number = 1;
			for ($i=0; $i < $samples; $i++) { 
				$tubes[] = [
					'tube_name'		=>	'Tube ' . $number,
					'pt_round_id'	=>	$pt_id
				];
				$number++;
			}

			$inserted = $this->db->insert_batch('pt_tubes', $tubes);
		}
	}

	private function createBatchTable($pt_id){
		$tubes = $this->db->get_where('pt_tubes', ['pt_round_id'=>$pt_id])->result();
		$batches = $this->db->get_where('pt_batches', ['pt_round_id'=>$pt_id])->result();
		$header = [];
		$header = [
			'#',
			'Batch No'
		];
		if ($tubes) {
			foreach ($tubes as $tube) {
				$header[] = $tube->tube_name;
			}
		}
		$header[] = "Details";
		$header[] = "Delete";

		$body = [];
		if ($batches) {
			$counter = 1;
			$key_counter = 0;
			foreach ($batches as $batch) {
				$body[$key_counter][] = $counter;
				$body[$key_counter][] = $batch->batch_name;
				if ($tubes) {
					foreach ($tubes as $tube) {
						$where = [
							'batch_id'	=>	$batch->id,
							'tube_id'	=>	$tube->id
						];
						$batch_tube = $this->db->get_where('pt_batch_tube', $where)->row();
						if($batch_tube){
							$sample = $this->db->get_where('pt_samples', ['id'=>$batch_tube->id])->row();
							$body[$key_counter][] = $sample->sample_name;

						}

					}
				}
				$body[$key_counter][] = "";
				$body[$key_counter][] = "";
				$key_counter++;
				$counter++;
			}
		}

		$this->load->library('table');
		$this->load->config('table');
		$template = $this->config->item('default');
		$this->table->set_heading($header);
		$this->table->set_template($template);
		return $this->table->generate($body);
	}

	function add($pt_uuid, $batch_uuid = NULL){
		$data['pt_uuid'] = $pt_uuid;
		$pt_round = $this->db->get_where('pt_round', ['uuid'=>$pt_uuid])->row();
		$title = ($batch_uuid == NULL) ? "Create new batch" : "";
		$tubes_list = "";
		if ($batch_uuid == NULL) {
			$tubes = $this->db->get_where('pt_tubes', ['pt_round_id'=>$pt_round->id])->result();
			$batch_name = $this->pt_brand_name($pt_round->id);
			foreach ($tubes as $tube) {
				$tubes_list .= "<div class = 'form-group'>";
				$tubes_list .= "<label>{$tube->tube_name}</label>";
				$tubes_list .= "<select class = 'form-control' name = '{$tube->uuid}'>";
				$samples = $this->db->get_where('pt_samples', ['pt_round_id'=>$pt_round->id])->result();
				foreach ($samples as $sample) {
					$tubes_list .= "<option value = '{$sample->uuid}'>{$sample->sample_name}</option>";
				}
				$tubes_list .= "</select>";
				$tubes_list .= "</div>";
			}
		}
		$data['tubes_list'] = $tubes_list;
		$data['batch_name'] = $batch_name;
		$return_data = [];

		$return_data = [
			'status'	=>	TRUE,
			'title'		=>	$title,
			'page'		=>	$this->load->view('PTRounds/paneltracking/new_batch_v', $data, TRUE)
		];

		return $this->output->set_content_type('application/json')->set_output(json_encode($return_data));
	}

	function pt_brand_name($pt_round_id){
		$this->db->select_max('batch_name');
		$this->db->where('pt_round_id', $pt_round_id);
		$result = $this->db->get('pt_batches')->row();
		if ($result->batch_name) {
			$number = (substr($data, strpos($data, " ") + 1))+1;
		}else{
			$number = 1;
		}

		return "Batch " . $number;
	}

	function addBatchInfo(){

	}
}

/* End of file PanelTracking.php */
/* Location: ./application/modules/PTRounds/controllers/PanelTracking.php */