<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends PHPExcel
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function readExcel($filepath){
		$excelData = [];
		try {
			$inputFileType = PHPExcel_IOFactory::identify($filepath);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($filepath);
		} catch(Exception $e) {
			die('Error loading file "'.pathinfo($filepath,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$sheetsNo = $objPHPExcel->getSheetCount();
		for($i = 0; $i<$sheetsNo; $i++){
			$sheet = $objPHPExcel->getSheet($i);

			$highestRow = $sheet->getHighestRow(); 
			$highestColumn = $sheet->getHighestColumn();

			$excelData[$sheet->getTitle()] = [];
			for ($row = 1; $row <= $highestRow ; $row++) {
				$rowData = $sheet->rangeToArray('A'. $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
				array_push($excelData[$sheet->getTitle()], $rowData[0]);
			}
		}

		return $excelData;
	}
}

/* End of file Excel.php */
/* Location: ./application/libraries/Excel.php */
