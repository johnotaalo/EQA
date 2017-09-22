<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Excel');
	}
	function importCounties(){
		$file_path = './uploads/data/FCSCMapping.xlsx';
		$data = $this->excel->readExcel($file_path);
		if (count($data) > 0) {
			foreach ($data as $item => $itemData) {
				$headers = $itemData[0];
				$dbColumns = $this->getDbColumnNames($item);

				$cleaned_headers = array_replace($headers, $dbColumns);
				
				$insertData = [];
				for ($i=1; $i < count($itemData); $i++) { 
					if ($itemData[$i][0] != "" && is_numeric($itemData[$i][0])) {
						$rowData = array_combine($cleaned_headers, $itemData[$i]);
						array_push($insertData, $rowData);
					}
				}
				
				if (count($insertData)) {
					if ($item == "Facilities") {
						$this->db->insert_batch('facility', $insertData);
					}
				}
				
			}
		}
	}

	function getDbColumnNames($table = 'Counties'){
		$dbColumns = [];
		switch ($table) {
			case 'Counties':
				$dbColumns = [
					0	=>	'id',
					1	=>	'county_name',
					2	=>	'county_dhis_code',
					3	=>	'county_mfl_code',
					4	=>	'county_letter',
					5	=>	'county_coordinates'
				];
				break;
			case 'Sub Counties':
				$dbColumns = [
					0	=>	'id',
					1	=>	'sub_county_name',
					2	=>	'sub_county_dhis_code',
					3	=>	'sub_county_mfl_code',
					4	=>	'county_id',
					5	=>	'sub_county_coordinates'
				];
				break;
			case 'Partners':
				$dbColumns = [
					0	=>	'id',
					1	=>	'partner_name'
				];
				break;
			case 'Facilities':
				$dbColumns = [
					'id',
					'facility_code',
					'sub_county_id',
					'facility_name',
					'partner_id',
					'facility_type',
					'facility_dhis_code',
					'latitude',
					'longitude',
					'telephone',
					'alt_telephone',
					'email',
					'postal_address',
					'contact_person',
					'contact_telephone',
					'contact_alt_telephone',
					'physical_address',
					'contact_email',
					'sub_county_email',
					'county_email',
					'partner_email',
					'ART',
					'PMTC',
					'G4S_branch_name',
					'G4S_location',
					'G4S_phone_1',
					'G4S_phone_2',
					'G4S_phone_3',
					'G4S_fax'
				];
				break;
			default:
				# code...
				break;
		}

		return $dbColumns;
	}

	function importEquipmentMapping(){
		$file_path = './uploads/data/EquipmentMapping.xlsx';
		$data = $this->excel->readExcel($file_path);

		$insertData = [];
		foreach ($data as $equipment_id => $itemData) {
			$headers = $itemData[0];
			for ($i=1; $i < count($itemData); $i++) { 
				$insertData[] = [
					'equipment_id'	=>	$equipment_id,
					'facility_code'	=>	$itemData[$i][0]
				];
			}
		}

		// $this->db->insert_batch('facility_equipment_mapping', $insertData);
	}
}

/* End of file Import.php */
/* Location: ./application/modules/Data/controllers/Import.php */