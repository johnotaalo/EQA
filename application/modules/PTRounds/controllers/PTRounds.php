<?php

class PTRounds extends DashboardController{
    function __construct(){
        parent::__construct();
    }

    function index(){
        $this->template
                    ->setPageTitle('PT Rounds')
                    ->setPartial('PTRounds/list_v')
                    ->adminTemplate();
    }
}