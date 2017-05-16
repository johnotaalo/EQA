<?php
require APPPATH . 'Workers/autoload.php';

class MyResque{
	protected $ci;
	function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->config('resque');
		$this->setupEnv();
	}

	function setupEnv(){
		$settings = $this->ci->config->item('redis_settings');
		foreach ($settings as $key => $value) {
			putenv(sprintf('%s=%s', strtoupper($key), $value));
		}
	}

	function placeQueue($helper, $args){
		$id = Resque::enqueue($this->ci->config->item('settings')['prefix'], $helper, $args, true);
	}
}