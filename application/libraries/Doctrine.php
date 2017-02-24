<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Doctrine\Common\Classloader,
	Doctrine\ORM\Configuration,
	Doctrine\ORM\EntityManager,
	Doctrine\Common\Cache\ArrayCache,
	Doctrine\DBAL\Logging\EchoSQLLogger;

class Doctrine
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
        require_once APPPATH . 'config/database.php';
	}

	

}

/* End of file Doctrine.php */
/* Location: ./application/libraries/Doctrine.php */
