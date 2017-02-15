<?php

class appController extends Controller {

    private $app;

    public function __construct()
    {
        parent::__construct();
        $this->app = $this->loadModel('app');

        $this->view->seTemplate('goahead');
        $this->app->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', '');
    }
    
    public function index()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('apps' , $this->app->getApps());
        $this->view->assign('title', 'Apps');
        $this->view->render('index', 'Apps');
    }
    
}
