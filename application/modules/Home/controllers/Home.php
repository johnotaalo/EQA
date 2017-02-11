<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view('Home/home_v');
	}

}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */