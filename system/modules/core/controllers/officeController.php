<?php

class officeController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->view->seTemplate('aOffice');
        $this->view->setWidgetOptions('menu-titlebar', array('titlebar','titlebar', true));
        $this->access_init();
    }

    public function index() {}

}