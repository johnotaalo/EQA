<?php

class Export extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('pdf');
	}

	function pdf($html, $data){
		$pdf = $this->pdf->load();

		$pdf->AddPage("P");

		$stylesheet = file_get_contents('./assets/dashboard/css/style.css');

		$pdf->WriteHTML($stylesheet, 1);
		$pdf->WriteHTML($html, 2);

		$pdf->SetHTMLHeader('<div style="text-align: right; font-weight: bold;">'.$data["document_title"].'</div>');

		$pdf->SetHTMLFooter('

		<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold;"><tr>

		<td width="33%"><span style="font-weight: bold; font-style: italic;">Exported on: {DATE j-m-Y H:i:s}</span></td>

		<td width="33%" align="center" style="font-weight: bold; font-style: italic;">Page {PAGENO} of {nbpg}</td>

		<td width="33%" style="text-align: right; ">'.$data["document_title"].'</td>

		</tr></table>

		');

		$pdf->output();
	}
}