<?php

class aclController extends Controller
{
    protected $acl;

    public function __construct()
    {
        parent::__construct();

        $this->acl = $this->loadModel('index');
        $this->view->seTemplate('liteboot');
        $this->view->setWidgetOptions('menu-top', array('top','top', true));
        $this->access_init();
        $this->acl->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', '');
    }

    public function index() {}

}