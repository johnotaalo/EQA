<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {
	protected $usertypes;
	public function __construct(){
		parent::__construct();
		$this->usertypes = [
			'participant',
			'admin',
			'testers'
		];
		$this->load->module('Template');
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */