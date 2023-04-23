<?php

namespace Soccer\Api\Controller;

use League\Plates\Engine;

class HomeController
{
    private $_template;
    private $viewPath;
    private $siteUrl;
    public function __construct()
    {
        $this->viewPath = dirname(__FILE__, 2)."/Views";
        $this->_template = new Engine($this->viewPath); 
        $this->siteUrl = getenv('SITE_URL');       
    }
    public function indexLeague()
    {
        echo $this->_template->render('league-front', ['siteUrl'=> $this->siteUrl]);
    }

    public function indexTeams()
    {
        echo $this->_template->render('team-front', ['siteUrl'=> $this->siteUrl]);
    }
}