<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PTRound extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Participant/M_PTRound');
		$this->load->library('Mailer');
	}

	public function Round($round_uuid){
		$data['pt_uuid']	=	$round_uuid;
		$this->assets
			->addJs('dashboard/js/libs/jquery.validate.js')
            ->addJs("plugin/sweetalert/sweetalert.min.js");
        $this->assets->setJavascript('Participant/participant_login_js');
		$this->assets->addCss('css/signin.css');
		$this->template->setPageTitle('PT Forms')->setPartial('pt_form_v',$data)->adminTemplate();
	}

	public function Tracking($round_uuid){
		$data['pt_uuid']	=	$round_uuid;
		$this->assets
			->addJs('dashboard/js/libs/jquery.validate.js')
            ->addJs("plugin/sweetalert/sweetalert.min.js");
        $this->assets->setJavascript('Participant/participant_login_js');
		$this->assets->addCss('css/signin.css');
		$this->template->setPageTitle('PT Forms')->setPartial('pt_tracking_v',$data)->adminTemplate();
	}
	

}

/* End of file Participant.php */
/* Location: ./application/modules/Participant/controllers/PTRound.php */