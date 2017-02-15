<?php

class installController extends Controller
{
    private $registry;
    private $db;
    
    public function __construct() {
        parent::__construct();
        $this->registry =  Registry::getInstance();
        $this->db = $this->registry->db;
        $this->view->seTemplate("goahead");
    }
    
    public function index() {
        $this->view->setJs(array('main'));
        $this->view->assign('title', 'Install');
        $this->view->assign('data', 'Install Page.');
        $this->view->render('index', 'Install');
    }
}