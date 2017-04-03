<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ini_set('memory_limit','-1');
class PDF {

	function __construct()
	{
		$CI = & get_instance();
		log_message('Debug', 'mPDF class is loaded.');
	}

	function load($param=NULL)
	{         
		if ($param == NULL)
		{
			$param = '"en-GB-x","A4","","",10,10,10,10,6,3';         
		}

		return new mPDF($param);
	}
}