<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {
	protected $usertypes;
	public function __construct(){
		parent::__construct();
		$this->usertypes = [
			'participant',
			'admin',
			'testers',
			'QA Reviewer'
		];
		$this->load->module('Template');
	}

	public function get_string_between($string, $start, $end){
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */