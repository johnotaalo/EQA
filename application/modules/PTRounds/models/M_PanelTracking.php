<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_PanelTracking extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function getReadyFacilities($pt_round_uuid, $search_value = NULL, $limit = NULL, $offset = NULL){
		$this->db->select("pr.readiness_id,
			pr.uuid as readiness_uuid,
			pr.verdict,
			p.participant_fname,
			p.participant_lname,
			IF(ptb.batch_name IS NULL, 'No batch assigned', ptb.batch_name) as batch,
			f.facility_name,
			f.facility_code,
			ppt.id as panel_tracking_id, 
			ppt.uuid as panel_tracking_uuid,
			ppt.panel_preparation_date,
			ppt.courier_collection_date,
			ppt.participant_received_date,
			(
				CASE 
				WHEN (ppt.panel_preparation_date IS NULL) THEN 'Awaiting Preparation'
				WHEN (ppt.panel_preparation_date IS NOT NULL AND ppt.courier_collection_date IS NULL) THEN 'Awaiting Courier Dispatch'
				WHEN (ppt.panel_preparation_date IS NOT NULL AND ppt.courier_collection_date IS NOT NULL AND ppt.participant_received_date IS NULL) THEN 'Awaiting Participant Reception'
				WHEN (ppt.panel_preparation_date IS NOT NULL AND ppt.courier_collection_date IS NOT NULL AND ppt.participant_received_date IS NOT NULL) THEN 'Panel Received'
				ELSE 'Nothing Yet'
				END
			) as status,
			(CASE 
				WHEN (ppt.panel_preparation_date IS NULL) THEN 0
				WHEN (ppt.panel_preparation_date IS NOT NULL AND ppt.courier_collection_date IS NULL) THEN 1
				WHEN (ppt.panel_preparation_date IS NOT NULL AND ppt.courier_collection_date IS NOT NULL AND ppt.participant_received_date IS NULL) THEN 2
				WHEN (ppt.panel_preparation_date IS NOT NULL AND ppt.courier_collection_date IS NOT NULL AND ppt.participant_received_date IS NOT NULL) THEN 3
				ELSE 4
				END) AS status_code");
		$this->db->from('pt_panel_tracking ppt');
		$this->db->join('participant_readiness pr', 'pr.readiness_id = ppt.pt_readiness_id', 'RIGHT');
		$this->db->join('participants p', 'p.uuid = pr.participant_id', 'RIGHT');
		$this->db->join('pt_batches ptb', 'ptb.id = ppt.pt_batch_id', 'LEFT');
		$this->db->join('facility f', 'f.id = p.participant_facility');
		$this->db->where('pr.verdict', 1);
		$this->db->where('pr.pt_round_no', $pt_round_uuid);
		if ($search_value != NULL) {
			$this->db->where("(facility_name LIKE '%{$search_value}%' OR participant_fname LIKE '%{$search_value}%' OR participant_lname LIKE '%{$search_value}%' OR facility_code LIKE '%{$search_value}%')");
		}

		if($limit != NULL && $offset != NULL){
			$this->db->limit($limit, $offset);
		}

		$query = $this->db->get();

		return $query->result();
	}
}