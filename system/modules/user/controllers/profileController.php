<?php

class profileController extends userController
{
    private $profile;

    public function __construct()
    {
        parent::__construct();
        $this->profile = $this->loadModel('profile');
        $this->access_init();
    }

    public function index()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('user', $this->profile->getUser(Session::get('id_user')));
        $this->view->assign('title', Session::get('f_name'));
        $this->view->render('index', 'User\s Profile');
        $this->profile->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'User\s Profile');
    }

    public function activities($page = FALSE){
        $this->view->setJs(array('main'));

        if (!$this->filterInt($page)) {
            $page = false;
        } else {
            $page = (int)$page;
        }

        $pagination = new Pagination();

        $this->view->assign('activities', $pagination->pager($this->profile->getActivities(Session::get('username')), $page));
        $this->view->assign('pagination', $pagination->getView('word', 'user/profile/activities/page'));

        $this->view->assign('user', $this->profile->getUser(Session::get('id_user')));
        $this->view->assign('title', Session::get('f_name'));
        $this->view->render('activities', 'User\s Activity');
        $this->profile->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'User\s Activity');
    }
}