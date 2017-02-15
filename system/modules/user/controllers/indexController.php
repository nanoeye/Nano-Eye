<?php

class indexController extends userController
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = $this->loadModel('index');
        $this->access_init();
    }

    public function index()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('user', $this->user->getUser(Session::get('id_user')));
        $this->view->assign('title', 'User Panel');
        $this->view->render('index', 'User Panel');
        $this->user->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'User Panel');
    }
    
}

