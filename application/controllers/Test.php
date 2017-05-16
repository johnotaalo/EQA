<?php

class Test extends MY_Controller{
	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->load->library('MyResque');
		$this->myresque->placeQueue('SendNotificationWorker', []);
	}
}