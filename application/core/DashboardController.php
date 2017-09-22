<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->module('Auth');
		$this->auth->checkLogin();
	}
}
