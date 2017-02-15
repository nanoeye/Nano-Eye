<?php

class developerController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->view->seTemplate('liteboot');
        $this->view->setWidgetOptions('menu-top', array('top','top', true));
        $this->access_init();
    }

    public function index() {}

}