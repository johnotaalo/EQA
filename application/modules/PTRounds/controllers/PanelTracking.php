<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PanelTracking extends DashboardController {

	public function details($pt_uuid)
	{
		$this->template
				->setPartial('PTRounds/paneltracking/details_v')
				->adminTemplate();
	}

}

/* End of file PanelTracking.php */
/* Location: ./application/modules/PTRounds/controllers/PanelTracking.php */